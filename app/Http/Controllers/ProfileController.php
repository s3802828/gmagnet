<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location as ReflectionLocation;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Game;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ProfileController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $sidebarGames = Game::all();
        if (Auth::user()) {

            $userGameJoined = DB::table('user_game')->where('user_id', Auth::user()->id)->pluck('game_id'); //list game id user joined

            $adminGames = Game::where('admin', Auth::user()->id)->get();

        }
        return view('profilepage', [
            'title' => 'Profile Page',
            'gameCards' => $sidebarGames,
            'gameJoined' => $userGameJoined,
            'userAdminGame' => $adminGames
        ]);
    }
    public function location(Request $request)
    {
        $ip = $request->header('X-Forwarded-For');
        $data = Location::get($ip);
        $city = $data->cityName;
        if ($request->locationConfirmation == "on") {
            DB::table('users')->where('id', Auth::user()->id)->update(['location' => $city]);
        } else {
            DB::table('users')->where('id', Auth::user()->id)->update(['location' => null]);
        }

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $userID = Auth::user()->id;
        $user = User::where('id', $userID)->first();

        if ($request->editusername == $user->username) {
            $validate = Validator::make($request->all(), [
                'editprofiledescription' => 'max:5000'
            ])->validateWithBag('profile');
        } else {
            $validate = Validator::make($request->all(), [
                'editusername' => 'max:20|alpha_dash|unique:users,username',
                'editprofiledescription' => 'max:5000'
            ])->validateWithBag('profile');
        }

        // if ($validate->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validate, 'aboutme')
        //         ->withInput();
        // };

        $user->username = $request->editusername;
        $user->description = $request->editprofiledescription;

        $user->save();

        return redirect()->route('profilePage');
    }

    public function updateimage(Request $request){
        $this->validate($request,
           [ 'avatar'=>'required|image|mimes:jpeg,jpg,png|max:5000']
        );

        $user= User::where('id', $request->userId)->first();

        if($user->avatar){
            Storage::disk('s3')->delete($user->avatar);
            // Store new image
            $imagePath = $request->file('avatar')->store('avatar', 's3');
            $user->avatar= $imagePath;
            Storage::disk('s3')->setVisibility($user->avatar, 'public');
            $user->update();
        }
        else{
            $imagePath = $request->file('avatar')->store('avatar', 's3');
            $user->avatar= $imagePath;
            Storage::disk('s3')->setVisibility($user->avatar, 'public');
            $user->update();
        }

        return redirect()->back();
    }
}
