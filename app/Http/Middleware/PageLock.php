<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;

class PageLock
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
        if ($request->isMethod('get')) {
            if (Auth::guard($guard)->check()) {
                Session::put('commissionStructureCountryId',$request->route()->id);
              
             return response()->view('pagelock.view');
            }
        
        }

        return $next($request);
    }



}
