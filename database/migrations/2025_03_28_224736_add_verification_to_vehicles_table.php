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
                'rejected' ,
                'changes_requested'
                    
            ])->default('pending')
              ->after('is_active')
              ->comment('Tracks document verification state');

           
            $table->text('verification_notes')
                  ->nullable()
                  ->after('verification_status')
                  ->comment('Required if status=rejected');

           
            $table->unsignedBigInteger('verified_by')
                  ->nullable()
                  ->after('verification_notes')
                  ->comment('Admin user who verified');

           
            $table->timestamp('verified_at')
                  ->nullable()
                  ->after('verified_by');

           
            $table->foreign('verified_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('SET NULL'); 
                  
           
            $table->index('verification_status');
            $table->index('user_id');
            $table->index('verified_by');
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
           
            $table->dropIndex(['verified_by']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['verification_status']);
            
         
            $table->dropForeign(['verified_by']);
            $table->dropColumn([
                'verification_status',
                'verification_notes',
                'verified_by',
                'verified_at'
            ]);
        });all my 
    }
};