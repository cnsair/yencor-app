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
     //   $riders = User::where('role', 'rider')->get();
     $riders = User::where('is_rider', 1)->get();   // rider is 1
        return view('admin.riders.index', compact('riders'));
    }

    

    // Update rider status
    public function updateStatus(Request $request, $id)
    {
        // Get the currently logged-in admin
        $admin = auth()->user();
    
        // Find the intended rider
        $rider = User::findOrFail($id);
    
        // Ensure only riders are being updated, not admins
        if ($rider->is_admin) {
            return back()->with('error', 'You cannot update an admin!');
        }
    
        // Ensure the provided status is valid
        $validStatuses = ['1', '2', '3', '4']; // 1: Active, 2: Deactivated, 3: Suspended, 4: Banned
        if (!in_array($request->status, $validStatuses)) {
            return back()->with('error', 'Invalid status selected.');
        }
    
        // Update rider's status
        $rider->status = $request->status;
        $rider->save();
    
        // Ensure the admin remains active (prevent self-banning)
        if ($admin->is_admin && $admin->status != 1) {
            $admin->status = 1; // Ensure admin stays active
            $admin->save();
        }
    
        return back()->with('success', 'Rider status updated successfully.');
    }
    

    // Show all rides of a rider
    public function showRides($id)
    {
        $rider = User::findOrFail($id);
        $rides = $rider->rides; // Assuming you have a Ride model with a relation

        return view('admin.riders.rides', compact('rider', 'rides'));
    }
}
