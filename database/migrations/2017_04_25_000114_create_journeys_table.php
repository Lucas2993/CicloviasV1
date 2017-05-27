<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Phaza\LaravelPostgis\Schema\Blueprint;

class CreateJourneysTable extends Migration
{
    /**
     * Creado por JLDEVIA (25/04/2017)
     * Run migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 200);
            $table->integer('ponderacion');
            $table->linestring('geom');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Creado por JLDEVIA (25/04/2017)
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journeys');
    }
}
