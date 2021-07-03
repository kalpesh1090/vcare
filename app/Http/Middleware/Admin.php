<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Admin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (Auth::user()->user_type == "1" && Auth::user()->user_type == "2") {
            return $next($request);
        } else {
            return response(view('errors.404'), 404);
        }
    }

}
