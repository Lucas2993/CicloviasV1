<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name', 100);
          $table->string('description', 200);
          $table->string('bicyclist', 50);
          $table->string('day_time', 50);
          $table->double('distance_km', 5, 2);
          $table->unsignedInteger('datalog_id')->nullable();
          $table->timestamps();
          $table->foreign('datalog_id')->references('id')
                  ->on('datalogs')->onDelete('cascade');;
                  //data 5 14
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
