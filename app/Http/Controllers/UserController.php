<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model

class UserController extends Controller
{
    /**
     * Update the status of a user.
     *
     * @param Request $request The request object containing the new status.
     * @param int $id The ID of the user to update.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            // Validate the status value
            $request->validate([
                'status' => 'required|in:1,2,3,4', // Ensure status is one of these values
            ]);

            // Find the user by ID or fail with a 404 error
            $user = User::findOrFail($id);

            // Update the user's status
            $user->status = $request->input('status');

            // Save the changes to the database
            $user->save();

            // Return a JSON response indicating success
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error
            // \Illuminate\Support\Facades\Log::info($product);
                \Illuminate\Support\Facades\Log::error('Error updating user status:', [
                    'error' => $e->getMessage(),
                    'user_id' => $id,
                    'status' => $request->input('status'),
                ]);

            // Return a JSON response indicating failure
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}