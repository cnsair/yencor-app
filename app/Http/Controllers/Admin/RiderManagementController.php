<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rider; // Keep this
use Illuminate\Support\Facades\Auth;

class RiderManagementController extends Controller
{
    public function index()
    {
        $riders = User::where('is_rider', 1)->get();
        return view('riders.riderinfo', compact('riders'));
    }

    public function updateStatus(Request $request, User $rider)
{
    $request->validate(['status' => 'required|in:1,2,3,4']);
    $oldStatus = $rider->status;
    $newStatus = (int) $request->status;

    $rider->status = $newStatus;
    $rider->save();

    if ($newStatus != 4 && $oldStatus == 4 && Auth::check() && Auth::id() == $rider->id && !$rider->isAdmin()) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Your account is not active. You have been logged out.');
    }

    return back()->with('success', 'Rider status updated successfully!');
}

    public function showRides(User $rider)
    {
        if (!$rider->is_rider) {
            return back()->with('error', 'This user is not a rider.');
        }
        $rides = Rider::where('user_id', $rider->id)->get(); // Get all rides, not just first
        return view('riders.rides', compact('rider', 'rides'));  //werey codempp
    }
}