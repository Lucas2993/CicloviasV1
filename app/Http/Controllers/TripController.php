<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Geometry;

use App\Models\Trip;
use App\Models\Road;
use App\Models\Name;
use App\Models\Centrality;
use App\Models\Zone;
use App\Services\CicloviasHelper;
use App\Services\RankingTrips;

// Modos
define('CENTRALITY_START', '1');
define('ROAD_START', '2');
define('ZONE_START', '3');
define('CENTRALITY_END', '4');
define('ROAD_END', '5');
define('ZONE_END', '6');
define('RANDOM_TRIP', '7');
define('RANDOM_MODES', '6');

class TripController extends Controller{
    private $clvHelperService;
    private $rankingTrips;

    //Se declara contructor para inyectar service "CicloviasHelper"
    function __construct (CicloviasHelper $helper, RankingTrips $ranking_trips){
        $this->clvHelperService = $helper;
        $this->rankingTrips = $ranking_trips;
    }

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $Trips = Trip::all();
        return $Trips;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $points = Request::input('points');
        $points_objects = array();
        $distance_completed = 0.0;
        foreach ($points as $point) {
            $new_point = new Point($point[1], $point[0]);
            array_push($points_objects, $new_point);
            if(count($points_objects) > 0){
                $last_point_added = $points_objects[count($points_objects)-1];
                $distance_completed +=  $this->clvHelperService->calculateDistance($last_point_added->getLat(),
                $last_point_added->getLng(),
                $new_point->getLat(),
                $new_point->getLng());
            }
        }
        $name = Name::all()->random(1)->name;
        $new_trip = new Trip();
        $new_trip->name = 'Recorrido 1';
        $new_trip->description = 'Recorrido guardado 1';
        $new_trip->distance_km = $distance_completed;
        $new_trip->user = $name;
        $new_trip->time = date(DATE_RFC2822);
        $new_trip->duration = date("H:i:s");
        $new_trip->geom = new LineString($points_objects);
        $new_trip->frequency = '1';
        $new_trip->save();

