<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckRiderStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            Log::info('User not authenticated, redirecting to login');
            return redirect('/login')->with('error', 'Please log in to access this page.');
        }

        $user = Auth::user();
        Log::info("Checking user ID: {$user->id}, is_rider: {$user->is_rider}, status: {$user->status}, status_type: " . gettype($user->status));

        // Only apply to riders
        if ($user->is_rider) {
            // Convert status to integer to handle string values
            $status = (int) $user->status;
            if ($status !== 4) {
                // Define status-specific error messages
                $statusText = match ($status) {
                    1 => 'banned',
                    2 => 'suspended',
                    3 => 'deactivated',
                    default => 'not active',
                };
                $errorMessage = "Your rider account has been $statusText. Please contact an administrator.";

                Log::info("Rider ID: {$user->id} has non-active status ({$user->status}), logging out");
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', $errorMessage);
            }
            Log::info("Rider ID: {$user->id} is Active (status 4), allowing access");
        } else {
            Log::info("User ID: {$user->id} is not a rider, skipping status check");
        }

        return $next($request);
    }
}
