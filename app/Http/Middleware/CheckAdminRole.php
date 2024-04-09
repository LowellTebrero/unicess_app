<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user has either "admin" or "super-admin" role
            if (Auth::user()->hasAnyRole(['admin', 'super-admin'])) {
                // User has required role, allow access to the route
                return $next($request);
            }
        }

        // User does not have required role, redirect or return an error response
        return redirect()->route('access.denied'); // Or any other action you prefer
    }
}