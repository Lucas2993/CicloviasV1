<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('trips_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id')->unsigned()->nullable();
            $table->integer('geo_point_id')->unsigned()->nullable();
            $table->integer('order');
            $table->foreign('trip_id')
                  ->references('id')->on('trips')
                  ->onDelete('cascade');
            $table->foreign('geo_point_id')
                  ->references('id')->on('geo_points')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('trips_points');
    }
}
