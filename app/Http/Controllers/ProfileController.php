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
            'firstname' => ['required', 'string', 'regex:/^\S*$/u', 'max:30'],
            'lastname' => ['required', 'string', 'regex:/^\S*$/u', 'max:30'],
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore(Auth::user())],
            'phone' => ['string', 'max:25', Rule::unique('users')->ignore(Auth::user())],
            'gender' => ['string', 'max:20'],
            'biography' => ['string', 'max:500'],
            'd_o_b' => ['string', 'max:20'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:5120'],
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
