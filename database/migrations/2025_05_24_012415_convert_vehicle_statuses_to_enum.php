<?php

use App\Enums\VerificationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ConvertVehicleStatusesToEnum extends Migration
{
    public function up()
    {
        // Convert existing string values to Enum values
        DB::table('vehicles')->where('verification_status', 'pending')
            ->update(['verification_status' => VerificationStatus::PENDING->value]);

        DB::table('vehicles')->where('verification_status', 'approved')
            ->update(['verification_status' => VerificationStatus::APPROVED->value]);

        DB::table('vehicles')->where('verification_status', 'rejected')
            ->update(['verification_status' => VerificationStatus::REJECTED->value]);

        // Handle potential legacy 'changes_requested' if exists
        if (Schema::hasColumn('vehicles', 'verification_status')) {
            $hasChangesRequested = DB::table('vehicles')
                ->where('verification_status', 'changes_requested')
                ->exists();

            if ($hasChangesRequested) {
                DB::table('vehicles')->where('verification_status', 'changes_requested')
                    ->update(['verification_status' => VerificationStatus::CHANGES_REQUESTED->value]);
            }
        }
    }

    public function down()
    {
        // Reverse the conversion if needed
        DB::table('vehicles')->where('verification_status', VerificationStatus::PENDING->value)
            ->update(['verification_status' => 'pending']);

        DB::table('vehicles')->where('verification_status', VerificationStatus::APPROVED->value)
            ->update(['verification_status' => 'approved']);

        DB::table('vehicles')->where('verification_status', VerificationStatus::REJECTED->value)
            ->update(['verification_status' => 'rejected']);

        if (Schema::hasColumn('vehicles', 'verification_status')) {
            $hasChangesRequested = DB::table('vehicles')
                ->where('verification_status', VerificationStatus::CHANGES_REQUESTED->value)
                ->exists();

            if ($hasChangesRequested) {
                DB::table('vehicles')->where('verification_status', VerificationStatus::CHANGES_REQUESTED->value)
                    ->update(['verification_status' => 'changes_requested']);
            }
        }
    }
}