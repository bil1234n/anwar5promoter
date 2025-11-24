<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if the logged-in user's role matches the required role
        if (Auth::user()->role !== $role) {
            // Optional: redirect to a default page if role doesn't match
            return redirect('/'); 
        }

        return $next($request);
    }
}
