<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if ($request->user()) {
            switch ($request->user()->role) {
                case 'admin':
                    return $next($request);
                case 'rt':
                    return redirect(route('rt.dashboard'));
                case 'user':
                    return redirect(route('user.dashboard'));
                default:
                    return redirect(route('/'));
            }
        }

        return $next($request);
    }
}
