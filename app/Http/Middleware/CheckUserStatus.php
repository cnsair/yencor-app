<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->status == 2) { // Deactivated
                Auth::logout();
                return redirect('/login')->withErrors(['error' => 'Your account is deactivated.']);
            } elseif ($user->status == 3) { // Suspended
                Auth::logout();
                return redirect('/login')->withErrors(['error' => 'Your account is suspended.']);
            } elseif ($user->status == 4) { // Banned
                Auth::logout();
                return redirect('/login')->withErrors(['error' => 'Your account is banned.']);
            }
        }

        return $next($request);
    }
}
