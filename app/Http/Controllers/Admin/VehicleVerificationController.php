<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Enums\VerificationStatus;
use App\Notifications\VehicleApprovedNotification;
use App\Notifications\VehicleRejectedNotification;
use App\Notifications\VehicleChangesRequestedNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VehicleVerificationController extends Controller
{
    use AuthorizesRequests;

    private const PAGINATION_LIMIT = 20;
    private const ALLOWED_DOCUMENTS = [
        'vehicle_photo',
        'insurance_document',
        'registration_document'
    ];

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Vehicle::class);

        $query = $this->buildVehicleQuery($request);
        $vehicles = $this->paginateResults($query, $request);

        return view('admin.vehicles.verifications.index', [
            'vehicles' => $vehicles,
            'statusOptions' => VerificationStatus::cases(),
            'searchTerm' => $request->search,
            'statusFilter' => $request->status
        ]);
    }

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
                          ->orWhere('license_plate', 'like', "%{$request->search}%")
                          ->orWhereHas('user', function ($userQuery) use ($request) {
                              $userQuery->where('name', 'like', "%{$request->search}%")
                                       ->orWhere('email', 'like', "%{$request->search}%");
                          });
                });
            })
            ->orderBy('created_at', 'desc');
    }

    private function paginateResults($query, Request $request)
    {
        return $request->has('pending') 
            ? $query->pendingVerification()->paginate(self::PAGINATION_LIMIT)
            : $query->paginate(self::PAGINATION_LIMIT);
    }

    public function show(Vehicle $vehicle): View
    {
        Gate::authorize('view', $vehicle);
        $vehicle->load(['user', 'verifiedBy']);
        return view('admin.vehicles.verifications.show', [
            'vehicle' => $vehicle,
            'documentTypes' => self::ALLOWED_DOCUMENTS
        ]);
    }

    public function approve(Request $request, Vehicle $vehicle): RedirectResponse
    {
        Gate::authorize('update', $vehicle);

        // Validate only pending vehicles can be approved
        if ($vehicle->verification_status !== VerificationStatus::PENDING) {
            return redirect()
                ->route('admin.vehicle-verifications.show', $vehicle)
                ->with('error', 'Only pending vehicles can be approved.');
        }

        // Update vehicle status
        $vehicle->update([
            'verification_status' => VerificationStatus::APPROVED,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'rejection_reason' => null,
            'changes_requested' => null,
            'is_active' => true,
            'verification_notes' => $request->input('notes'),
        ]);

        // Send notification
        try {
            $vehicle->user->notify(new VehicleApprovedNotification($vehicle));
            $message = 'Vehicle approved and driver notified successfully';
        } catch (\Exception $e) {
            \Log::error("Failed to send approval notification: " . $e->getMessage());
            $message = 'Vehicle approved but notification failed to send';
        }

        return redirect()
            ->route('admin.vehicle-verifications.index', ['pending' => true])
            ->with('success', $message);
    }

    public function reject(Request $request, Vehicle $vehicle): RedirectResponse
    {
        Gate::authorize('update', $vehicle);

        $validated = $request->validate([
            'reason' => 'required|string|min:10|max:500',
            'send_email' => 'sometimes|boolean'
        ]);

        // Update vehicle status
        $vehicle->update([
            'verification_status' => VerificationStatus::REJECTED,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'rejection_reason' => $validated['reason'],
            'changes_requested' => null,
            'is_active' => false,
        ]);

        // Send notification if requested
        if ($request->boolean('send_email', true)) {
            try {
                $vehicle->user->notify(new VehicleRejectedNotification($vehicle, $validated['reason']));
                $message = 'Vehicle rejected and driver notified successfully';
            } catch (\Exception $e) {
                \Log::error("Failed to send rejection notification: " . $e->getMessage());
                $message = 'Vehicle rejected but notification failed to send';
            }
        } else {
            $message = 'Vehicle rejected (notification not sent)';
        }

        return redirect()
            ->route('admin.vehicle-verifications.index', ['pending' => true])
            ->with('success', $message);
    }

    public function requestChanges(Request $request, Vehicle $vehicle): RedirectResponse
    {
        Gate::authorize('update', $vehicle);

        $validated = $request->validate([
            'changes_requested' => 'required|string|min:10|max:500',
            'send_email' => 'sometimes|boolean'
        ]);

        // Update vehicle status
        $vehicle->update([
            'verification_status' => VerificationStatus::CHANGES_REQUESTED,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'changes_requested' => $validated['changes_requested'],
            'rejection_reason' => null,
        ]);

        // Send notification if requested
        if ($request->boolean('send_email', true)) {
            try {
                $vehicle->user->notify(new VehicleChangesRequestedNotification(
                    $vehicle, 
                    $validated['changes_requested']
                ));
                $message = 'Changes requested and driver notified successfully';
            } catch (\Exception $e) {
                \Log::error("Failed to send changes notification: " . $e->getMessage());
                $message = 'Changes requested but notification failed to send';
            }
        } else {
            $message = 'Changes requested (notification not sent)';
        }

        return redirect()
            ->route('admin.vehicle-verifications.index', ['pending' => true])
            ->with('success', $message);
    }

    public function viewDocument(Vehicle $vehicle, $document)
    {
        Gate::authorize('view', $vehicle);

        $allowedDocuments = ['vehicle_photo', 'insurance_document', 'registration_document'];
        if (!in_array($document, $allowedDocuments)) {
            abort(404, 'Invalid document type');
        }

        $path = $vehicle->$document;
        
        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'Document not found');
        }

        if (request()->has('download')) {
            return Storage::disk('public')->download($path);
        }

        // Determine content type based on file extension
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'pdf' => 'application/pdf'
        ];
        
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $contentType = $mimeTypes[$extension] ?? 'application/octet-stream';

        return response()->file(storage_path('app/public/' . $path), [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }
}