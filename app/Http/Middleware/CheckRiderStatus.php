<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRiderStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please log in to access this page.');
        }

        $user = Auth::user();

        // Only apply to riders
        if ($user->is_rider) {
            // If rider's status is not Active (4), log them out
            if ($user->status != 4) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Your rider account is not active. Please contact an administrator.');
            }
        }

        return $next($request);
    }
}
