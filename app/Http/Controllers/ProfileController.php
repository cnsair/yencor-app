<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'firstname' => ['required', 'string', 'regex:/^[\p{L}\p{N}@_.-]*$/u', 'max:30'],
            'lastname' => ['required', 'string', 'regex:/^[\p{L}\p{N}@_.-]*$/u', 'max:30'],
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore(Auth::user())],
            'phone' => ['required', 'string', 'regex:/^\S*$/u', 'max:25', Rule::unique('users')->ignore(Auth::user())],
            'gender' => ['nullable','string', 'max:20'],
            'biography' => ['nullable','string', 'min:10', 'max:1000'],
            'd_o_b' => ['nullable','string', 'max:20'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:5120'],
            'admin_role' => ['nullable', 'string', 'max:40'],
        ]);

        // Update the user's profile using Jetstream's UpdateUserProfileInformation class
        (new UpdateUserProfileInformation)->update(Auth::user(), $request->all());

        // if ($update){
            // Redirect back with success message
            return back()->with('status', 'success');
        // }else{
            // Redirect back with success message
            // return back()->with('status', 'failed');
        // }

        // Redirect back with success message
        // return back()->with('status', 'success');
    }
}
