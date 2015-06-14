<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
        Schema::create('ota_bookings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('airport_from');
            $table->string('airport_to');
            $table->timestamp('date_arrival');
            $table->timestamp('date_departure');
            $table->string('flight_number');
            $table->string('airline_code');
            $table->integer('price'); // price *100, saving without decimals for better accuracy
            $table->string('row_letter', 1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ota_bookings');
    }
}
