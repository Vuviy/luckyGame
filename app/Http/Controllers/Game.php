<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Game extends Controller
{
    public function index($link){


//        dd($link);

        $title = 'Game';

        return view('game', compact('title'));
    }
}
