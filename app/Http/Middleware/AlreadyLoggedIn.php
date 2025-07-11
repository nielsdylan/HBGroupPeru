<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedIn
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
        // if (session()->has('user') && (url('hbgroupp_web') == $request->url())) {
        //     return back();
        // }
        // if (session()->has('hbgroup') && (url('login') == $request->url())) {
        if (session()->has('hbgroup')) {
            // return back();
            return redirect()->route('perfil.index');
        }
        return $next($request);
    }
}
