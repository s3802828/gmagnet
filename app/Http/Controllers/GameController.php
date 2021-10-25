<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class GameController extends Controller
{
    //
    public function addGame(Request $request){
        //dd($request);
        $userAge = Carbon::parse(Auth::user()->dob)->age;
        $this->validate($request, [
            'name' => 'required|unique:games',
            'ageLimit' => "required|numeric|max:$userAge",
            'gametag' => 'required|array|min:1|max:5',
            'description' => 'required',
            'logo' => 'required|image|max:5000',
            'banner'=>'required|image|max:5000',
        ]);
        $logoPath = $request->file('logo')->store(
            'logo', 's3'
        );
        $bannerPath = $request->file('banner')->store(
            'banner', 's3'
        );
        $addGame = Game::create([
            'name' => $request->name,
            'ageLimit' => $request->ageLimit,
            'description' => $request->description,
            'admin' => $request->admin,
            'logo' => $logoPath,
            'banner' => $bannerPath
        ]);
        $game = Game::find($addGame->id);
        foreach($request->gametag as $tagID){
            $game->gametags()->attach($tagID);
        }
        $game->members()->attach($request->admin);
        Storage::disk('s3')->setVisibility($logoPath, 'public');
        Storage::disk('s3')->setVisibility($bannerPath, 'public');
        return redirect()->route('index');
    }

    public function editGamepageImage(Request $request){
        if($request->formfor == "banner"){
            $this->validate($request, [
                'banneredit' => 'required|image|max:5000'
            ]);
            $game = Game::find($request->idOf);
            Storage::disk('s3')->delete($game->banner);
            $bannerPath = $request->file('banneredit')->store(
                'banner', 's3'
            );
            $game->banner = $bannerPath;
            $game->save();
            return redirect()->back();
        }
        if($request->formfor == "logo"){
            $this->validate($request, [
                'logoedit' => 'required|image|max:5000'
            ]);
            $game = Game::find($request->idOf);
            Storage::disk('s3')->delete($game->logo);
            $logoPath = $request->file('logoedit')->store(
                'logo', 's3'
            );
            $game->logo = $logoPath;
            $game->save();
            return redirect()->back();
        }
    }
    public function editGamepageDescription(Request $request){
        $this->validate($request, [
            'editgamedescription' => 'required',
        ]);
        $game = Game::find($request->id_des);
        $game->description = $request->editgamedescription;
        $game->save();
        return redirect()->back()->with('editDescriptionSuccess', 'Description successfully edited');
    }
    public function deleteGamepage(Request $request){
        if($request->deleteItem == 'gamepage'){
            $game = Game::find($request->itemId);
            Storage::disk('s3')->delete($game->logo);
            Storage::disk('s3')->delete($game->banner);
            $game->delete();
            return redirect()->route('index');
        }
    }
    
}
