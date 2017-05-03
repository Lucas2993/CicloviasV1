<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripGeopointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_point_trip', function (Blueprint $table) {
          $table->integer('geo_point_id')->unsigned()->nullable();
          $table->integer('trip_id')->unsigned()->nullable();
          $table->foreign('geo_point_id')->references('id')
          ->on('geo_points')->onDelete('cascade');
          $table->foreign('trip_id')->references('id')
                                      ->on('trips')->onDelete('cascade');
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
        Schema::dropIfExists('trip_geopoint');
    }
}
