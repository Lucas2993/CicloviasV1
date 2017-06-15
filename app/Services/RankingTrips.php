<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Services\stdClass;
use App\Models\Centrality;
use App\Models\Trip;
use Phaza\LaravelPostgis\Geometries\LineString;

/**
*
*/
class RankingTrips{

  public function rankingedTrips(){
    // obtenemos todos los recorridos de la base de datos
    // $tripsRecovered = new stdClass();

    $trips = Trip::all();

    return $trips;
  }

  public function rankingedTrips1(){

    $trips = DB::table('trips')
        ->select('trips.*')
        ->where('distance_km', '=', 1)
        ->get();

    echo'Paso la prueba 1';

    return $trips;
  }

  public function rankingedTripsQuery(){
    // $polygon = DB::connection('pgsql')
    // ->select(DB::raw("SELECT row_to_json(fc)
    //      FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
    //      FROM (SELECT 'Feature' As type
    //         , ST_AsGeoJSON(ST_Transform(geom,4326))::json As geometry
    //         , row_to_json((SELECT l FROM (SELECT areal) As l
    //           )) As properties
    //        FROM jbb2013 As lg, (SELECT geom from points where customer_id in (1,2,3) as pts WHERE ST_Intersects(lg.geom, pts.geom) As f )  As fc;")
    //     );

    $query = "SELECT ST_Length(geom) AS km_trips
              FROM trips
              WHERE id = 2";

    // distancia en metros
    $distanceQuery = DB::raw($query);

    $distancesRecovered = DB::select($distanceQuery);

    // Se convierte el tipo de array devuelto por la base de datos a un array convensional.
    $auxDistance = $distancesRecovered[0];

    echo "\n distancia rec 2 = ".$auxDistance->km_trips;

    return $auxDistance->km_trips;
  }

  public function rankingedTripsQuery2(){
    // traemos un cjto de recorridos para analizar
    $query = "SELECT *
              FROM trips
              WHERE id > 3";

    $preQuery = DB::raw($query);
    $setTrips = DB::select($preQuery);

    // Se convierte el tipo de array devuelto por la base de datos a un array convensional.
    $aux = array();
    foreach($setTrips as $trip){
      echo "id trip recuperado: ".$trip->id."\n";
      echo "geom recuperado: ".$trip->geom."\n";
      // echo "coordenadas recuperadas: ".($trip->geom).getCoordenates()."\n";
        array_push($aux, $trip);
    }

    return $aux;
  }

