<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class DobRedirectController extends Controller
{
    public function index(){
        return view('dob',['title' => 'Date of Birth require']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'birthdate' => 'required|date|before:today',
        ]);
        $new_date = date("Y-m-d", strtotime($request->birthdate));

        if (!(Auth::user()->dob)) {
            DB::table('users')->where('id', Auth::user()->id)->update(['dob' => $new_date]);
            return redirect()->route('index');
        }
        else {
            return view('index',['title' => 'Homepage']);
        }

    }
}
