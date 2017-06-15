<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RankingTrips;

class TripsRankingedController extends Controller{

  private $rankHelperService;

  //Se declara contructor para inyectar service "CicloviasHelper"
  function __construct (RankingTrips $helper){
      $this->rankHelperService = $helper;
  }

  /**
    * Devuelve los tramos interseccion de un cjto de recorridos
    * @return Response
    */
  public function tramosRanking(){
      return $this->rankHelperService->getCoordenatesTripsSimil();
  }

}
?>
