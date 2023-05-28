<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('room_id');
            $table->string('reservation_type');
            $table->string('date_start');
            $table->string('date_end');
            $table->string('type');
            $table->string('place_pool');
            $table->string('adults')->nullable();
            $table->string('children')->nullable();
            $table->string('functional_hall')->nullable();
            $table->string('inclusions')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
