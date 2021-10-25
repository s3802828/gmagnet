<?php

namespace App\Http\Middleware;

use App\Models\Game;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AskDob
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
        if(Auth::user())
        {
            if(!Auth::user()->dob){
                return $next($request);
            } else {
                return redirect(RouteServiceProvider::HOME);
            }
        } else {
            return redirect()->route('signup');
        }
    }
}
