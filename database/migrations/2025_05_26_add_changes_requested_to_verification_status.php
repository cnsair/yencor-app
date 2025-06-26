<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->enum('verification_status', [
                'pending',
                'approved',
                'rejected',
                'changes_requested'
            ])->default('pending')
              ->comment('Tracks document verification state')
              ->change();
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->enum('verification_status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending')
              ->comment('Tracks document verification state')
              ->change();
        });
    }
};