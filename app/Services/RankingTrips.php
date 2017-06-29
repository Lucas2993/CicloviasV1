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

    echo"Paso la prueba 1\n";

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

    // echo "\n distancia rec 2 = ".$auxDistance->km_trips;

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
        array_push($aux, $trip);
    }

    return $aux;
  }

  public function getCoordenatesTripsSimil(){
    // obtenemos los tramos interseccion con su frecuencia y densidad
    $query = "SELECT count(trips.idUser) as idU, SUM((trips.frec)::int) as frequency, ST_AsGeoJSON(tramos.geomInter) as tramo
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
      // echo "geom del tramo: ".$tramoRanking->tramo."\n";
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

  // devuelve los tramos interseccion de un cjto de recorridos, null en el caso de que no existan
  // tramos interseccion
  public function getTramosRanking($idTrips){
    // cjto de recorridos a analizar
    // $arrayIds = array(4,5,6,7,8);
    // $arrayIds = array(4,5,6);

    // si no hay recorridos para analizar
    if(empty($idTrips)){
      return array();
    }

    // $tramosRankinged = null;
    $tramosRankinged = array();

    $arrayIds = $idTrips;
    // foreach ($variable as $key => $value) {
      # code...
      // echo("array : ".count($arrayIds));
    // }

    // obtenemos los tramos interseccion con su frecuencia y densidad
    $tramosInterseccion = $this->getTramosRankngedBySetTrips($arrayIds);
    // echo "Cant de tramos interseccion ponderados(nuevo): ".count($tramosInterseccion)."\n";

    // si obtenemos trayectos interseccion realizamos su ponderacion
    if((count($tramosInterseccion) > 0)){
      // obtenemos la cantidad de usuarios distintos
      $userTotal = $this->getDistinctUserBySetTrips($arrayIds);
      // echo "cant de usuarios distintos(nuevo): ".$userTotal."\n";

      // obtenemos la frec min y max del cjto de recorridos
      $frequency = $this->getFreqMinMaxBySetTrips($arrayIds);
      $min_frec = $frequency[0];
      $max_frec = $frequency[1];

      // echo "Frec min (nuevo): ".$min_frec." - max (nuevo): ".$max_frec;

      // vamos asignando la ponderacion a los tramos interseccion y creando los trayectos
      // con sus datos para devolverlos desde un servicio
      // $tramosRankinged = array();
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
    }

    // // obtenemos la cantidad de usuarios distintos
    // $userTotal = $this->getDistinctUserBySetTrips($arrayIds);
    // // echo "cant de usuarios distintos(nuevo): ".$userTotal."\n";
    //
    // // obtenemos la frec min y max del cjto de recorridos
    // $frequency = $this->getFreqMinMaxBySetTrips($arrayIds);
    // $min_frec = $frequency[0];
    // $max_frec = $frequency[1];
    //
    // // echo "Frec min (nuevo): ".$min_frec." - max (nuevo): ".$max_frec;
    //
    // // vamos asignando la ponderacion a los tramos interseccion y creando los trayectos
    // // con sus datos para devolverlos desde un servicio
    // $tramosRankinged = array();
    // $idTramosRankinged = 1;
    // foreach ($tramosInterseccion as $tramo) {
    //   // el this lo usamos para llamar una funcion privada
    //   $peso = $this->ponderacion($min_frec, $max_frec, $userTotal, $tramo->frequency,$tramo->idu);
    //   // creamos el tramo con los datos correspondientes
    //   $auxTramo = new \stdClass();
    //   $auxTramo->id = $idTramosRankinged;
    //   $auxTramo->geom = $tramo->tramo;
    //   $auxTramo->ranking = $peso;
    //   $auxTramo->frequency = $tramo->frequency;
    //   $auxTramo->density = $tramo->idu;
    //   // agregamos el tramo a la lista que se va a devolver
    //   array_push($tramosRankinged,$auxTramo);
    //   $idTramosRankinged += 1;
    //   // echo"PESO ponderacion: ".$peso."\n";
    // }
    // // echo "cant de tramos ponderados = ".count($tramosRankinged)."\n";

    return $tramosRankinged;
  }


  // *******************************************************************************************
  // ***************************** METODOS PRIVADOS ******************************************

  // ****************** QUERIES POSTGIS *******************
  // Seleccionamos los tramos inteseccion con sus datos de ponderacion
  // se le debe poder pasar el cjto de recorridos a analizar (4,5,6 --> en este caso) **********
  private function getTramosRanknged(){
    // obtenemos los tramos interseccion con su frecuencia y densidad, puntos de inicio y fin
    $query = "SELECT count(trips.idUser) as idU, SUM((trips.frec)::int) as frequency, ST_AsText(tramos.geomInter) as tramo,
              		ST_X(ST_StartPoint(tramos.geomInter :: geometry)) as lonIni,ST_Y(ST_StartPoint(tramos.geomInter :: geometry)) as latIni,ST_X(ST_EndPoint(tramos.geomInter :: geometry)) as lonFin,ST_Y(ST_EndPoint(tramos.geomInter :: geometry)) as latFin
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
      echo "geom del tramo: ".$tramoRanking->tramo."\n";
      echo "inicio: (".$tramoRanking->lonini.";".$tramoRanking->latini.") - fin : (".$tramoRanking->lonfin.";".$tramoRanking->latfin.")\n";
      // echo "rdo de textGeom: ".$this->createTextLineString($tramoRanking->lonini, $tramoRanking->latini, $tramoRanking->lonfin, $tramoRanking->latfin)."\n";
    }
    echo "frecTramo1: ".($tramosInterseccion[0])->frequency."\n";
    if ($this->tramosContinuos($tramosInterseccion[1], $tramosInterseccion[2])) {
      // echo "Los tramos 2 y 3 son CONTINUOS.\n";
      // echo "Creando union de tramos 2 y 3: ".$this->createTextLineString($tramosInterseccion[1], $tramosInterseccion[2])."\n";
    }

    return $tramosInterseccion;
  }

  // Seleccionamos los tramos inteseccion con sus datos de ponderacion
  private function getTramosRankngedBySetTrips($idTrips){
    // $rangoId = "(4,5,6,7,8)";
    $rangoId = $this->getRangoId($idTrips);
    // echo "rango de ids(interseccion)): ".$rangoId."\n";
    // obtenemos los tramos interseccion con su frecuencia y densidad, puntos de inicio y fin
    //$query = "SELECT count(trips.idUser) as idU, SUM((trips.frec)::int) as frequency, ST_AsText(tramos.geomInter) as tramo,

    //  $query = "SELECT count(trips.idUser) as idU, SUM((trips.frec)::int) as frequency, ST_AsGeoJSON(tramos.geomInter) as tramo,
    $query = "SELECT count(trips.idUser) as idU, SUM((trips.frec)::int) as frequency, ST_AsGeoJSON(tramos.geomInter) as tramo,
              		ST_X(ST_StartPoint(tramos.geomInter :: geometry)) as lonIni,ST_Y(ST_StartPoint(tramos.geomInter :: geometry)) as latIni,ST_X(ST_EndPoint(tramos.geomInter :: geometry)) as lonFin,ST_Y(ST_EndPoint(tramos.geomInter :: geometry)) as latFin
              FROM (SELECT t.user as idUser, t.frequency as frec, t.geom as geom
              	FROM trips t
              	-- WHERE t.id in (4,5,6,7,8)) trips,
                WHERE t.id in ".$rangoId.") trips,
                    (SELECT *
              	FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
              		FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              		     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              			   FROM trips t1, trips t2
              			   -- WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                       WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
              		     (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              		     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              			   FROM trips t1, trips t2
              			   -- WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col1
                       WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col1
              	WHERE ST_GeometryType((col1.geomInter):: geometry) = 'ST_LineString'
              	UNION
              	SELECT DISTINCT(ST_Dump((col2.geomInter)::geometry)).geom as singleGeom
              	FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
              		FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              		     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              			   FROM trips t1, trips t2
              			   -- WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                       WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
              		     (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
              		     FROM (SELECT t1.geom as geom1, t2.geom as geom2
              			   FROM trips t1, trips t2
              			   -- WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col2
                       WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col2
              	WHERE ST_GeometryType((col2.geomInter):: geometry) = 'ST_MultiLineString'
                UNION
                SELECT DISTINCT(ST_Dump(ST_CollectionExtract((col3.geomInter)::geometry, 2))).geom as singleMultiGeom
                FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
                    FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                         FROM (SELECT t1.geom as geom1, t2.geom as geom2
                         FROM trips t1, trips t2
                         -- WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                         WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                         (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                         FROM (SELECT t1.geom as geom1, t2.geom as geom2
                         FROM trips t1, trips t2
                         -- WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col3
                         WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col3
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
      // echo "geom del tramo: ".$tramoRanking->tramo."\n";
      // echo "inicio: (".$tramoRanking->lonini.";".$tramoRanking->latini.") - fin : (".$tramoRanking->lonfin.";".$tramoRanking->latfin.")\n";
      // echo "rdo de textGeom: ".$this->createTextLineString($tramoRanking->lonini, $tramoRanking->latini, $tramoRanking->lonfin, $tramoRanking->latfin)."\n";
    }
    // echo "frecTramo1: ".($tramosInterseccion[0])->frequency."\n";
    // if ($this->tramosContinuos($tramosInterseccion[1], $tramosInterseccion[2])) {
    //   echo "Los tramos 2 y 3 son CONTINUOS.\n";
    //   echo "Creando union de tramos 2 y 3: ".$this->createTextLineString($tramosInterseccion[1], $tramosInterseccion[2])."\n";
    // }

    return $tramosInterseccion;
  }

  // determina la cant de usuarios distintos de un cjto de recorridos analizados
  // se le debe poder pasar el cjto de recorridos a analizar (4,5,6,7,8 --> en este caso) **********
  private function getDistinctUser(){
    // cant de usuarios obtenidos de la DB
    $query = "SELECT count(t.id) as cantUser
              FROM trips t
              WHERE t.id in (4,5,6,7,8)";

    $preQuery = DB::raw($query);
    $cantTotalUserDB = DB::select($preQuery);

    $cantTotalUser = array();
    foreach($cantTotalUserDB as $cantUserDB){
      array_push($cantTotalUser, $cantUserDB);
      $cantDistinctUser = $cantUserDB->cantuser;
    }

    return $cantDistinctUser;
  }

  private function getDistinctUserBySetTrips($idTrips){
    $rangoId = $this->getRangoId($idTrips);
    // echo "rango(UserDist): ".$rangoId."\n";
    // cant de usuarios obtenidos de la DB
    $query = "SELECT count(t.id) as cantUser
              FROM trips t
              WHERE t.id in ".$rangoId;
              // WHERE t.id in (4,5,6,7,8)";

    $preQuery = DB::raw($query);
    $cantTotalUserDB = DB::select($preQuery);

    $cantTotalUser = array();
    foreach($cantTotalUserDB as $cantUserDB){
      array_push($cantTotalUser, $cantUserDB);
      $cantDistinctUser = $cantUserDB->cantuser;
    }

    return $cantDistinctUser;
  }

  // obtenemos las frec min y max del cjto analizado
  // tmb deberia realizar esta accion segun el el cjto de recorridos recibidos ************
  private function getFreqMinMax(){
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

    $frequency = array();
    array_push($frequency, $min_frec);
    array_push($frequency, $max_frec);

    return $frequency;
  }

  private function getFreqMinMaxBySetTrips($idTrips){
    $rangoId = $this->getRangoId($idTrips);
    // echo "rango(freq): ".$rangoId."\n";
    $query = "SELECT min((tramosRanking.frequency):: int) as minFrec, max((tramosRanking.frequency):: int) as maxFrec
              FROM(SELECT count(trips.idUser) as idU, SUM((trips.frec)::int) as frequency, tramos.geomInter as tramo
                FROM (SELECT t.user as idUser, t.frequency as frec, t.geom as geom
                  FROM trips t
                  -- WHERE t.id in (4,5,6,7,8)) trips,
                  WHERE t.id in ".$rangoId.") trips,
                      (SELECT *
                  FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
                    FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                         FROM (SELECT t1.geom as geom1, t2.geom as geom2
                         FROM trips t1, trips t2
                        --  WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                         WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                         (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                         FROM (SELECT t1.geom as geom1, t2.geom as geom2
                         FROM trips t1, trips t2
                        --  WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col1
                         WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col1
                  WHERE ST_GeometryType((col1.geomInter):: geometry) = 'ST_LineString'
                  UNION
                  SELECT DISTINCT(ST_Dump((col2.geomInter)::geometry)).geom as singleGeom
                  FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
                    FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                         FROM (SELECT t1.geom as geom1, t2.geom as geom2
                         FROM trips t1, trips t2
                        --  WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                         WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                         (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                         FROM (SELECT t1.geom as geom1, t2.geom as geom2
                         FROM trips t1, trips t2
                        --  WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col2
                         WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col2
                  WHERE ST_GeometryType((col2.geomInter):: geometry) = 'ST_MultiLineString'
                  UNION
                  SELECT DISTINCT(ST_Dump(ST_CollectionExtract((col3.geomInter)::geometry, 2))).geom as singleMultiGeom
                  FROM	(SELECT DISTINCT((ST_Intersection(c1.inters, c2.inters))) as geomInter
                      FROM(SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                           FROM (SELECT t1.geom as geom1, t2.geom as geom2
                           FROM trips t1, trips t2
                          --  WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                           WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c1 ,
                           (SELECT DISTINCT( ST_Intersection(inter.geom1, inter.geom2)) as inters
                           FROM (SELECT t1.geom as geom1, t2.geom as geom2
                           FROM trips t1, trips t2
                          --  WHERE t1.id in (4,5,6,7,8) AND t2.id in (4,5,6,7,8) AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col3
                           WHERE t1.id in ".$rangoId." AND t2.id in ".$rangoId." AND ST_Intersects(t1.geom, t2.geom) AND (t1.id <> t2.id)) AS inter) As c2) AS col3
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

    $frequency = array();
    array_push($frequency, $min_frec);
    array_push($frequency, $max_frec);

    return $frequency;
  }

  // pondera un tramo a partir de un cjto de datos analizados
  private function ponderacion($frecMin, $frecMax, $totalUser, $frec, $densidad){
    // factodr de frecuencia
    if($frecMax==$frecMin){
      $facFrec =1;
    }
    else{
    $facFrec = ($frec - $frecMin)/($frecMax - $frecMin);
    }
    // factor de densidad
    $facDensidad = $densidad/$totalUser;
    $peso = intval(70*$facFrec + 30*$facDensidad);

    return $peso;
  }

  // recibe un array con los id de los recorridos seleccionados y devuelve un string
  // con el rango de id para ser incorporado en una consulta
  private function getRangoId($idTrips){
    if(count($idTrips) == 0){
      // no hay rango
      return null;
    }
    $rangoId = "(";
    $ultimoId;

    // vamos agregando los ids al rango
    for ($i=0; $i < count($idTrips) - 1; $i++) {
      $rangoId .= ($idTrips[$i].",");
      // echo "Dato de array recibido: ".($idTrips[$i])."\n";
      // echo "Rdo rango: ".$rangoId."\n";
      $ultimoId = $i;
    }
    if(count($idTrips) == 1){
      $ultimoId = -1;
    }
    // agregamos el ultimo dato al rango
    $rangoId .= $idTrips[$ultimoId + 1].")";

    return $rangoId;
  }

  // *******************************************************************************
  // **************************** UNIFICACION DE TRAMOS ****************************
  // recibe un cjto de tramos ponderados y los junta si es q existen tramos continuos
  private function unionTramos($tramosPonderados){
    // hacemos union de las uniones, mientras hayn uniones y tramos por analizar

    while ($a <= 10) {
      # code...
    }
  }

  // unir tramos
  private function unifyTramos($tramo1, $tramo2){
    $lineCreadted = $this->createTextLineString();
  }

  // determina si los tramos son continuos
  private function tramosContinuos($tramo1, $tramo2){
    // falta ver lo de frecuencia y la densidad (ver como cmparar float)
    if(($tramo1->lonfin == $tramo2->lonini) && ($tramo1->latfin == $tramo2->latini)){
      return True;
    }
    return False;
  }

  // crea un texto de LINESTRING con los datos recibidos
  // private function createTextLineString($lngIni, $latIni, $lngFin, $latFin){
  //   $textLinestring = "LINESTRING(".$lngIni." ".$latIni.",".$lngFin." ".$latFin.")";
  private function createTextLineString($tramo1, $tramo2){
    $textLinestring = "GATO(".$tramo1->lonini." ".$tramo1->latini.",".$tramo2->lonfin." ".$tramo2->latfin.")";
    return $textLinestring;
  }
}
