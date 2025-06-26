<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\VerificationStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class Vehicle extends Model
{
    use HasFactory;

    protected $casts = [
        'verification_status' => VerificationStatus::class,
        'insurance_expiration' => 'datetime:Y-m-d',
        'license_expiration' => 'datetime:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year_of_manufacture',
        'license_plate',
        'license_plate',
        'vin',
        'color',
        'vehicle_type',
        'insurance_provider',
        'insurance_policy_number',
        'insurance_expiration',
        'driver_license_number',
        'license_expiration',
        'vehicle_photo',
        'insurance_document',
        'registration_document',
        'seating_capacity',
        'mileage',
        'is_active',
        'verification_status',
        'verification_notes',
        'verified_by',
        'verified_at',
        'rejection_reason',
        'changes_requested',
    ];

    protected $attributes = [
        'verification_status' => VerificationStatus::PENDING,
        'verification_status' => VerificationStatus::PENDING,
        'is_active' => true,
    ];

    protected $appends = ['document_status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function verificationActivities(): HasMany
    {
        return $this->hasMany(VehicleVerificationActivity::class)->latest();
    }

    public function scopePendingVerification($query)
    {
        return $query->where('verification_status', VerificationStatus::PENDING);
        return $query->where('verification_status', VerificationStatus::PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('verification_status', VerificationStatus::APPROVED);
        return $query->where('verification_status', VerificationStatus::APPROVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('verification_status', VerificationStatus::REJECTED);
    }

    public function getDocumentStatusAttribute(): array
    {
        $disk = config('filesystems.default');
        
        return [
            'vehicle_photo' => $this->vehicle_photo && Storage::disk($disk)->exists($this->vehicle_photo),
            'insurance_document' => $this->insurance_document && Storage::disk($disk)->exists($this->insurance_document),
            'registration_document' => $this->registration_document && Storage::disk($disk)->exists($this->registration_document),
        ];
    }

    public function isApproved(): bool
    {
        return $this->verification_status === VerificationStatus::APPROVED;
    }

    public function markAsVerified(User $verifiedBy, ?string $notes = null): void
    {
        $this->update([
            'verification_status' => VerificationStatus::APPROVED,
            'verified_by' => $verifiedBy->id,
            'verified_at' => now(),
            'verification_notes' => $notes,
            'is_active' => $status === VerificationStatus::APPROVED,
        ]);

        $this->verificationActivities()->create([
            'user_id' => $verifier->id,
            'status' => $status,
            'notes' => $notes
        ]);
    }

    public function markAsApproved(User $verifier, ?string $notes = null): void
    {
        $this->verify($verifier, VerificationStatus::APPROVED, $notes);
    }

    public function markAsRejected(User $verifier, string $notes): void
    {
        $this->verify($verifier, VerificationStatus::REJECTED, $notes);
    }

    public function resetVerification(): void
    {
        $this->update([
            'verification_status' => VerificationStatus::PENDING,
            'verified_by' => null,
            'verified_at' => null,
            'verification_notes' => null,
        ]);
    }

    // Validation
    public static function validationRules(?int $vehicleId = null, bool $isUpdate = false): array
    {
        $rules = [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'vin' => [
                'required',
                'string',
                Rule::unique('vehicles', 'vin')->ignore($vehicleId),
           
            ],
            'year_of_manufacture' => 'required|integer|min:1900|max:'.(date('Y')+1),
            'insurance_expiration' => 'required|date|after:today',
            'license_expiration' => 'required|date|after:today',
            'vehicle_photo' => 'sometimes|file|mimes:jpeg,png,jpg,gif|max:2048',
            'insurance_document' => 'sometimes|file|mimes:pdf,jpeg,png|max:2048',
            'registration_document' => 'sometimes|file|mimes:pdf,jpeg,png|max:2048',
        ];

        if (!$isUpdate) {
            $rules['vehicle_photo'] = 'required|file|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['insurance_document'] = 'required|file|mimes:pdf,jpeg,png|max:2048';
            $rules['registration_document'] = 'required|file|mimes:pdf,jpeg,png|max:2048';
        }

        return $rules;
    }
}
