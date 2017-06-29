<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
  public function tramosRanking( $pondMin, $pondMax){
    $query = "SELECT t.id as id
              FROM trips as t";

    $preQuery = DB::raw($query);
    $setTrips = DB::select($preQuery);
    $aux = array();
    foreach($setTrips as $trip){
        array_push($aux, $trip->id);
    }
    // echo("consulta : ".count($aux));
    // var_dump($aux);
    $tramos = $this->rankHelperService->getTramosRanking($aux);

    $tramosAceptados= array() ;
    foreach($tramos as $tramo){
      // var_dump($tramo);
      if($tramo->ranking >= $pondMin && $tramo->ranking <= $pondMax){
        array_push($tramosAceptados, $tramo);
      }
    }

      return $tramosAceptados;
  }

  public function tramosRankingBySetTrips($idTrips){
    // return $this->rankHelperService->getTramosRanking($idTrips);
  }

}
