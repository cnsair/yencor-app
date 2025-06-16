<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('verified_at');
            $table->text('changes_requested')->nullable()->after('rejection_reason');
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['rejection_reason', 'changes_requested']);
        });
    }
};