<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Link
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {



//        dd(auth()->user());


        $userLink = auth()->user()->link->link;
        $link = str_replace('game/', '', $request->path());

        $flag = $link == $userLink;
       if(!$flag){

           return redirect()->route('home');
       }

        return $next($request);

    }
}
