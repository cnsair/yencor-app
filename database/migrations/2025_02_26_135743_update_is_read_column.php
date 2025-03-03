<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('guest_messages', function (Blueprint $table) {
            $table->boolean('is_read')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('guest_messages', function (Blueprint $table) {
            $table->enum('is_read', [0,1])->default(0)->change();
        });
    }
};
