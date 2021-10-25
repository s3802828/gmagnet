<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestingConstroller extends Controller
{
    //
    function index(){
        return DB::select("select * from Tag");
    }

}
