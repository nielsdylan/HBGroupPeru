<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HbGrroup
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
        if (!session()->has('hbgroup')) {
            return redirect('login');
        }
        return $next($request);
    }
}