  public function getCoordenatesTripsSimil(){
    // obtenemos los tramos interseccion con su frecuencia y densidad
    $query = "SELECT count(trips.idUser) as idU, SUM((trips.frec)::int) as frequency, tramos.geomInter as tramo
              FROM (SELECT t.user as idUser, t.frequency as frec, t.geom as geom
              	FROM trips t
              	WHERE t.id in (4,5,6,7,8)) trips,
                    (SELECT *
              	FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
              		FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              		     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              			   FROM trips t1, trips t2
              			   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
              		     (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              		     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              			   FROM trips t1, trips t2
              			   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col1
              	WHERE ST_GeometryType((col1.geomInter):: geometry) = 'ST_LineString'
              	UNION
              	SELECT DISTINCT(ST_Dump((col2.geomInter)::geometry)).geom as singleGeom
              	FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
              			FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              				   FROM trips t1, trips t2
              				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
              			     (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              				   FROM trips t1, trips t2
              				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col2
              	WHERE ST_GeometryType((col2.geomInter):: geometry) = 'ST_MultiLineString'
              	UNION
              	SELECT DISTINCT(ST_Dump(ST_CollectionExtract((col3.geomInter)::geometry, 2))).geom as singleMultiGeom
              	FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
              			FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              				   FROM trips t1, trips t2
              				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
              			     (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              				   FROM trips t1, trips t2
              				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col3
              	WHERE ST_GeometryType((col3.geomInter):: geometry) = 'ST_GeometryCollection') tramos
              WHERE (ST_Distance((trips.geom)::geometry, (ST_StartPoint(tramos.geomInter :: geometry))) < 0.00001)
              	AND (ST_Distance((trips.geom)::geometry, (ST_EndPoint(tramos.geomInter :: geometry))) < 0.00001)
              GROUP BY tramos.geomInter";

    $preQuery = DB::raw($query);
    $setTramosRankinged = DB::select($preQuery);

    // pasamos los datos de la DB a datos comunes
    $tramosInterseccion = array();
    foreach($setTramosRankinged as $tramoRanking){
      array_push($tramosInterseccion, $tramoRanking);
      // echo "geom inter: ".$inter->intD;
    }

    // obtenemos la cantidad de usuarios distintos
    $query = "SELECT count(t.id) as cantUser
              FROM trips t
              WHERE t.id in (4,5,6,7,8)";

    $preQuery = DB::raw($query);
    $cantTotalUser = DB::select($preQuery);

    $nroUser = array();
    foreach($cantTotalUser as $cantUser){
      array_push($nroUser, $cantUser);
      $userTotal = $cantUser->cantuser;
      // echo "cant de usuarios: ".$userTotal."\n";
    }

    // obtenemos las frec min y max del cjto analizado
    $query = "SELECT min((tramosRanking.frequency):: int) as minFrec, max((tramosRanking.frequency):: int) as maxFrec
              FROM(SELECT count(trips.idUser) as idU, SUM((trips.frec)::int) as frequency, tramos.geomInter as tramo
              	FROM (SELECT t.user as idUser, t.frequency as frec, t.geom as geom
              		FROM trips t
              		WHERE t.id in (4,5,6,7,8)) trips,
              	      (SELECT *
              		FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
              			FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              				   FROM trips t1, trips t2
              				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
              			     (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              				   FROM trips t1, trips t2
              				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col1
              		WHERE ST_GeometryType((col1.geomInter):: geometry) = 'ST_LineString'
              		UNION
              		SELECT DISTINCT(ST_Dump((col2.geomInter)::geometry)).geom as singleGeom
              		FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
              			FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              				   FROM trips t1, trips t2
              				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
              			     (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              				   FROM trips t1, trips t2
              				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col2
              		WHERE ST_GeometryType((col2.geomInter):: geometry) = 'ST_MultiLineString'
                  UNION
                	SELECT DISTINCT(ST_Dump(ST_CollectionExtract((col3.geomInter)::geometry, 2))).geom as singleMultiGeom
                	FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
                			FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
                				   FROM trips t1, trips t2
                				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                			     (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                			     FROM (SELECT t1.geom as geom1, t2.geom as geom2
                				   FROM trips t1, trips t2
                				   WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col3
                	WHERE ST_GeometryType((col3.geomInter):: geometry) = 'ST_GeometryCollection') tramos
              	WHERE (ST_Distance((trips.geom)::geometry, (ST_StartPoint(tramos.geomInter :: geometry))) < 0.00001)
              		AND (ST_Distance((trips.geom)::geometry, (ST_EndPoint(tramos.geomInter :: geometry))) < 0.00001)
              	GROUP BY tramos.geomInter) as tramosRanking";

    $preQuery = DB::raw($query);
    $rangosFrec = DB::select($preQuery);

    $aux = array();
    foreach($rangosFrec as $frec){
      array_push($aux, $frec);
      $min_frec = $frec->minfrec;
      $max_frec = $frec->maxfrec;
      // echo "frec min: ".$min_frec." - frec max: ".$max_frec."\n";
    }


    // vamos asignando la ponderacion a los tramos interseccion y creando los trayectos
    // con sus datos para devolverlos desde un servicio
    $tramosRankinged = array();
    $idTramosRankinged = 1;
    foreach ($tramosInterseccion as $tramo) {
      // el this lo usamos para llamar una funcion privada
      $peso = $this->ponderacion($min_frec, $max_frec, $userTotal, $tramo->frequency,$tramo->idu);
      // creamos el tramo con los datos correspondientes
      $auxTramo = new \stdClass();
      $auxTramo->id = $idTramosRankinged;
      $auxTramo->geom = $tramo->tramo;
      $auxTramo->ranking = $peso;
      $auxTramo->frequency = $tramo->frequency;
      $auxTramo->density = $tramo->idu;
      // agregamos el tramo a la lista que se va a devolver
      array_push($tramosRankinged,$auxTramo);
      $idTramosRankinged += 1;
      // echo"PESO ponderacion: ".$peso."\n";
    }
    // echo "cant de tramos ponderados = ".count($tramosRankinged)."\n";
    return $tramosRankinged;
  }


  // *******************************************************************************************
  // ***************************** METODOS PRIVADOS ******************************************

  private function ponderacion($frecMin, $frecMax, $totalUser, $frec, $densidad){
    // factodr de frecuencia
    $facFrec = ($frec - $frecMin)/($frecMax - $frecMin);

    // factor de densidad
    $facDensidad = $densidad/$totalUser;

    $peso = 70*$facFrec + 30*$facDensidad;

    return $peso;
  }

}
