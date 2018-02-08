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
        switch ($guard) {
          case 'admin':
            if (Auth::guard($guard)->check()) {
              return redirect()->route('admin');
            }
            break;

          case 'president':
            if (Auth::guard($guard)->check()) {
              return redirect()->route('president');
            }
            break;

          case 'vpaa':
            if (Auth::guard($guard)->check()) {
              return redirect()->route('vpaa');
            }
            break;

          case 'dean':
            if (Auth::guard($guard)->check()) {
              return redirect()->route('dean');
            }
            break;


          default:
            if (Auth::guard($guard)->check()) {
              return redirect()->route('/');
            }
            break;
        }
        return $next($request);
    }
}
