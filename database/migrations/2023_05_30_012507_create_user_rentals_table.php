<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rentals', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('rental_id');
            $table->string('quantity');
            $table->string('price');
            $table->string('item_payment_status')->nullable();
            $table->string('item_payment_image')->nullable();
            $table->boolean('is_returned')->nullable();
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
        Schema::dropIfExists('user_rentals');
    }
}
