<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rider;
use Illuminate\Support\Facades\Auth;

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
        $oldStatus = $rider->status;
        $newStatus = (int) $request->status;

        // Only proceed if the user is a rider
        if ($rider->is_rider) {
            $rider->status = $newStatus;
            $rider->save();

            if ($newStatus != 4 && $oldStatus == 4) {
                return back()->with('failure', 'Rider account is not active.');
            }

            return back()->with('success', 'Rider status updated successfully!');
        }

        return back()->with('error', 'This user is not a rider.');
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