        return $new_trip;
    }

    // /**
    // * Update the specified resource in storage.
    // *
    // * @param  int  $id
    // * @return Response
    // */
    // public function update($id) {
    //     $Trip = Trip::find($id);
    //     $Trip->name = Request::input('name');
    //     $Trip->description = Request::input('description');
    //     $Trip->save();
    //
    //     return $Trip;
    // }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id) {
        $Trip = Trip::find($id);

        return $Trip;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Trip::destroy($id);
    }

    /**
    * Devuelve los recorridos cercanos al punto pasado como parámetro.
    *
    * @param  $point(latitude, longitude)
    * @return Response
    */

    // TODO Para corregir...
    public function getCloseToPoint($latitude, $longitude){
    /*    $result = array();

        $lat = $latitude;
        $long = $longitude;

        //Constantes utilizadas para acotar la busqueda de recorridos.
        $min_lat = $lat + 0.0035;
        $max_lat = $lat - 0.0035;
        $min_long = $long + 0.0046;
        $max_long = $long - 0.0046;

        //   $trips = Trip::with(['trips_points' => function($query) use ($min_lat, $max_lat, $min_long, $max_long){
        //       $query->join('geopoints', 'trip_points.geo_point_id', '=', 'geopoints.id')
        //       ->where('geopoints.latitude', '>=', $max_lat)
        //       ->where('geopoints.latitude', '<=', $min_lat)
        //       ->where('geopoints.longitude', '>=', $max_long)
        //       ->where('geopoints.longitude', '<=', $min_long);
        //   }])->get();

        $trips = DB::table('trips')
        ->join('trips_points', 'trips.id', '=', 'trips_points.trip_id')
        ->join('geo_points', 'geo_points.id', '=', 'trips_points.geo_point_id')
        ->select('trips.*')
        ->where('geo_points.latitude', '>=', $max_lat)
        ->where('geo_points.latitude', '<=', $min_lat)
        ->where('geo_points.longitude', '>=', $max_long)
        ->where('geo_points.longitude', '<=', $min_long)
        ->get();
        $aux = array();
        foreach($trips as $trip){
            array_push($aux, Trip::find($trip->id));
        }
        $trips = $aux;

        foreach($trips as $trip){
            $trip_points = $trip->trippoint()->get();
            $points = array();
            foreach($trip_points as $trip_point){
                $point = GeoPoint::find($trip_point->geo_point_id);
                $point->order = $trip_point->order;
                array_push($points, $point);
            }
            foreach($points as $point){
                $distancia = $this->clvHelperService
                ->CalculateDistance($lat, $long, $point->latitude,$point->longitude);
                if ($distancia <= 0.3) {
                    $result[] = $trip;
                    $trip->points = $points;
                    unset($trip->geopoints);
                    break;
                    $trip_points = $trip->trippoint()->get();
                    $points = array();
                    foreach($trip_points as $trip_point){
                        $point = GeoPoint::find($trip_point->geo_point_id);
                        $point->order = $trip_point->order;
                        array_push($points, $point);
                    }
                    $trip->geopoints = $points;

                    foreach($trips as $trip){
                        // $points = $trip->geopoints()->get();
                        $trip_points = $trip->trippoint()->get();
                        $points = array();
                        foreach($trip_points as $trip_point){
                            $point = GeoPoint::find($trip_point->geo_point_id);
                            $point->order = $trip_point->order;
                            array_push($points, $point);
                        }

                        foreach( $points as $point){
                            $distancia = $this->CalculateDistance($lat, $long, $point->latitude, $point->longitude);
                            if ($distancia <= 0.3) {
                                $result[] = $trip;
                                $trip->points = $trip->geopoints;
                                unset($trip->geopoints);
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $result;*/

        //Armado de la query para obtener los recorridos cercanos a un punto
        $query = "SELECT t.id
                  FROM trips t
                  WHERE ST_DWithin(t.geom,St_MakePoint(".$longitude.",".$latitude."),300)";

        $cercanoQuery= DB::raw($query);

        $resultQuery= DB::select($cercanoQuery);

        //Obtengo los id separados.
        $pila= array();
        $longitud = count($resultQuery);

        for ($i=0;$i<$longitud;$i++){

          array_push($pila,$resultQuery[$i]->id);

        }

        //hago un for con los id para obtener los recorridos

        $recorridosCorrectos = array();
        for ($j=0;$j<$longitud;$j++){

          array_push($recorridosCorrectos,Trip::find($pila[$j]));

        }
        return $recorridosCorrectos;

    }

    /**
    * Devuelve los recorridos de un determinado rango de distancia.
    *
    * @param  $longMin
    * @param  $longMax
    * @return Response
    */
    public function getToDistance($longMin,$longMax){
        return $this->clvHelperService->getToDistance($longMin,$longMax);
    }

    /*
    Modos:
        1
    */
    public function generateTrips($quantity, $min_distance_km, $max_distance_km, $mode){
        ini_set('max_execution_time', 0);
        // $file = fopen("/home/lucas/Tempo/archivo.csv", "w");
        $again = false;

        $centrality_start = ($mode == CENTRALITY_START) ? true : false;
        $road_start = ($mode == ROAD_START) ? true : false;
        $zone_start = ($mode == ZONE_START) ? true : false;
        $centrality_end = ($mode == CENTRALITY_END) ? true : false;
        $road_end = ($mode == ROAD_END) ? true : false;
        $zone_end = ($mode == ZONE_END) ? true : false;
        $random_trip = ($mode == RANDOM_TRIP) ? true : false;

        $reverse_mode = true;

        $result_statics = array();
        $created_trips_information = array();
        $created_amount = 0;

        //   El procedimiento se repite una cantidad n de veces.
        for($k = 0;$k <= $quantity;$k++){
            if($again){
                $again = false;
                $k--;
            }
            $distance_completed = 0.0;
            $new_trip_points = array();

            if($random_trip){
                $mode_random = rand(1, RANDOM_MODES);

                $centrality_start = ($mode_random == CENTRALITY_START) ? true : false;
                $road_start = ($mode_random == ROAD_START) ? true : false;
                $zone_start = ($mode_random == ZONE_START) ? true : false;
                $centrality_end = ($mode_random == CENTRALITY_END) ? true : false;
                $road_end = ($mode_random == ROAD_END) ? true : false;
                $zone_end = ($mode_random == ZONE_END) ? true : false;
            }

            if($centrality_start || $centrality_end){
                $reverse_mode = ($centrality_end) ? true : false;

                $point_road = null;
                $point_corner = null;

                while(empty($point_road) || empty($point_corner)){
                    $random_centrality = Centrality::all()->random(1);

                    $centrality_point = $random_centrality->geom;

                    $point_road = $this->getNearestPointInRoad($centrality_point);
                    $point_corner = $this->getPointInNearestCorner($centrality_point);
                }
                array_push($new_trip_points, $point_road);

                $distance_completed +=  $this->clvHelperService->calculateDistance($point_road->getLat(),
                $point_road->getLng(),
                $point_corner->getLat(),
                $point_corner->getLng());

                $selected_road = $this->getRoadFromTwoPoints($point_road, $point_corner);

                $selected_road_points = $selected_road->geom->getPoints();

                $point_to_add = $point_corner;
                $point_position = $this->getPositionOfPoint($selected_road_points, $point_to_add);
            }
            elseif($road_start || $road_end){
                $reverse_mode = ($road_end) ? true : false;
                // Pimero se obtiene una calle de manera aleatoria.
                $selected_road = Road::all()->random(1);
                $selected_road_points = $selected_road->geom->getPoints();
                // Se toma un punto aleatorio dentro de la primer calle seleccionada.
                $point_position = rand(0, count($selected_road_points)-1);
                // Se establece el punto obtenido como punto a agregar.
                $point_to_add = $selected_road_points[$point_position];
            }
            elseif($zone_start || $zone_end){
                $reverse_mode = ($zone_end) ? true : false;
                $random_zone = Zone::all()->random(1);
                $point_to_add = null;
                while($point_to_add == null)
                    $point_to_add = $this->getRandomPointOnZone($random_zone->id);
                $selected_road = $this->getRoadFromPoint($point_to_add);
                $selected_road_points = $selected_road->geom->getPoints();

                $point_position = $this->getPositionOfPoint($selected_road_points, $point_to_add);
            }

            // Se usa para almacenar el ultimo punto agregado.
            $last_point_added = null;
            // Se establece la variable que indicara si se intenta obtener otra calle o se sigue en la misma.
            $keep_going = 0;
            $range = $max_distance_km - $min_distance_km;
            $max_distance_random = $min_distance_km + $range * (mt_rand() / mt_getrandmax());
            // for($i = 0;$i <= $max_distance_random; $i++){
            while($distance_completed < $max_distance_random){
                // Se realiza un sorteo aleatorio sobre si se cambiara de calle o no.
                $keep_going = rand(0,1);
                // Se agrega el nuevo punto al recorrido
                array_push($new_trip_points, $point_to_add);

                $last_point_added = $point_to_add;
                $possible_next_road = null;
                $position = 0;

                if(!$keep_going){
                    $possible_next_road = $this->getPossibleRoad($point_to_add, $selected_road->id);
                }

                // Si no se encontro una calle siguiente valida, se intenta seguir un punto mas en la misma.
                if(empty($possible_next_road)){
                    $point_to_add = $this->getNextPoint($selected_road_points, $point_position,$reverse_mode);
                    if(empty($point_to_add)){
                        $again = true;
                        break;
                    }
                    else{
                        // $point_position++;
                        $point_position = ($reverse_mode) ? $point_position-1 : $point_position+1;
                    }
                }
                else{
                    // Si hay una nueva calle para tomar, se obtienen los puntos de la misma.
                    $possible_next_road_points = $possible_next_road->geom->getPoints();
                    // Se busca dentro de sus puntos, el punto actual que se esta usando.
                    $position = $this->getPositionOfPoint($possible_next_road_points, $last_point_added);
                    // Si la posicion fue encontrada...
                    if($position > -1){
                        // Se determina si se puede obtener un punto siguiente.
                        $point_to_add = $this->getNextPoint($possible_next_road_points, $position,$reverse_mode);
                        if(!empty($point_to_add)){
                            if($this->getPositionOfPoint($new_trip_points, $point_to_add) > -1){
                                $again = true;
                                break;
                            }
                            // Si se vuelve a un punto por donde ya se paso se vuelve a calcular el recorrido.
                            // $point_position = $position + 1;
                            $point_position = ($reverse_mode) ? $position-1 : $position+1;
                            $selected_road = $possible_next_road;
                            $selected_road_points = $selected_road->geom->getPoints();
                        }
                        // Se determina si dentro de la calle actual habria un punto siguiente para usar.
                        else{
                            $point_to_add = $this->getNextPoint($selected_road_points, $point_position,$reverse_mode);
                            if(empty($point_to_add)){
                                $again = true;
                                break;
                            }
                            else{
                                // $point_position++;
                                $point_position = ($reverse_mode) ? $point_position-1 : $point_position+1;
                            }
                        }
                    }
                    // Si la posicion no fue encontrada, se intenta seguir un punto mas por la misma calle.
                    else{
                        $point_to_add = $this->getNextPoint($selected_road_points, $point_position, $reverse_mode);
                        if(empty($point_to_add)){
                            $again = true;
                            break;
                        }
                        else{
                            // $point_position++;
                            $point_position = ($reverse_mode) ? $point_position-1 : $point_position+1;
                        }
                    }
                }
                $distance_completed +=  $this->clvHelperService->calculateDistance($last_point_added->getLat(),
                $last_point_added->getLng(),
                $point_to_add->getLat(),
                $point_to_add->getLng());
            }
            if(($distance_completed > $max_distance_random) && (!$again) && (count($new_trip_points) > 1)){
                // $linea_csv = "Recorrido ".$k.",Recorrido generado ".$k.",".count($new_trip_points);
                // fwrite($file, $linea_csv . PHP_EOL);
                $name = Name::all()->random(1)->name;
                $new_trip = new Trip();
                $new_trip->name = 'Recorrido '.($k+1);
                $new_trip->description = 'Recorrido generado '.$k;
                $new_trip->distance_km = $distance_completed;
                $new_trip->user = $name;
                $new_trip->time = date(DATE_RFC2822);
                $new_trip->duration = date("H:i:s");
                $new_trip->geom = new LineString($new_trip_points);
                $new_trip->frequency = '1';
                $new_trip->save();
                $created_amount++;
                array_push($created_trips_information, array("ID" => $new_trip->id, "Distancia" => round($distance_completed, 2)."km", "Modo" => $this->getNameOfMode(($mode == RANDOM_TRIP) ? $mode_random : $mode)));
            // foreach($new_trip_points as $new_trip_point){
                // $linea_csv = $new_trip_point->latitude.",".$new_trip_point->longitude;
                // fwrite($file, $linea_csv . PHP_EOL);
            // }
            }
        }
        // fclose($file);
        array_push($result_statics, array("Cantidad de recorridos creados" => $created_amount, "Modo de ejecucion" => $this->getNameOfMode($mode), "Resumen de los recorridos creados" => $created_trips_information));
        return $result_statics;
    }

    // Devuelve la posicion de un punto si la encuentra, sino devuelve -1.
    private function getPositionOfPoint($points, $single_point){
        $position = -1;
        for($i = 0;$i < count($points);$i++){
            if($points[$i]->getLat() == $single_point->getLat() && $points[$i]->getLng() == $single_point->getLng()){
                $position = $i;
                break;
            }
        }

        return $position;
    }


    private function getNextPoint($points, $position, $reverse){
        $point = null;
        if(!$reverse){
            if($position < count($points)-1){
                $point = $points[$position+1];
            }
        }
        else{
            if($position > 0){
                $point = $points[$position-1];
            }
        }

        return $point;
    }

    private function getNearestPointInRoad($point = null){
        $point_in_road = null;
        if(!empty($point)){
            $string_query = "SELECT r.*,ST_AsText(ST_Line_Interpolate_Point(r.geom::geometry,
                                    ST_Line_Locate_Point(r.geom::geometry,
                                    /* crea un punto a partir de una linea de texto con los datos*/
                                    ST_PointFromText('POINT(".$point->getLng()." ".$point->getLat().")',4326)))) as point
                                    FROM roads r
                                    WHERE r.geom && st_expand(ST_MakePoint(".$point->getLng().",".$point->getLat()."), 10)
                                    ORDER BY ST_Distance(ST_MakePoint(".$point->getLng().",".$point->getLat()."),r.geom)
                                    LIMIT 1";
            $query_point_street = DB::raw($string_query);
            $result_point = DB::select($query_point_street);
            if(!empty($result_point))
                $point_in_road = Point::fromWKT($result_point[0]->point);
        }

        return $point_in_road;
    }

    private function getPointInNearestCorner($point = null){
        $point_in_corner = null;
        if(!empty($point)){
            $string_query = "select dumped.id as id, dumped.name as name, dumped.dump as point, ST_Distance(ST_GeomFromText(dumped.dump), ST_MakePoint(".$point->getLng().",".$point->getLat().")) as distancia
                            from (
                                SELECT r.*, ST_AsText((ST_DumpPoints(r.geom::geometry)).geom) as dump
                                FROM roads r
                                WHERE r.id in
                                    (SELECT distance_a.road
                                    FROM(
                                        SELECT r.id as road, ST_Distance(r.geom, ST_MakePoint(".$point->getLng().",".$point->getLat().")) AS distance
                                        from roads r
                                        ) as distance_a
                                    order by distance_a.distance
                                    limit 4)
                                ) as dumped
                            order by distancia ASC
                            limit 1";
            $query_corner_point = DB::raw($string_query);
            $result_point = DB::select($query_corner_point);
            if(!empty($result_point))
                $point_in_corner = Point::fromWKT($result_point[0]->point);
        }

        return $point_in_corner;
    }

    private function getRoadFromTwoPoints($point_1 = null, $point_2 = null){
        $road = null;
        if((!empty($point_1)) && (!empty($point_2))){
            $string_query = "SELECT id
                                FROM roads
                                WHERE ST_Distance(geom::geometry, ST_GeomFromText('".$point_1->toWKT()."',4326)) < 0.0001
                                AND ST_Distance(geom::geometry, ST_GeomFromText('".$point_2->toWKT()."',4326)) = 0.0001";
            $query_road = DB::raw($string_query);
            $result_road_id = DB::select($query_road);
            if(!empty($result_road_id)){
                $road = Road::find($result_road_id[0]->id);
            }
            else{
                $aux_line = new LineString(array($point_1,$point_2));
                $string_query = "SELECT id
                                    FROM roads
                                    WHERE ST_Distance(geom::geometry, ST_GeomFromText('".$aux_line->toWKT()."',4326)) = 0";
                $query_road = DB::raw($string_query);
                $result_road_id = DB::select($query_road);
                if(!empty($result_road_id)){
                    $road = Road::find($result_road_id[0]->id);
                }
            }
        }

        return $road;
    }

    private function getRoadFromPoint($point = null){
        $road = null;
        if(!empty($point)){
            $string_query = "SELECT id
                                FROM roads
                                WHERE ST_Distance(geom::geometry, ST_GeomFromText('".$point->toWKT()."',4326)) = 0";
            $query_road = DB::raw($string_query);
            $result_road_id = DB::select($query_road);
            if(!empty($result_road_id)){
                $road = Road::find($result_road_id[0]->id);
            }
        }

        return $road;
    }

    private function getRandomPointOnZone($zone_id = null){
        $point_in_zone = null;
        if(!empty($zone_id)){
            $string_query = "
                SELECT dumped_points.id as road_id, ST_AsText(dumped_points.geom) as point
                FROM (
            	    SELECT intersection_road.id as id, (ST_DumpPoints(intersection_road.geom::geometry)).geom as geom
            	    FROM (
            		    SELECT r.id as id, r.geom as geom
            		    FROM roads r, zones z
            		    WHERE z.id = ".$zone_id."
            		    AND ST_Intersects( r.geom::geometry , z.geom::geometry) = 't'
            		    ORDER BY random()
            		    LIMIT 1
            	    ) as intersection_road
                ) as dumped_points, zones z
                WHERE z.id = ".$zone_id."
                AND ST_Contains(z.geom::geometry, dumped_points.geom::geometry) = 't'
                ORDER BY random()
                LIMIT 1";
            $query_point_zone = DB::raw($string_query);
            $result_point = DB::select($query_point_zone);
            if(!empty($result_point)){
                $point_in_zone = Point::fromWKT($result_point[0]->point);
            }
        }

        return $point_in_zone;
    }

    private function getNameOfMode($mode = null){
        if(!empty($mode)){
            switch ($mode) {
                case CENTRALITY_START:
                    return "El recorrido comienza en una centralidad aleatoria";
                    break;
                case ROAD_START:
                    return "El recorrido comienza en una calle aleatoria";
                    break;
                case ZONE_START:
                    return "El recorrido comienza en una zona aleatoria";
                    break;
                case CENTRALITY_END:
                    return "El recorrido finaliza en una centralidad aleatoria";
                    break;
                case ROAD_END:
                    return "El recorrido finaliza en una calle aleatoria";
                    break;
                case ZONE_END:
                    return "El recorrido finaliza en una zona aleatoria";
                    break;
                case RANDOM_TRIP:
                    return "Recorridos totalmente aleatorios";
                    break;
            }
        }
        return "No especificado";
    }

    private function getPossibleRoad($point = null, $current_road_id = null){
        $possible_next_road = null;
        if((!empty($point)) && (!empty($current_road_id))){
            $aux_possible_roads = DB::raw("select * from (select r.* as road,st_dwithin(r.geom, ST_MakePoint(".$point->getLng().",".$point->getLat()."), 0) as distance
                                            from roads r) as distance
                                            where distance.distance = 't'
                                            and distance.id <> ".$current_road_id);
            $possible_roads = DB::select($aux_possible_roads);
            if(!empty($possible_roads)){
                $aux = array();
                foreach($possible_roads as $possible_road){
                    array_push($aux, $possible_road);
                }
                $possible_roads = $aux;
                // Si quedan alternativas...
                if(count($possible_roads) > 0){
                    // Si queda mas de una alternativa, se elige aleatoriamente.
                    if(count($possible_roads) > 1){
                        $possible_next_road = Road::find($possible_roads[rand(0,count($possible_roads)-1)]->id);
                    }
                    // Sino se toma la unica alternativa posible.
                    else{
                        $possible_next_road = Road::find($possible_roads[0]->id);
                    }
                }
            }
        }

        return $possible_next_road;
    }

    /**
    * Funcion que retorna el largo en kilometros de un Recorrido.
    *
    * @param $id
    * @return int $km
    */
    public function tripIdDistance($id){
        return $this->clvHelperService->tripIdDistance($id);
    }

    /**
    * Funcion que retorna recorridos cercanos a una centralidad
    *
    * @param $latitude
    * @param $longitude
    * @return $recorridosCorrectos
    */
    public function getCloseToCentrality($latitude, $longitude){

        //Armado de la query para obtener los recorridos cercanos a un punto
        $query = "SELECT t.id
        FROM trips t
        WHERE ST_DWithin(t.geom,St_MakePoint(".$longitude.",".$latitude."),100)";

        $cercanoQuery= DB::raw($query);

        $resultQuery= DB::select($cercanoQuery);

        //Obtengo los id separados.
        $pila= array();
        $longitud = count($resultQuery);

        for ($i=0;$i<$longitud;$i++){

            array_push($pila,$resultQuery[$i]->id);

        }

        //hago un for con los id para obtener los recorridos

        $recorridosCorrectos = array();
        for ($j=0;$j<$longitud;$j++){

            array_push($recorridosCorrectos,Trip::find($pila[$j]));

        }
        return $recorridosCorrectos;
    }

    public function getTripsByZone($zone_id){
        $query = "SELECT p.id
                FROM trips p, zones z
                WHERE z.id = ".$zone_id."
                AND ST_Intersects(p.geom, z.geom) = 't'
                ORDER BY p.id ASC";

        $tripsZoneQuery= DB::raw($query);

        $resultQuery = DB::select($tripsZoneQuery);

        $array_id_trips = array();

        foreach ($resultQuery as $single_result) {
            array_push($array_id_trips, $single_result->id);
        }


        print_r($array_id_trips);
        var_dump($this->rankingTrips->getTramosRanking($array_id_trips));
    }

    public function getTripsByOriginDestinationZone($origin_zone_id, $destination_zone_id){
        if($origin_zone_id != $destination_zone_id){
            $string_query = "SELECT first.tripid
                            FROM (
            	                    SELECT t.id as tripid, count(t.id) as counter
            	                    FROM zones z, trips t
            	                    WHERE
            	                    CASE z.id WHEN ".$origin_zone_id." THEN ST_Intersects( z.geom::geometry , ST_StartPoint(t.geom::geometry))
            	                    WHEN ".$destination_zone_id." THEN ST_Intersects( z.geom::geometry , ST_EndPoint(t.geom::geometry)) END
            	                    GROUP BY t.id) as first
                            WHERE first.counter > 1";
        }
        else{
            $string_query = "SELECT t.id as tripid
	                          FROM zones z, trips t
	                          WHERE z.id = ".$origin_zone_id."
	                          AND ST_Intersects( z.geom::geometry , ST_StartPoint(t.geom::geometry))
	                          AND ST_Intersects( z.geom::geometry , ST_EndPoint(t.geom::geometry))";
        }
        // var_dump($string_query);

        $query = DB::raw($string_query);

        $results = DB::select($query);
        $trips = array();

        if(!empty($results)){
            foreach ($results as $trip_id) {
                $found_trip = Trip::find($trip_id->tripid);
                array_push($trips, $found_trip);
            }
        }

        return $trips;
    }

    // public function createRoute($latitude_1, $longitude_1, $latitude_2, $longitude_2){
    //     $id_1 = $this->getCloseId($latitude_1, $longitude_1);
    //     $id_2 = $this->getCloseId($latitude_2, $longitude_2);
    //
    //     $result_geom = $this->makeRoute($id_1, $id_2);
    //     var_dump($result_geom);
    // }
    //
    // private function makeQuery($string_query = null){
    //     $results = null;
    //     if(!empty($string_query)){
    //         $query = DB::raw($string_query);
    //         $results = DB::select($query);
    //     }
    //
    //     return $results;
    // }
    //
    // private function getCloseId($latitude, $longitude){
    //     $id = 0;
    //     if((!empty($latitude)) && (!empty($longitude))){
    //         $string_query = "SELECT *
    //                 FROM
    //                    (SELECT ST_Distance(the_geom, ST_SetSRID(ST_MakePoint(".$longitude.",".$latitude."),4326)) as distance, id as id, the_geom as geom
    //                       FROM roads_noded_vertices_pgr) as dist
    //                       ORDER BY dist.distance
    //                       LIMIT 1";
    //         $results = $this->makeQuery($string_query);
    //
    //         if(!empty($results))
    //             $id = $results[0]->id;
    //     }
    //
    //     return $id;
    // }
    //
    // private function makeRoute($id_1, $id_2){
    //     $result_geom = 0;
    //
    //     if((!empty($id_1)) && (!empty($id_2))){
    //         $string_query = "SELECT ST_MakeLine(array_agg(way.the_geom)) as geom
    //                         FROM(
    // 	                        SELECT seq, id1 AS node, id2 AS edge, cost as cost, rdd.the_geom as the_geom, rd.geom as geom
    // 	                        FROM pgr_dijkstra('SELECT id, source::int4, target::int4, 0.1::float8 as cost FROM roads_noded'::text,".$id_1.",".$id_2.", true, false) as pt
    // 	                        LEFT JOIN roads_noded_vertices_pgr rdd ON pt.id1 = rdd.id
    // 	                        LEFT JOIN roads_noded rd ON pt.id2 = rd.id
    //                         ) as way";
    //         $results = $this->makeQuery($string_query);
    //
    //         if(!empty($results))
    //             $result_geom = $results[0]->geom;
    //     }
    //
    //     return $result_geom;
    // }
}
