<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Journey;

class JourneyService {


  private $clvHelper;

  function __construct(CicloviasHelper $helper){
    $this->clvHelper = $helper;
  }

  /*
  * Metodo que genera (y persiste en la BD) trayectos a partir de un conjunto de
  * recorridos. El conjunto de recorridos se toman a partir del datalog pasado como
  * parámetro o todos los recorridos registrados si no se especifica un datalog ($datalog_id = null)
  */
  public function generateJourneysFromTrips($datalog_id, $prmt1_form){
    $tripsIntersected = $this->getTripsIntersected($datalog_id, $prmt1_form);

    foreach($tripsIntersected as $reg){
      $this->registerJourney($reg, $datalog_id);
    }

  }

  /*
  * Función que devuelve los tramos que se intersectan
  * de un conjunto de recorridos pertenecientes a un datalog.
  */
  private function getTripsIntersected($datalog_id, $prmt1_form){

    $datalog_id = is_null($datalog_id)?'null':$datalog_id;

    //$formula = 'ST_Length(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography)>= ('.$prmt1_form.' * //cv_minimo(t1.distance_mts, t2.distance_mts))';

    $resultQry = DB::select('select distinct on(ST_CollectionExtract(ST_Intersection(t1.geom,  t2.geom)::geometry,2))
        ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2) as intersection,
        cv_frequency_journey(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography, ?) as frequency,
        ST_Length(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography) as length
        from trips t1, trips t2
        where t1.id <> t2.id
        and ST_Intersects(t1.geom, t2.geom)
        and t1.datalog_id = COALESCE(?, t1.datalog_id) and t2.datalog_id = COALESCE(?, t2.datalog_id)
        and ST_Length(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography)>= (? * cv_minimo(t1.distance_mts, t2.distance_mts))', [$datalog_id, $datalog_id, $datalog_id, $prmt1_form]);

    return $resultQry;
  }

  private function registerJourney($reg, $datalog_id){
    $newJourney = new Journey();

    $id = $this->clvHelper->generateTimeStampID();
    $newJourney->name = 'Trayecto '.$id;
    $newJourney->description = 'Trayecto generado a partir del datalog: '.$datalog_id;
    $newJourney->geom = $reg->intersection;
    $newJourney->ponderacion = $reg->frequency;
    $newJourney->distance_mts = $reg->length;
    $newJourney->ref_datalog = $datalog_id;

    return $newJourney->save();
  }


}//JourneyService
