<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;
use App\Models\Game;
use App\Models\Tag;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;

use function JmesPath\search;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $gameCards = Game::all(); //list games available
        $tags = Tag::all();

        if (Auth::user()) {
            $userGameJoined = DB::table('user_game')->where('user_id', Auth::user()->id)->pluck('game_id'); //list game id user joined

        }

        if (Auth::user() && !Auth::user()->dob) {
            return redirect()->route('dob');
        }

        // If user is logged in and location is not null (location function is turned on) -> update location
        if (Auth::check() && Auth::user()->location != null) {
            $ip = $request->header('X-Forwarded-For');
            $data = Location::get($ip);
            $city = $data->cityName;
            DB::table('users')->where('id', Auth::user()->id)->update(['location' => $city]);
        }

        

        if($request->has('le-search'))
        {
            $name = $request->input('le-search');
            $results = Game::where('name', 'like', '%'.$name.'%')->orderBy('id', 'desc')->paginate(3);
        }

        if(Auth::user()){
            return view('index', compact('gameCards'), ['title' => 'Homepage', 'gameJoined' => $userGameJoined, 'tagsList' => $tags]);
        }else{
            return view('index', compact('gameCards'), ['title' => 'Homepage', 'tagsList' => $tags]);
        }
    }

    public function addUserGame(Request $request)
    {
        if(Auth::user())
        {
        $userAge = Carbon::parse(Auth::user()->dob)->age;
        $ageLimit = Game::find($request->game_id)->ageLimit;
        if($userAge < $ageLimit){
            return redirect(RouteServiceProvider::HOME)->withErrors(['verifyAge' => 'You are not old enough to join this game page']);
        } else{
            $userGame = User::where('id', Auth::user()->id)->first();
            $gameID = $request->game_id;
            $userGame->gameJoined()->attach($gameID);
            return redirect()->back();
        }
        } else {
            return redirect()->route('login');
        }
    }
}
