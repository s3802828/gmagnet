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
use Illuminate\View\Middleware\ShareErrorsFromSession;

class MemberController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(User $user)
    {
        $memberGameJoined = DB::table('user_game')->where('user_id', $user->id)->pluck('game_id'); //list game id user joined
        $memberAdminGame = Game::where('admin', $user->id)->get(); //games that member joined 

        // for sidenav
        $sidebarGames = Game::all();
        $userGameJoined = DB::table('user_game')->where('user_id', Auth::user()->id)->pluck('game_id'); //list game id user joined
        
        return view('components.memberprofile', 
        ['title' => 'Member Page',
        'gameCards' => $sidebarGames,
        'gameJoined' => $userGameJoined,
        'member'=>$user, 
        'memberJoinedGames'=>$memberGameJoined, 
        'memberAdminGames'=>$memberAdminGame]);
    }

}
