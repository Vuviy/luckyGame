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

        $title = 'Register';
        return view('register', compact('title'));
    }

    public function register(UserRequest $request){

        $link = Str::random(30);

        $user = User::create([
            'username' => $request->username,
            'phone_number' => $request->phone_number,
        ]);

        $user->link()->create(['link' => $link]);
        Auth::loginUsingId($user->id);
        return redirect()->route('game', ['link' => $user->link->link]);

    }
}
