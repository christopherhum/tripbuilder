<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * Author: Christopher Hum
 * Date: September 17, 2017
 *
 * Class CreateFlightTable
 *
 * Creates a database migration to be made into flight table model
 */
class CreateFlightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('airport_from');
            $table->string('airport_to');
            $table->integer('trip_id')->unsigned();


        });

        Schema::table('flights', function(Blueprint $table){
            $table->foreign('trip_id')->references('id')->on('trips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
