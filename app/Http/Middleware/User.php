<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            switch ($request->user()->role) {
                case 'user':
                    return $next($request);
                case 'admin':
                    return redirect(route('admin.dashboard'));
                case 'rt':
                    return redirect(route('rt.dashboard'));
                default:
                    return redirect(route('/'));
            }
        }

        return $next($request);
    }
}
