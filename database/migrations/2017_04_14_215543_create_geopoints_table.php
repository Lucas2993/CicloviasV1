<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeopointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geopoints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('centrality_id')->unsigned()->nullable();
            $table->double('latitude', 15, 8);
            $table->double('length', 15, 8);
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
