<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_driver', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('vehicle')->nullable();
            $table->decimal('payment', 10, 2)->nullable();
            $table->string('pick_up')->nullable();
            $table->string('destination')->nullable();
            $table->boolean('completed')->default(false);
            $table->string('license_number')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('inactive'); // Added field
            $table->timestamps();

            if (Schema::hasTable('users')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_driver');
    }
    
};
