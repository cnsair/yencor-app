<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\User;
use App\Notifications\DriverStatusUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
    /**
     * Display a listing of registered drivers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get only users flagged as drivers
        $drivers = User::where('is_driver', 1)->get();
        return view('admin.driver-registered', compact('drivers'));
    }

    /**
     * Update the status of the specified driver.
     *
     * Allowed status values:
     * 1 = Banned, 2 = Suspended, 3 = Inactive, 4 = Active.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $driverId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $driverId)
    {
        $request->validate([
            'status' => 'required|in:2,3,4',
        ]);
    
        $driver = User::where('is_driver', 1)->findOrFail($driverId);
        $driver->status = $request->input('status');
        $driver->save();
    
        $driver->notify(new DriverStatusUpdated($driver->status));
    
        return redirect()->back()->with('success', 'Driver status updated successfully.');
    }    

    /**
     * Display the details and documents of the specified driver.
     *
     * @param  int  $driverId
     * @return \Illuminate\View\View
     */
    public function show($driverId)
    {
        $driver = User::where('is_driver', 1)->findOrFail($driverId);
        return view('admin.driver-registered-details', compact('driver'));
    }        
    
}
