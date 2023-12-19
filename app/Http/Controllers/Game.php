<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class Game extends Controller
{
    public function index(){


        $user = auth()->user();


//        dd(auth()->user());

        $title = 'Game';

        return view('game', compact(['title', 'user']));
    }



    public function deactivate(Request $request){

        $link = Link::query()->where('user_id',$request->user_id)->first();
        $link->delete();

        return redirect()->route('home');
    }
}
