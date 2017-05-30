<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\DataLog;
use App\Services\CicloviasHelper;

class DataLogTest extends TestCase
{

    //use DatabaseMigrations;
    /**
     * Test de carga masiva de recorridos mediante archivo CSV.
     * @test
     * @return void
     */
    public function cargarCSVRecorridos()
    {
      $datalog = new DataLog(new CicloviasHelper);
      $result = $datalog->cargarRecorridosCSV('/home/jldevia/recorridos_1.csv');

      //prueba
      $this->assertTrue($result);
    }
}
