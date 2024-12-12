<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogin
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
        if ($request->user() != null && $request->user()->hasRole('sa') || $request->user()->hasRole('manager') ) {
            return $next($request);
        }

        return redirect('/admin_login');
        // return $next($request);
    }
}
