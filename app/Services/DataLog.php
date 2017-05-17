<?php

namespace App\Services;

use App\Models\Trip;
use App\Models\GeoPoint;

class DataLog {

  private $clvHelper;

  function __construct(CicloviasHelper $helper){
    $clvHelper = $helper;
  }

  /**
  * Carga masiva de recorridos por medio de archivos csv.
  */
  public function cargarRecorridosCSV($path){
    $arch = fopen($path, 'r');
    if ($arch  !== false) {
      DB::transaction(function (){
        //Se registra el log en la tabla "Datalog"
        $log_id = $this->generateLogID();
        while (($linea = fgetcsv($arch, 500)) !== false) {
          $newTrip = new Trip();
          $newTrip->name = $linea[0];
          $newTrip->description = $linea[1];
          $cant_puntos = $linea[2];
          $points = array();
          for($i=1; $i <= $cant_puntos; $i++){
            $point = new GeoPoint();
            $linea = fgetcsv($arch, 1000);
            if($linea !== false){
              $point->latitude = $linea[0];
              $point->longitude = $linea[1];
            }
            $points[]=$point;
          }
          $newTrip->points = $points;
          $this->registerTrip($newTrip);
        }
      });
      $exito = true;
    }else{
      $exito = false;
    }
    fclose($arch);
    return $exito;
  }

  // private function registerTrip($trip){
  //
  // }

  private function generateLogID(){
    $date = getdate();
    $suma = $date[hours] + $date[minutes] + $date[seconds];
    $result = $date[year]."_".$date[mon]."_".$date[mday]."_".$Suma;
    return result;
  }


}//Fin de la clase
