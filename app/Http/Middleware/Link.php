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




        $userLink = auth()->user()->link;

//        $end_time = $userLink->updated_at->addMinutes(10);
        $end_time = $userLink->updated_at->addWeeks(1);

//        dd($end_time);

        $link = str_replace('game/', '', $request->path());
        $link = str_replace('/deactivate', '', $link);

        $flag = $link == $userLink->link;

//        dd(!$flag || !$end_time->gt(Carbon::now()));

//        dd(!$flag);

        if(!$flag || !$end_time->gt(Carbon::now())){

           return redirect()->route('home');
       }

        return $next($request);

    }
}
