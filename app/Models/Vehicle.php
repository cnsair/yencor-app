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
        'insurance_expiration' => 'datetime:Y-m-d',
        'license_expiration' => 'datetime:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'verified_at' => 'datetime',
        'is_active' => 'boolean',
        'verification_status' => VerificationStatus::class,
    ];

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year_of_manufacture',
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

    public function scopePendingVerification($query)
    {
        return $query->where('verification_status', VerificationStatus::PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('verification_status', VerificationStatus::APPROVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('verification_status', VerificationStatus::REJECTED);
    }

    public function getDocumentStatusAttribute(): array
    {
        return [
            'vehicle_photo' => !empty($this->vehicle_photo),
            'insurance_document' => !empty($this->insurance_document),
            'registration_document' => !empty($this->registration_document),
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
            'is_active' => true,
        ]);
    }

    public static function validationRules(?int $vehicleId = null): array
    {
        return [
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
    }
}