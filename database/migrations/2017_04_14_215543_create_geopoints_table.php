<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Phaza\LaravelPostgis\Schema\Blueprint;

class CreateGeopointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('geo_points', function (Blueprint $table) {
            $table->increments('id');
            $table->point('geopoint');
            $table->integer('order');
            $table->foreign('centrality_id')
                  ->references('id')->on('centralities')
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
        Schema::dropIfExists('geopoints');
    }
}
