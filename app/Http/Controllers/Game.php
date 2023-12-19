<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Game extends Controller
{
    public function index(){

        $user = auth()->user();
        $title = 'Game';

        return view('game', compact(['title', 'user']));
    }



    public function deactivate(Request $request){

        $link = Link::query()->where('user_id',$request->user_id)->first();
        $link->update(['status' => 0]);
        return redirect()->route('game', ['link' => $link->link]);

//        or
//        $link->delete();
//        return redirect()->route('home');
    }


    public function generateNewLink(Request $request){

        $link = Link::query()->where('user_id', $request->user_id)->first();
        $new_link = Str::random(30);
        $link->update(['link' => $new_link, 'status' => 1]);

        return redirect()->route('game', ['link' => $new_link]);
    }


    public function imfeelinglucky(){

        $user = auth()->user();
        $title = 'Game';

        if($user){
            if($user->link->status == 0){
                return view('game', compact(['title', 'user']));
            }
            $int = random_int(1, 1000);
            $win_lose = $int % 2;
            $prise = 0;


            if(!$win_lose){
                $prise = $this->culcWin($int);
            }

            $game = new \App\Models\Game();
            $game->create(
                [
                    'result' => $int,
                    'user_id' => auth()->user()->id,
                    'sum' => $prise,
                ]
            );

            $data = ['result' => $int, 'win_lose' => $win_lose, 'prise' => $prise];
            return view('game', compact(['title', 'data', 'user']));
        }

        return redirect()->route('home');

    }

    public function history(){

        $user = auth()->user();

        if($user){
            $games = $user->games;
            $title = 'Game';
            return view('game', compact(['title', 'games', 'user']));
        }

        return redirect()->route('home');


    }

    public function culcWin($int){

        $prise = 0;

        switch (true){
            case $int > 900 :
                $prise = $int * 0.7;
                break;
            case $int > 600 && $int < 900 :
                $prise = $int * 0.5;
                break;
            case $int > 300 && $int < 600 :
                $prise = $int * 0.3;
                break;
            case $int <= 300 :
                $prise = $int * 0.1;
                break;
        }

        return round($prise, 2);
    }
}
