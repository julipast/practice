<?php

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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_id')->nullable();
            $table->index('parking_id','reservations_parking_idx');
            $table->foreign('parking_id','reservations_parking_fk')->on('parkings')->references('id');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index('user_id','reservations_user_idx');
            $table->foreign('user_id','reservations_user_fk')->on('users')->references('id');

            $table->unsignedBigInteger('car_id')->nullable();
            $table->index('car_id','reservations_car_idx');
            $table->foreign('car_id','reservations_car_fk')->on('cars')->references('id');

            $table->double('number_park');
            $table->double('total_cost');
            $table->double('mark')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
