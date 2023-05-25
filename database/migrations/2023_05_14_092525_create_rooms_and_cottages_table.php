<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsAndCottagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_and_cottages', function (Blueprint $table) {
            $table->id();
            $table->string('room_id')->nullable();
            $table->string('room_name')->nullable();
            $table->string('cottage_name')->nullable();
            $table->string('place_room_cottage')->nullable();
            $table->string('room_cottage_price')->nullable();
            $table->string('room_cottage_image')->nullable();
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
        Schema::dropIfExists('rooms_and_cottages');
    }
}
