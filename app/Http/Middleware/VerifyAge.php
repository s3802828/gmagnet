<?php

namespace App\Http\Middleware;

use App\Models\Game;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $gameid = substr($request->getRequestUri(), 10);
        $ageLimit = Game::find($gameid)->ageLimit;
        if(Auth::guest())
        {
            if($ageLimit == '0'){
                return $next($request);
            } else {
                return redirect(RouteServiceProvider::HOME)->withErrors(['verifyAge' => 
                'This game page has age limit. You should <a href="/signup" class="alert-link">Sign Up</a> or <a href="/login" class="alert-link">Login</a> to verify your age']);
            }
        } else {
            $userAge = Carbon::parse(Auth::user()->dob)->age;
            if($userAge < $ageLimit){
                return redirect(RouteServiceProvider::HOME)->withErrors(['verifyAge' => 'You are not old enough to view this game page']);
            }
            return $next($request);
        }
    }
}
