<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->double('peso');
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
