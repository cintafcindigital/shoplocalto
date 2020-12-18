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
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }
        switch ($guard) {
        case 'admin':
          if (Auth::guard($guard)->check()) {
            return redirect()->route('admin.dashboard');
          }
          break;
          case 'vendor':
          if (Auth::guard($guard)->check()) {
            return redirect()->route('vendor.dashboard');
          }
          break;
          case 'bride':
          if (Auth::guard($guard)->check()) {
            return redirect()->route('/dashboard');
          }
          break;
          case 'groom':
          if (Auth::guard($guard)->check()) {
            return redirect()->route('/dashboard');
          }
          break;
          default:
          if (Auth::guard($guard)->check()) {
              return redirect('/'); 
          }
          break;
        }

        return $next($request);
    }
}
