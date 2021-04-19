<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
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
        /* verificamos si el usuario es administardor */
        if (Auth::user() &&  Auth::user()->is_admin) {
            return $next($request);
        }else{
            return redirect('/user');
        }

        return redirect('/')->with('error','You have not admin access');
    }
}
