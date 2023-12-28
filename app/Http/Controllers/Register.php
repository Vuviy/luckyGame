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

    public function loginForm(){

        $title = 'Login';
        return view('login', compact('title'));
    }

    public function register(UserRequest $request){

        $data = $request->validated();
        $link = Str::random(30);

        $user = User::create([
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
        ]);

        $user->link()->create(['link' => $link]);
        Auth::loginUsingId($user->id);
        return redirect()->route('game', ['link' => $user->link->link]);
    }

    public function login(UserRequest $request){

        $data = $request->validated();

        $user = User::query()->where('username', $data['username'])->where('phone_number', $data['phone_number'])->first();

        if($user){
            Auth::loginUsingId($user->id);
            return redirect()->route('game', ['link' => $user->link->link]);
        }
        return redirect()->route('loginForm');

    }
}
