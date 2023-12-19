<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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


    public function generateNewLink(Request $request){


        $link = Link::query()->where('user_id', $request->user_id)->first();
        $new_link = Str::random(30);

//        $link->link = $new_link;
        $link->update(['link' => $new_link]);


        return redirect()->route('game', ['link' => $new_link]);
    }
}
