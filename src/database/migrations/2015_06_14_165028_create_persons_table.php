<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ota_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gender');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('area_code');
            $table->integer('city_code');
            $table->integer('phone');
            $table->string('email');
            $table->timestamp('date_of_birth');
            $table->integer('booking_id');
            $table->integer('person_type');
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
        Schema::table('ota_persons', function (Blueprint $table) {
            Schema::drop('ota_persons');
        });
    }
}
