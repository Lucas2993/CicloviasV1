<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Trip;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;

class DataLog {

  private $clvHelper;

  function __construct(CicloviasHelper $helper){
    $this->clvHelper = $helper;
  }

  // function __construct(){
  //   $this->$clvHelper = new CicloviasHelper();
  //
  // }

  /**
  * Carga masiva de recorridos por medio de archivos csv.
  */
  public function loadTripsFromCSV($path){
    $arch = fopen($path, 'r');
    if ($arch  !== false) {
      DB::transaction(function () use($arch){
        //Se registra el log en la tabla "Datalog"
        $log_id = $this->generateLogID();
        $id_datalog = DB::table('datalogs')->insertGetId(
          [
            'datalog' => $log_id,
            'estado' => 'GEN',
            'created_at' =>date('Y-m-d H:i:s')
          ]
        );
        while (($linea = fgetcsv($arch, 1000)) !== false) {
          $newTrip = new Trip();
          $newTrip->name = $linea[0];
          $newTrip->description = $linea[1];
          $newTrip->user = $linea[2];
          $newTrip->time = $linea[3];
          $newTrip->duration = $linea[4];
          $cant_puntos = $linea[5];
          $points = array();
          for($i=1; $i <= $cant_puntos; $i++){
            $linea = fgetcsv($arch, 1000);
            if($linea !== false){
                $point = new Point($linea[0], $linea[1]);
            }
            $points[]=$point;
          }
          $newTrip->geom = new LineString($points);
          $this->registerTrip($newTrip, $id_datalog);
        }
      });
      $exito = true;
    }else{
      $exito = false;
    }
    fclose($arch);
    return $exito;
  }

  /*
  * Revierte el proceso de carga del datalog
  */
  public function reverseDatalog($id_datalog){
    DB::transaction(function() use($id_datalog){
      //Se eliminan los recorridos cargados
      DB::table('trips')->where('datalog_id', '=', $id_datalog)
                        ->delete();

      //Se actualiza estado del registro del datalog a "REV"
      DB::table('datalogs')->where('id','=',$id_datalog)
                          ->update([
                            'estado'=>'REV',
                            'updated_at'=>date('Y-m-d H:i:s')
                          ]);
    });
    
  }

  /*
  * Devuelve el listado de datalogs
  */
  public function listDataLogs(){
    $result = DB::table('datalogs')->get();
    return $result->toJson();
  }

  private function registerTrip($trip, $id_log){
    //Se normaliza el recorrido
    $pointsTrip = $trip->geom;
    $pointsNormalizados = array();
    foreach($pointsTrip as $point){
      $lat = $point->getLat();
      $long = $point->getLng();
      $normalizado = $this->clvHelper->normalizeGeoPoint($lat, $long);
      $newPoint = Point::fromWKT($normalizado[0]->punto);
      $pointsNormalizados[] = $newPoint;
    }
    if (!is_null($pointsNormalizados)) {
      $trip->geom = new LineString($pointsNormalizados);
    }
    //Se calcula distancia del recorrido a guardar
    $distance = $this->clvHelper->tripDistance($trip->points);

    $trip->distance_km = $distance;

    //Se guarda el recorrido en la bd y luego se recupera su id
    $trip->save();
    $trip_id = $trip->getKey();

    //No se dispone de un Model de Datalog por eso se utiliza
    //DB:table() para actualizar el id del datalog del recorrido.
    DB::table('trips')->where('id', '=', $trip_id)
	       ->update(array('datalog_id' => $id_log));

  }

  private function generateLogID(){
    $date = getdate();
    $suma = $date['hours'] + $date['minutes'] + $date['seconds'];
    $result = $date['year']."_".$date['mon']."_".$date['mday']."_".$suma;
    return $result;
  }


}//Fin de la clase
