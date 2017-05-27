<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Services\DataLog;

/**
* Creado por JLDEVIA (14/05/2017)
* Migracion correspondiente a la creación de la tabla "datalogs"
* para implementar la H.U: "Carga de datalog de recorridos".
*/
class CreateDatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('datalog', 150);
            //Estados que puede tener un registro de DataLog
            //GEN: Generado sin errores.
            //ANU: Anulado, se registraron errores al intentar generar el log.
            //REV: Revertido, se revirtio el proceso de carga de datos del log.
            $table->string('estado', 3);
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
        Schema::dropIfExists('datalogs');
    }
}
