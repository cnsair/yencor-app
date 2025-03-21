<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('riders',function (Blueprint $table) { // Change to 'rides'
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('vehicle')->nullable();
            $table->string('pick_up')->nullable();
            $table->string('destination')->nullable();
            $table->string('payment')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('riders');
    }
};