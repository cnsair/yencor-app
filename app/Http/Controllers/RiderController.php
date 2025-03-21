<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rider $rider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rider $rider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rider $rider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rider $rider)
    {
        //
    }

    public function dashboard()
    {
        return view('rider.dashboard');
    }
    
    /*  
    public function checkUserStatus()
    private function checkUserStatus()
    {
        if (Auth::check() && Auth::user()->status != 4) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect('/login')->with('error', 'Your account is not active. Please contact an administrator.');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->checkUserStatus()) {
            return $redirect;
        }

        // Your existing dashboard logic
        return view('rider.dashboard');
    }
        */
}
