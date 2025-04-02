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
        return $user->isAdmin() || $user->id === $vehicle->user_id
            ? Response::allow()
            : Response::deny('You do not have permission to view this vehicle.');
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
        return $user->id === $vehicle->user_id || $user->isAdmin()
            ? Response::allow()
            : Response::deny('You can only edit your own vehicles.');
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
        return $user->isAdmin() && $vehicle->verification_status === VerificationStatus::PENDING
            ? Response::allow()
            : Response::deny('Only administrators can approve pending vehicles.');
    }

    /**
     * Determine whether the user can reject the vehicle.
     */
    public function reject(User $user, Vehicle $vehicle): Response
    {
        if (!$user->isAdmin()) {
            return Response::deny('Only administrators can reject vehicles.');
        }

        if ($vehicle->verification_status !== VerificationStatus::PENDING) {
            return Response::deny('Only pending vehicles can be rejected.');
        }

        if ($vehicle->verified_by === $user->id) {
            return Response::deny('You cannot reject a vehicle you verified.');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can request changes for the vehicle.
     */
    public function requestChanges(User $user, Vehicle $vehicle): Response
    {
        return $user->isAdmin() && $vehicle->verification_status === VerificationStatus::PENDING
            ? Response::allow()
            : Response::deny('Only administrators can request changes for pending vehicles.');
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
}