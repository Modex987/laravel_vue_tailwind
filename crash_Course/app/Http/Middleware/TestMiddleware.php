<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('frq')) {

            // dd(now()->diffInSeconds(session()->get('frq')) < 10);

            if (now()->diffInSeconds(session()->get('frq')) < 10) {
                dd('redirected');
            } else {
                session()->put('frq', now());
            }
        } else {
            session()->put('frq', now());
        }

        return $next($request);
    }
}