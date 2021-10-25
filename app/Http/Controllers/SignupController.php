<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function index(){
        return view('signup',['title' => 'Sign Up']);
    }

    public function store(Request $request){

        $this->validate($request, [
            'firstname' => 'required|max:50|regex:/^[A-Za-z ,.\'-].*$/',
            'lastname' => 'required|max:50|regex:/^[A-Za-z ,.\'-].*$/',
            'username' => 'required|max:20|alpha_dash|unique:users,username',
            'password' => 'required|min:6|max:20|
                            regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%&*])(.*[A-Za-z\d!@#$%&*])$/|
                            confirmed',
            'gender' => 'required|boolean',
            'birthdate'=>'required|date|before:today',
        ]);
        $new_date=date("Y-m-d",strtotime($request->birthdate));
        $row_numb = User::count('id')+1;
        $name = ($request-> firstname)." ".($request-> lastname);
        
        User::create(
           [
            'id' => $row_numb,
            'name' => $name, 
            'username' => $request -> username,
            'password' => Hash::make($request -> password),
            'dob' => $new_date,
            'gender' => $request -> gender,
            'description' => null,
            'avatar' => null,
            'location' => null
           ]
        );

        Auth::attempt($request->only('username', 'password'));
        return redirect()->route('index');
    }
}
