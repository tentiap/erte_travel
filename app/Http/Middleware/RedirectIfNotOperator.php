<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotOperator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="operator")
    {
        if(!auth()->guard($guard)->check()){
            return redirect(route('operator.login'));
        }
        return $next($request);
    }
}
