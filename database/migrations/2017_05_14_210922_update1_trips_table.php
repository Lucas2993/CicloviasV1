<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Creado por JLDEVIA (14/05/2017)
* Migracion correspondiente al update de la tabla "trips"
* para implementar la H.U: "Carga de datalog de recorridos".
* Se agrega la columna "distance" para registrar la distancia total del recorrido (distancia manhattan)
* y la foreign key al datalog.
*/
class Update1TripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // if(!Schema::hasColumns('trips',['datalog_id'])){
      //   Schema::table('trips', function (Blueprint $table){
      //     $table->unsignedInteger('datalog_id');
      //     $table->foreign('datalog_id')->references('id')->on('datalogs')->nullable();
      //   });
      // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      // if(Schema::hasColumns('trips',['distance'])){
      //   Schema::table('trips', function (Blueprint $table) {
      //     $table->dropColumn('distance');
      //   });
      // }
      //
      // if(Schema::hasColumns('trips',['datalog_id'])){
      //   Schema::table('trips', function (Blueprint $table) {
      //     $table->dropForeign('trips_datalog_id_foreign');
      //     $table->dropColumn('datalog_id');
      //   });
      // }

    }
}
