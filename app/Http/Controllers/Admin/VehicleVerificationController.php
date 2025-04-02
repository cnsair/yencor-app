<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Enums\VerificationStatus;
use App\Notifications\VehicleApprovedNotification;
use App\Notifications\VehicleRejectedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class VehicleVerificationController extends Controller
{
    private const PAGINATION_LIMIT = 20;
    private const ALLOWED_DOCUMENTS = [
        'vehicle_photo',
        'insurance_document',
        'registration_document'
    ];

    /**
     * Display a listing of vehicles pending verification
     */
    public function index(Request $request): View
    {
        $query = $this->buildVehicleQuery($request);

        $vehicles = $this->paginateResults($query, $request);

        return view('admin.vehicles.verifications.index', [
            'vehicles' => $vehicles,
            'statusOptions' => VerificationStatus::cases(),
            'searchTerm' => $request->search,
            'statusFilter' => $request->status
        ]);
    }

    /**
     * Build the base vehicle query with filters
     */
    private function buildVehicleQuery(Request $request)
    {
        return Vehicle::with(['user', 'verifiedBy'])
            ->when($request->status, function ($q) use ($request) {
                $q->where('verification_status', $request->status);
            })
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('make', 'like', "%{$request->search}%")
                          ->orWhere('model', 'like', "%{$request->search}%")
                          ->orWhere('vin', 'like', "%{$request->search}%")
                          ->orWhereHas('user', function ($userQuery) use ($request) {
                              $userQuery->where('name', 'like', "%{$request->search}%");
                          });
                });
            })
            ->orderBy('created_at', 'desc');
    }

    /**
     * Paginate the query results
     */
    private function paginateResults($query, Request $request)
    {
        return $request->has('pending') 
            ? $query->pendingVerification()->paginate(self::PAGINATION_LIMIT)
            : $query->paginate(self::PAGINATION_LIMIT);
    }

    /**
     * Display the specified vehicle
     */
    public function show(Vehicle $vehicle): View
    {
        $this->authorize('view', $vehicle);

        return view('admin.vehicles.verifications.show', [
            'vehicle' => $vehicle->load(['user', 'verifiedBy']),
            'documentTypes' => self::ALLOWED_DOCUMENTS
        ]);
    }

    /**
     * Approve the specified vehicle
     */
    public function approve(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $this->authorize('approve', $vehicle);

        $validated = $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $vehicle->update([
            'verification_status' => VerificationStatus::APPROVED,
            'verification_notes' => $validated['notes'],
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'is_active' => true,
        ]);

        $vehicle->user->notify(new VehicleApprovedNotification($vehicle));

        return redirect()
            ->route('admin.vehicle-verifications.index')
            ->with('success', __('Vehicle approved successfully'));
    }

    /**
     * Reject the specified vehicle
     */
    public function reject(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $this->authorize('reject', $vehicle);

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $vehicle->update([
            'verification_status' => VerificationStatus::REJECTED,
            'verification_notes' => $validated['reason'],
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'is_active' => false,
        ]);

        $vehicle->user->notify(new VehicleRejectedNotification($vehicle, $validated['reason']));

        return redirect()
            ->route('admin.vehicle-verifications.index')
            ->with('success', __('Vehicle rejected successfully'));
    }

    /**
     * View a vehicle document
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function viewDocument(Vehicle $vehicle, string $document): BinaryFileResponse
    {
        abort_unless(
            in_array($document, self::ALLOWED_DOCUMENTS), 
            404,
            'Invalid document type requested'
        );

        $filePath = $vehicle->$document;

        abort_if(
            empty($filePath) || !Storage::disk('public')->exists($filePath), 
            404,
            'Document not found'
        );

        return response()->file(Storage::disk('public')->path($filePath));
    }
}