<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RiderManagementController extends Controller
{
    public function index()
    {
        $riders = User::where('is_rider', 1)->get();
        return view('admin.riders.riderinfo', compact('riders'));
    }

    public function updateStatus(Request $request, User $rider)
    {
        $request->validate(['status' => 'required|in:1,2,3,4']);
        $newStatus = (int) $request->status; // New status being set

        // Only proceed if the user is a rider
        if (!$rider->is_rider) {
            return back()->with('error', 'This user is not a rider.');
        }


        try {
            $rider->status = $newStatus;
            $rider->save();

            $statusText = match ($newStatus) {
                1 => 'Banned',
                2 => 'Suspended',
                3 => 'Deactivated',
                4 => 'Active',
                default => 'Unknown',
            };

            return back()->with('success', "Rider status updated to $statusText successfully!");
        } catch (\Exception $e) {
            Log::error('Failed to update rider status: ' . $e->getMessage());
            return back()->with('error', 'Failed to update rider status. Please try again.');
        }
    }

    public function showRides(User $rider)
    {
        if (!$rider->is_rider) {
            return back()->with('error', 'This user is not a rider.');
        }
        $rides = Rider::where('user_id', $rider->id)->get();
        return view('admin.riders.rides', compact('rider', 'rides'));
    }
}
