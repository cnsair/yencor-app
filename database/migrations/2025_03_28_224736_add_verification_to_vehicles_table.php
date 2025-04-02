<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->after('is_active');
            $table->text('verification_notes')->nullable()->after('verification_status');
            $table->unsignedBigInteger('verified_by')->nullable()->after('verification_notes');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
            
            $table->foreign('verified_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn([
                'verification_status',
                'verification_notes',
                'verified_by',
                'verified_at'
            ]);
        });
    }
};