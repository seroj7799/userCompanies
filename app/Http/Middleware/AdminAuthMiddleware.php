<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
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
        // Check if the user is authenticated and is an admin
        if (Auth::guard('admin')->check()) {
            return $next($request); // Allow access
        }

        // Redirect to admin login if not authenticated
        return redirect()->route('admin.login')->with('error', 'You must log in as an admin to access this page.');
    }
}
