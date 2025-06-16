<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use App\Enums\VerificationStatus;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VehicleVerificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any vehicles.
     */
    public function viewAny(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('You must be an administrator to view vehicle verifications.');
    }

    /**
     * Determine whether the user can view the vehicle.
     */
    public function view(User $user, Vehicle $vehicle): Response
    {
        // Allow admin or vehicle owner to view
        if ($user->isAdmin() || $user->id === $vehicle->user_id) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to view this vehicle.');
    }

    /**
     * Determine whether the user can create vehicles.
     */
    public function create(User $user): Response
    {
        return $user->hasRole('driver')
            ? Response::allow()
            : Response::deny('Only drivers can register vehicles.');
    }

    /**
     * Determine whether the user can update the vehicle.
     */
    public function update(User $user, Vehicle $vehicle): Response
    {
        // Allow admin or vehicle owner to update
        if ($user->id === $vehicle->user_id || $user->isAdmin()) {
            // Prevent updates if vehicle is already approved/rejected
            if ($vehicle->verification_status !== VerificationStatus::PENDING && !$user->isAdmin()) {
                return Response::deny('Cannot update a vehicle that has been verified.');
            }
            return Response::allow();
        }

        return Response::deny('You can only edit your own vehicles.');
    }

    /**
     * Determine whether the user can delete the vehicle.
     */
    public function delete(User $user, Vehicle $vehicle): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('Only administrators can delete vehicles.');
    }

    /**
     * Determine whether the user can approve the vehicle.
     */
    public function approve(User $user, Vehicle $vehicle): Response
    {
        // Must be admin and vehicle must be pending
        if (!$user->isAdmin()) {
            return Response::deny('Only administrators can approve vehicles.');
        }

        if ($vehicle->verification_status !== VerificationStatus::PENDING) {
            return Response::deny('Only pending vehicles can be approved.');
        }

        // Prevent self-approval if already verified
        if ($vehicle->verified_by === $user->id) {
            return Response::deny('You cannot approve a vehicle you previously verified.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can reject the vehicle.
     */
    public function reject(User $user, Vehicle $vehicle): Response
    {
        // Must be admin and vehicle must be pending
        if (!$user->isAdmin()) {
            return Response::deny('Only administrators can reject vehicles.');
        }

        if ($vehicle->verification_status !== VerificationStatus::PENDING) {
            return Response::deny('Only pending vehicles can be rejected.');
        }

        // Prevent self-rejection if already verified
        if ($vehicle->verified_by === $user->id) {
            return Response::deny('You cannot reject a vehicle you previously verified.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can request changes for the vehicle.
     */
    public function requestChanges(User $user, Vehicle $vehicle): Response
    {
        // Must be admin and vehicle must be pending
        if (!$user->isAdmin()) {
            return Response::deny('Only administrators can request changes.');
        }

        if ($vehicle->verification_status !== VerificationStatus::PENDING) {
            return Response::deny('Changes can only be requested for pending vehicles.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can restore the vehicle.
     */
    public function restore(User $user, Vehicle $vehicle): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('Only administrators can restore deleted vehicles.');
    }

    /**
     * Determine whether the user can permanently delete the vehicle.
     */
    public function forceDelete(User $user, Vehicle $vehicle): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('Only administrators can permanently delete vehicles.');
    }

    /**
     * Determine whether the user can download vehicle documents.
     */
    public function downloadDocuments(User $user, Vehicle $vehicle): Response
    {
        // Allow admin or vehicle owner to download documents
        return $user->isAdmin() || $user->id === $vehicle->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to download these documents.');
    }

    
}