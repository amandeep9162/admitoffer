<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PageUnLock
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'agent')
    {
        if (Auth::guard($guard)->check()) {
            
         $agent =Auth::guard('agent')->user();
            if($request->password == $agent['pagelock'] ){

            
            return $next($request);
            }

        return back()->withErrors(['Password not match']);
        }

        return $next($request);
    }



}
