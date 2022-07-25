<?php

namespace App\Http\Middleware;

use Closure;

// class RedirectIfNotOperator
class RedirectIfNotPengurus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next, $guard="operator")
    public function handle($request, Closure $next, $guard="pengurus")
    {
        if(!auth()->guard($guard)->check()){
            return redirect(route('pengurus.login'));
        }
        return $next($request);
    }
}
