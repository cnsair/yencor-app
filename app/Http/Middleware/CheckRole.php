<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // The role parameter (e.g., "admin", "driver", "rider")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            abort(403, 'Unauthorized access.');
        }

        // Check if the user's role matches the required role
        $userRole = auth()->user()->role;

        if (
            ($role === 'rider' && $userRole != 0) ||
            ($role === 'driver' && $userRole != 1) ||
            ($role === 'admin' && $userRole != 2)
        ) {
            abort(403, 'You do not have the required role.');
        }

        return $next($request);
    }
}