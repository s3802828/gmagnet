<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Google_Client;
use Google_Service_People;
use Google_Service_People_Birthday;
use Google_Service_PeopleService_Birthday;

//use App\Http\Controllers\Request;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    // Function to send request to google 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                if($finduser->dob){
                    return redirect()->route('index');
                }

                return redirect()->route('dob');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'username' => $user->name,
                    'id' => $user->id,
                    'avatar' => $user->avatar,
                    'password' => encrypt('G00gl3')
                ]);

                Auth::login($newUser);

                return redirect()->route('dob');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
