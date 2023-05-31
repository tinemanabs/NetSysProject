<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseAndRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_and_rentals', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_description');
            $table->string('item_price');
            $table->string('item_count');
            $table->string('item_image');
            $table->string('is_rental');
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
        Schema::dropIfExists('purchase_and_rentals');
    }
}
