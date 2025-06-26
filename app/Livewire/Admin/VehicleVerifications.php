<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Vehicle;
use App\Enums\VerificationStatus;
use App\Notifications\VehicleApprovedNotification;
use App\Notifications\VehicleRejectedNotification;

class VehicleVerifications extends Component
{
    public $vehicles;
    public $reviewing = false;
    public $selectedVehicle;
    public $rejectionReason = '';

    public function mount()
    {
        $this->loadPendingVehicles();
    }

    public function loadPendingVehicles()
    {
        $this->vehicles = Vehicle::where('verification_status', VerificationStatus::PENDING)
                                ->with('user')
                                ->get();
    }

    public function review($vehicleId)
    {
        $this->selectedVehicle = Vehicle::with('user')->find($vehicleId);
        $this->reviewing = true;
    }

    public function resetReview()
    {
        $this->reviewing = false;
        $this->selectedVehicle = null;
        $this->rejectionReason = '';
    }

    public function approve()
    {
        $this->selectedVehicle->update([
            'verification_status' => VerificationStatus::APPROVED,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'is_active' => true,
        ]);

        $this->selectedVehicle->user->notify(new VehicleApprovedNotification($this->selectedVehicle));

        $this->resetReview();
        $this->loadPendingVehicles();
        session()->flash('message', 'Vehicle approved successfully!');
    }

    public function reject()
    {
        $this->validate(['rejectionReason' => 'required|string|min:10|max:500']);

        $this->selectedVehicle->update([
            'verification_status' => VerificationStatus::REJECTED,
            'verification_notes' => $this->rejectionReason,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'is_active' => false,
        ]);

        $this->selectedVehicle->user->notify(new VehicleRejectedNotification(
            $this->selectedVehicle,
            $this->rejectionReason
        ));

        $this->resetReview();
        $this->loadPendingVehicles();
        session()->flash('message', 'Vehicle rejected successfully!');
    }

    public function render()
    {
        return view('livewire.admin.vehicle-verifications');
    }
}