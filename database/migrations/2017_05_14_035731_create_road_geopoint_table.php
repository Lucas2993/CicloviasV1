<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoadGeopointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_point_road', function (Blueprint $table) {
            $table->integer('geo_point_id')->unsigned()->nullable();
            $table->integer('road_id')->unsigned()->nullable();
            $table->foreign('geo_point_id')->references('id')
            ->on('geo_points')->onDelete('cascade');
            $table->foreign('road_id')->references('id')
                                        ->on('roads')->onDelete('cascade');
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
        Schema::dropIfExists('geo_point_road');
    }
}
