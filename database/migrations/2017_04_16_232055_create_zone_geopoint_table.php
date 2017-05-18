<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneGeopointTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('geo_point_zone', function (Blueprint $table) {
            $table->integer('geo_point_id')->unsigned()->nullable();
            $table->integer('zone_id')->unsigned()->nullable();
            $table->foreign('geo_point_id')->references('id')
            ->on('geo_points')->onDelete('cascade');
            $table->foreign('zone_id')->references('id')
                                        ->on('zones')->onDelete('cascade');
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
        Schema::dropIfExists('geo_point_zone');
    }
}
