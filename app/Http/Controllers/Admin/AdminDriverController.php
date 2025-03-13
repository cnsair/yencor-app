<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminDriver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDriverController extends Controller
{
    public function index()
    {
        $drivers = AdminDriver::with('user')->paginate(10);
        return view('admin.driver-registered', compact('drivers'));
    }

    public function show($id)
    {
        $driver = AdminDriver::findOrFail($id);
        return view('admin.driver-registered.show', compact('driver'));
    }

    public function updateStatus(Request $request, $id)
    {
        $driver = AdminDriver::findOrFail($id);

        $request->validate([
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $driver->status = $request->status;
        $driver->save();

        return redirect()->route('driver-registered')->with('success', 'Driver status updated successfully.');
    }
}
