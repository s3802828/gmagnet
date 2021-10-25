<?php
  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {


            $user = Socialite::driver('facebook')->fields(['name', 'birthday'])->user();
            $finduser = User::where('id', $user->id)->first();
     
            if($finduser){
     
                Auth::login($finduser);
                if($finduser->dob){
                    return redirect()->route('index');
                }
    
                return redirect()->route('dob');
     
            }else{

                $newUser = User::create([
                    'username' => $user->name,
                    'name' => $user->name,
                    'id'=> $user->id,
                    'avatar' =>$user->avatar,
                    'password' => encrypt('F@c3b00k')
                ]);
    
                Auth::login($newUser);
     
                return redirect()->route('dob');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}