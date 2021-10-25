<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use Reflector;

class GamepageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Game $game)
    {

        $id = $game->id;
        $title = $game->name;
        $tags = $game->gametags;
        $description = nl2br($game->description);
        $logo = $game->logo;
        $banner = $game->banner;
        $admin = User::find($game->admin);
        $sidebarGames = Game::all();
        Storage::disk('s3')->setVisibility($logo, 'public');
        Storage::disk('s3')->setVisibility($banner, 'public');


        $posts = Post::with('voted_by')->where('game_id', $id)->orderBy('created_at', 'desc')->get();
        // $posts ->withpath($id.'/posts');

        $comment = Comment::all()->sortBy('created_at');

        $rate = Game::where('id', $id)->with(['rated_by' => function ($q) {
            $q->orderBy('rate.created_at', 'desc');
        }])->first();
        $membersList = Game::find($id)->members;
        if (count($posts)) {
            foreach ($posts as $post) {
                if ($post->image != null) {
                    Storage::disk('s3')->setVisibility($post->image, 'public');
                }
            }
        }

        if (Auth::user()) {

            $userGameJoined = DB::table('user_game')->where('user_id', Auth::user()->id)->pluck('game_id'); //list game id user joined

        } else {
            $userGameJoined = null;
        }

        return view('gamepage', [
            'title' => 'Game Page',
            'gametitle' => $title,
            'gametags' => $tags,
            'description' => $description,
            'admin' => $admin,
            'memberList' => $membersList,
            'logo' => $logo,
            'banner' => $banner,
            'id' => $id,
            'posts' => $posts,
            'gameCards' => $sidebarGames,
            'gameJoined' => $userGameJoined,
            'rate' => $rate,
            'comment' => $comment
        ]);
    }

    public function store(Request $request, Game $game)
    {

        if ($request->formfor == "imagepost") {

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:150',
                'image' => 'required|image|mimes:jpeg,jpg,png|max:5000',
                'content' => 'required|max:200',
            ])->validateWithBag('imagepost');

            $imagePath = $request->file('image')->store('post_image', 's3');

            $gamepage = Game::where('id', $request->game)->first();
            $newPost = new Post;
            $newPost->title = $request->title;
            $newPost->image = $imagePath;
            $newPost->content = $request->content;
            $newPost->post_of_game()->associate($gamepage);
            $newPost->post_by_user()->associate(Auth::user());
            $newPost->save();

            return redirect()->back()->with('addpostSuccess', 'Your post was added successfully');
        } elseif ($request->formfor == "textpost") {
            // $this->validate($request, [
            //     'title' => 'required|max:150',
            //     'content' => 'required|max:300',
            // ]);

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:150',
                'content' => 'required|max:300',
            ])->validateWithBag('textpost');

            $gamepage = Game::where('id', $request->game)->first();
            $newPost = new Post;
            $newPost->title = $request->title;
            $newPost->content = $request->content;
            $newPost->post_of_game()->associate($gamepage);
            $newPost->post_by_user()->associate(Auth::user());
            $newPost->save();

            return redirect()->back()->with('addpostSuccess', 'Your post was added successfully');
        }

        if ($request->ajax()) {
            $vote = $request->isLiked;
            $postID = $request->postID;

            $postModel = Post::where('id', $postID)->first();
            $user = Auth::user();
            $voteOption = "";

            if ($vote == '0') {
                // delete row if user unlike or undislike
                DB::table('vote')->where('post_id', $postID)->where('user_id', Auth::user()->id)->delete();
                $voteOption = "neutral";
            }

            if (DB::table('vote')->where('post_id', $postID)->where('user_id', Auth::user()->id)->first()) {
                // update user vote if they have voted before
                if ($vote == '1') {
                    DB::table('vote')->where('post_id', $postID)->where('user_id', Auth::user()->id)->update(['vote_choice' => '1']);
                    $voteOption = "like";
                } elseif ($vote == '-1') {
                    DB::table('vote')->where('post_id', $postID)->where('user_id', Auth::user()->id)->update(['vote_choice' => '0 ']);
                    $voteOption = "dislike";
                }
            } else {
                // create user vote if they have not vote this post before
                if ($vote == '1') {
                    $postModel->voted_by()->attach($user->id, ["vote_choice" => '1']);
                    $voteOption = "like";
                } elseif ($vote == '-1') {
                    $postModel->voted_by()->attach($user->id, ["vote_choice" => '0']);
                    $voteOption = "dislike";
                }
            }

            $like = DB::table('vote')->where('post_id', $postID)->where('vote_choice', true)->count();
            $dislike = DB::table('vote')->where('post_id', $postID)->where('vote_choice', false)->count();
            return response()->json(["voted" => true, "postID" => $postID, "option" => $voteOption, "like" => $like, "dislike" => $dislike]);
        }
    }

    public function editpost(Request $request)
    {

        if ($request->formfor == "edit_imagepost") {

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:150',
                'image' => 'required|image|mimes:jpeg,jpg,png|max:5000',
                'content' => 'required|max:200',
            ])->validateWithBag('imagepost' . $request->postid);

            $post = Post::where('id', $request->postid)->first();
            // Delete old image
            Storage::disk('s3')->delete($post->image);
            // Store new image
            $imagePath = $request->file('image')->store('post_image', 's3');
            // update new data
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $imagePath;
            $post->save();


            return redirect()->back()->with('editSuccess' . $request->postid, 'The post was updated successfully!');
        } elseif ($request->formfor == "edit_textpost") {

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:150',
                'content' => 'required|max:300',
            ])->validateWithBag('textpost' . $request->postid);

            $post = Post::where('id', $request->postid)->first();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();

            return redirect()->back()->with('editSuccess' . $request->postid, 'The post was updated successfully!');
        }
    }

    public function deletepost(Request $request)
    {
        if ($request->deleteItem == "post") {
            $post = Post::where('id', $request->itemId)->first();
            if ($post->image) {
                Storage::disk('s3')->delete($post->image);
                Post::where('id', $request->itemId)->delete();
            } else {
                Post::where('id', $request->itemId)->delete();
            }
            return redirect()->back()->with('deleteSuccess', 'The post was deleted successfully!');
        }
    }

    public function uploadrating(Request $request)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        } else {
            $membersList = Game::find($request->gameid)->members;
            $isMember = 0;
            foreach ($membersList as $member) {
                if (Auth::user()->id == $member->id) {
                    $isMember = 1;
                }
            }
            if ($isMember == 1) {
                $user = Auth::user()->id;
                $rate = Game::where('id', $request->gameid)->first();

                $validator = Validator::make($request->all(), [
                    'userrating' => 'required',
                    'comment' => 'max:5000'
                ])->validateWithBag('rating');

                $gamerated = DB::table('rate')->where('user_id', $user)->where('game_id', $request->gameid)->get();
                if ($gamerated->count() == 0) {
                    $rate->rated_by()->attach($user, ["value" => $request->userrating, "rate_comment" => $request->comment, "created_at" => Carbon::parse(Carbon::now()->timestamp)->format('Y-m-d H:i:s')]);
                    return redirect()->back()->with('rateSuccess', 'The rating was added successfully!');
                } else {
                    return redirect()->back()->with('rateAlready', 'You had already rated the game!');
                }
            } else {
                return redirect()->back()->with('joinGameFirst', 'You need to join game');
            }
        }
    }

    public function addcomment(Request $request)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        } else {
            $membersList = Game::find($request->gameid)->members;
            $isMember = 0;
            foreach ($membersList as $member) {
                if (Auth::user()->id == $member->id) {
                    $isMember = 1;
                }
            }
            if ($isMember == 1) {
                $user = Auth::user()->id;

                $validator = Validator::make($request->all(), [
                    'comment' => 'required|max:5000',
                ])->validateWithBag('comment');

                Comment::create([
                    'post_id' => $request->postid,
                    'user_id' => $user,
                    'comment_text' => $request->comment
                ]);

                return redirect()->back()->with('postCommentAdded' . $request->postid, 'The comment was added successfully!');
            } else {
                return redirect()->back()->with('joinGameFirstComment', 'You need to join game');
            }
        }
    }

    public function editcomment(Request $request)
    {
        $comment = Comment::where('id', $request->editcommentid)->first();

        $validator = Validator::make($request->all(), [
            'editcomment' => 'required|max:5000',
        ])->validateWithBag('comment');

        $comment->comment_text = $request->editcomment;

        $comment->save();

        return redirect()->back()->with('editCommentSuccess'.$request->editcommentid, 'The comment was updated successfully!');
    }

    public function deletecomment(Request $request)
    {
        if ($request->deleteItem == "comment") {
            Comment::find($request->itemId)->delete();
            return redirect()->back()->with('deleteCommentSuccess'.$request->postidcomment, 'The comment was deleted successfully!');
        }
    }
}
