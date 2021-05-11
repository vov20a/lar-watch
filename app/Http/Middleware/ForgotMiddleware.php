<?php

namespace App\Http\Middleware;

use Closure;

class ForgotMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //зашли методом GET - надо прервать работу
        // dd('here');
        // return $next($request);
        abort(404);
    }
}
