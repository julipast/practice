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
        Schema::create('users_cars', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_id');
            $table->index('user_id','users_cars_user_idx');
            $table->index('car_id','users_cars_car_idx');
            $table->foreign('car_id','users_cars_car_fk')->on('cars')->references('id');
            $table->foreign('user_id','users_cars_user_fk')->on('users')->references('id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_cars');
    }
};
