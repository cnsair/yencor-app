<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RiderManagementController extends Controller
{
    // Show all riders
    public function index()
    {
        $riders = User::where('is_rider', 1)->get(); // Fetch only riders
        return view('admin.riders.index', compact('riders'));
    }

    // Update rider status (Activate, Deactivate, Suspend, Ban)
    public function updateStatus(Request $request, $id)
    {
        $rider = User::findOrFail($id);
        $rider->status = $request->status; // 1 = Active, 2 = Deactivated, 3 = Suspended, 4 = Banned
        $rider->save();

        return back()->with('success', 'Rider status updated successfully.');
    }

    // Show all rides made by a rider
    public function showRides($id)
    {
        $rider = User::findOrFail($id);
        $rides = $rider->rides; // Assuming a rides() relationship exists in User model

        return view('admin.riders.rides', compact('rider', 'rides'));
    }
}
