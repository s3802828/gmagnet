<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', ['title' => 'Login']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('username', 'password'))) {
            return back()->with('status', 'Username or Password is incorrect');
        }

        return redirect()->route('index');
    }
}
