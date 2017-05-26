<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Phaza\LaravelPostgis\Schema\Blueprint;

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
            $table->string('user', 50);
            $table->date('time');
            $table->time('duration');
            $table->double('distance_km', 5, 2);
            $table->linestring('geom');
            $table->unsignedInteger('datalog_id')->nullable();
            $table->foreign('datalog_id')
                  ->references('id')->on('datalogs')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('trips');
    }
}
