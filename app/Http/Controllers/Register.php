<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Register extends Controller
{
    public function index(){




//        dd($link);

        $title = 'Register';
        return view('register', compact('title'));
    }

    public function register(UserRequest $request){



//        dd($request->phone_number);

        $link = Str::random(30);

//        $user = User::create($request);

        $user = User::create([
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'link' => $link,
        ]);

//        $user = User::create($request);



        Auth::loginUsingId($user->id);

//        $con =  new Game();
//
//        $con->index($link);

//        return $con;
//        $url = route('game', ['link' => $user->link]);
        return redirect()->route('game', ['link' => $user->link]);


//        dd($url);

//        dd($user);
    }
}
