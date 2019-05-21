<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->rol == 'admin') {
            return redirect('/admin');
        }elseif(Auth::guard($guard)->check() && Auth::user()->rol == 'concesionario'){
            return redirect('/panel');
        }
        return $next($request);
    }
}
