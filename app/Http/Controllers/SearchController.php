<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Game;
use App\Models\Tag;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $tags = Tag::all();
        $gameCards = Game::all();
        $Arrayresults = [];
        if (Auth::user()) {
            $userGameJoined = DB::table('user_game')->where('user_id', Auth::user()->id)->pluck('game_id'); //list game id user joined

        }



        if ($request->has('le-search') && $request->has('tagsearch')) {
            $name = $request->input('le-search');
            $tagInput = $request->tagsearch;
            $nameresults = Game::whereRAW('LOWER(name) like ?', '%' . strtolower($name) . '%')->get();

            



            foreach ($nameresults as $game) {
                $tagsList = $game->gametags;
                
                $counter = 0;
                foreach ($tagsList as $tagCollection) {
                    $tag =  $tagCollection->pivot->tag_id;
                    foreach ($tagInput as $input) {
                        
                        if ($input == $tag) {
                            $counter++;
                        } else {
                            $counter = $counter + 0;
                        }
                    }
                }



                if ($counter > 0) {
                    $result = Game::whereRAW('LOWER(name) like ?', '%' . strtolower($game->name) . '%')->get();
                    //dd($result);
                    array_push($Arrayresults, $result);
                }
            }

            $results = Collection::make($Arrayresults);


            if (Auth::user()) {
                return view('results', ['title' => 'Search Results', 'gameCards' => $gameCards, 'resultname' => $name, 'results' => $results, 'gameJoined' => $userGameJoined, 'tagsList' => $tags]);
            } else {
                return view('results', ['title' => 'Search Results', 'resultname' => $name, 'results' => $results, 'tagsList' => $tags]);
            }

        } elseif ($request->has('le-search')) {
            $name = $request->input('le-search');
            $result = Game::whereRAW('LOWER(name) like ?', '%' . strtolower($name) . '%')->orderBy('id', 'desc')->get();
            array_push($Arrayresults, $result);
            $results = Collection::make($Arrayresults);
            // $tagInput = $request->input('tagsearch');
            if (Auth::user()) {
                return view('results', ['title' => 'Search Results', 'gameCards' => $gameCards, 'resultname' => $name, 'results' => $results, 'gameJoined' => $userGameJoined, 'tagsList' => $tags]);
            } else {
                return view('results', ['title' => 'Search Results', 'resultname' => $name, 'results' => $results, 'tagsList' => $tags]);
            }

        } elseif ($request->has('tagsearch')) {
            $tagInput = $request->tagsearch;



            foreach ($gameCards as $game) {
                
                $tagsList = $game->gametags;
                // echo $tagsList + "<br>";
                $counter = 0;
                foreach ($tagsList as $tagCollection) {
                    $tag =  $tagCollection->pivot->tag_id;
                    foreach ($tagInput as $input) {
                        if ($input == $tag) {
                            $counter++;
                        } else {
                            $counter = $counter + 0;
                        }
                    }
                }



                if ($counter > 0) {
                    $result = Game::whereRAW('LOWER(name) like ?', '%' . strtolower($game->name) . '%')->get();
                    
                    array_push($Arrayresults, $result);
                }
            }

            $results = Collection::make($Arrayresults);

            if (Auth::user()) {
                return view('results', ['title' => 'Search Results', 'gameCards' => $gameCards, 'results' => $results, 'gameJoined' => $userGameJoined, 'tagsList' => $tags]);
            } else {
                return view('results', ['title' => 'Search Results', 'results' => $results, 'tagsList' => $tags]);
            }

        }

        // $gameCards = Game::orderBy('id', 'desc')->limit(6)->get(); //list games available





    }
}
