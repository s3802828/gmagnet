<?php

use App\Http\Controllers\DobRedirectController;
use App\Http\Controllers\GamepageController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
use App\Models\User;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use Illuminate\Auth\Events\Login;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('index',['title' => 'Home Page'])->name('index');
// });
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/joingame',[IndexController::class, 'addUserGame'])->name('joinGame');
Route::post('/', [GameController::class, 'addGame'], [IndexController::class, 'addUserGame']);
Route::post('/editgamepageimage', [GameController::class, 'editGamepageImage'])->name('editgamepageimage');
Route::post('/editgamepagedescription', [GameController::class, 'editGamepageDescription'])->name('editgamepagedescription');
Route::post('/deletegamepage', [GameController::class, 'deleteGamepage'])->name('deletegamepage');
Route::get('/results', [SearchController::class, 'index'])->name('searchresults');

// Route::get('/gamepage', function () {
//     return view('gamepage',['title' => 'Game Page']);
// });

Route::get('/gamepage/{game}', [GamepageController::class, 'index'])->whereNumber('game')->name('gamepage')->middleware('verifyAge');

Route::post('/gamepage', [GamepageController::class, 'store'])->name('addpost');
Route::post('/gamepage/editpost', [GamepageController::class, 'editpost'])->name('editpost');
Route::post('/gamepage/deletepost', [GamepageController::class, 'deletepost'])->name('deletepost');
Route::post('/gamepage/rating', [GamepageController::class, 'uploadrating'])->name('uploadrating');
Route::post('/gamepage/addcomment', [GamepageController::class, 'addcomment'])->name('addcomment');
Route::post('/gamepage/editcomment', [GamepageController::class, 'editcomment'])->name('editcomment');
Route::post('/gamepage/deletecomment', [GamepageController::class, 'deletecomment'])->name('deletecomment');

Route::get('/member/{user}', [MemberController::class, 'index'])->middleware('auth')->name('memberPage');


Route::get('/profilepage', [ProfileController::class, 'index'])->middleware('auth')->name('profilePage');
Route::post('/profilepage', [ProfileController::class, 'location'])->middleware('auth');
Route::post('/profilepage/update', [ProfileController::class, 'update'])->name('updateProfile');
Route::post('/profilepage/updateimage', [ProfileController::class, 'updateimage'])->name('updateAvatar');

Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/signup', [SignupController::class, 'index'])->name('signup')->middleware('guest');
Route::post('/signup', [SignupController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->middleware('guest')->name('loginGG');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->middleware('guest');

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->middleware('guest')->name('loginFB');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback'])->middleware('guest');

Route::get('/dob', [DobRedirectController::class, 'index'])->name('dob')->middleware('askDob');
Route::post('/dob', [DobRedirectController::class, 'store'])->name('dob')->middleware('auth');

// Route::get('details', function () {

// 	$ip = '50.90.0.1';
//     $data = Location::get($ip);
//     dd($data);
   
// });
