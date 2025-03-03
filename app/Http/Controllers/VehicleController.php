<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('driver.register-vehicle');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $vehicle )
    {
        $vehicle = Vehicle::find($vehicle);
        $vehicle->delete();

        // Delete associated uploaded files from storage
        if ($vehicle->vehicle_photo && Storage::disk('public')->exists($vehicle->vehicle_photo)) {
            Storage::disk('public')->delete($vehicle->vehicle_photo);
        }
    
        if ($vehicle->insurance_document && Storage::disk('public')->exists($vehicle->insurance_document)) {
            Storage::disk('public')->delete($vehicle->insurance_document);
        }
    
        if ($vehicle->registration_document && Storage::disk('public')->exists($vehicle->registration_document)) {
            Storage::disk('public')->delete($vehicle->registration_document);
        }

        return Redirect()->back()->with('status', 'success');
    }
}
