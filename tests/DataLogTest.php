<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Services\DataLog;
use App\Services\CicloviasHelper;

class DataLogTest extends TestCase
{

    /**
     * Test de carga masiva de recorridos mediante archivo CSV.
     * @test
     * @return void
     */
    // public function cargarCSVRecorridos()
    // {
    //   $helper = new CicloviasHelper();
    //   $datalog = new DataLog($helper);
    //   $result = $datalog->cargarRecorridosCSV('/home/jldevia/recorridos_8.csv');
    //
    //   //prueba
    //   $this->seeInDatabase('trips', [
    //     'name' => 'Recorrido 9'
    //   ]);
    // }

    // public function testNormalizacionPoint(){
    //   $helper = new CicloviasHelper();
    //   $result = $helper->normalizeGeoPoint(-42.78360629578064, -65.02648830413818);
    //   dd($result[0]->punto);
    //   $this->assertTrue(true);
    // }

    /**
     * Test de recuperacion de datalogs.
     * @test
     * @return void
     */
    public function getDatalogs(){
     $helper = new CicloviasHelper();
     $datalog = new Datalog($helper);
     $result = $datalog->listDatalogs();
     echo($result);
     $this->assertTrue($result!=null);
    }

    /**
    * Test de reversion de un datalog.
    * @test
    * @return void
    */
    public function revertirDatalog(){
      $helper = new CicloviasHelper();
      $datalog = new Datalog($helper);
      $datalog->reverseDatalog(49);

      $this->dontSeeInDatabase('trips', [
        'name'=>'Recorrido 4'
      ]);
    }

}
