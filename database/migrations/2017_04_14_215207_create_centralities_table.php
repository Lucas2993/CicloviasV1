<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
// use Phaza\LaravelPostgis\Geometries\Point;


class CreateCentralitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centralities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('location')->nullable()->default(null);
            $table->point('geom');
            $table->timestamps();
        });

    //     Schema::create('centralities', function (Blueprint $table) {
    //      $table->increments('id');
    //      $table->string('name', 100);
    //      $table->string('location')->nullable()->default(null);
    //      $table->point('geom');
    //      $table->timestamps();
    //  });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centralities');
    }
}
