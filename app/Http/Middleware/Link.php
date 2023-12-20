<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        $link = str_replace(['game/', '/deactivate', '/generate', '/imfeelinglucky', '/history'], '', $request->path());

        $user_link = \App\Models\Link::query()->where('link', $link)->first();

        if($user_link){
            $user = $user_link->user;
            $user_signed = $user == auth()->user();

            if(!$user_signed && $user_link){
                return redirect()->route('loginForm');
            }
        }

        if(auth()->user()) {
            $userLink = auth()->user()->link;
            $end_time = $userLink->updated_at->addWeeks(1);
            $flag = $link == $userLink->link;
            if (!$flag || !$end_time->gt(Carbon::now())) {
                return redirect()->route('home');
            }
            return $next($request);
        }
        return redirect()->route('home');

    }
}
