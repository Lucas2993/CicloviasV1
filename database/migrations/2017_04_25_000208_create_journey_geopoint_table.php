<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJourneyGeopointTable extends Migration
{
    /**
     * Run the migrations.
     * Creado por JLDEVIA (25/04/2017).
     * @return void
     */
    public function up()
    {
        Schema::create('geo_point_journey', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('journey_id');
            $table->unsignedInteger('geo_point_id');
            $table->timestamps();
            //Foreing key
            $table->foreign('geo_point_id')->references('id')
                    ->on('geo_points');
            $table->foreign('journey_id')->references('id')
                    ->on('journeys');
        });
    }

    /**
     * Reverse the migrations.
     * Creado por JLDEVIA (25/04/2017).
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journey_geopoint');
    }
}
