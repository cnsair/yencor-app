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
    $validated = $request->validate(Vehicle::validationRules());

    // Handle file uploads
    $filePaths = [];
    foreach (['vehicle_photo', 'insurance_document', 'registration_document'] as $file) {
        if ($request->hasFile($file)) {
            $filePaths[$file] = $request->file($file)->store('vehicle-documents');
        }
    }

    // Create vehicle with PENDING status by default
    $vehicle = auth()->user()->vehicles()->create(array_merge(
        $validated,
        $filePaths
    ));

    return redirect()->route('driver.dashboard')
        ->with('status', 'Vehicle registered successfully! Waiting for verification.');
}

    public function index()
    {
        // Get vehicles for the authenticated driver
        $vehicle_data = Vehicle::where('user_id', auth()->id())->get();
        
        return view('driver.dashboard', [
            'vehicle_data' => $vehicle_data
        ]);
        
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

        /**
     * Display a listing of all vehicles (for the driver dashboard).
     */
    public function showAll()
    {
        $vehicle_data = Vehicle::where('user_id', auth()->id())->get();
        return view('driver.dashboard', compact('vehicle_data'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
