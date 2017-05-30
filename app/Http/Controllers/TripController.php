<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;

use App\Models\Trip;
use App\Models\Road;
use App\Models\Name;
use App\Services\CicloviasHelper;

class TripController extends Controller
{
    private $clvHelperService;

    //Se declara contructor para inyectar service "CicloviasHelper"
    function __construct (CicloviasHelper $helper){
        $this->clvHelperService = $helper;
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
        $Trip = Trip::create(Request::all());
        return $Trip;
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
        $result = array();

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
        return $result;
    }

    /**
    * Devuelve los recorridos de una determinado largo.
    *
    * @param  $long
    * @param  $tolerance
    * @return Response
    */
    public function getToDistance($long,$tolerance){
        return $this->clvHelperService->getToDistance($long,$tolerance);
    }

    // TODO Para corregir...
    public function generateTrips($quantity, $max_distance_km){
        ini_set('max_execution_time', 900);
        // $file = fopen("/home/lucas/Tempo/archivo.csv", "w");
        $again = false;
        //   El procedimiento se repite una cantidad n de veces.
        for($k = 0;$k <= $quantity;$k++){
            if($again){
                $again = false;
                $k--;
            }
            $distance_completed = 0.0;
            // Pimero se obtiene una calle de manera aleatoria.
            $random_road = Road::all()->random(1);
            // Se establecen las variables involucradas en el proceso.
            $new_trip_points = array();
            // Se usa para almacenar el ultimo punto agregado.
            $last_point_added = null;
            $random_road_points = $random_road->geom->getPoints();
            // Se toma un punto aleatorio dentro de la primer calle seleccionada.
            $point_position = rand(0, count($random_road_points)-1);
            // Se establece el punto obtenido como punto a agregar.
            $point_to_add = $random_road_points[$point_position];
            // Se establece la variable que indicara si se intenta obtener otra calle o se sigue en la misma.
            $keep_going = 0;
            $min_distance_km = 0.5;
            $range = $max_distance_km - $min_distance_km;
            $max_distance_random = $min_distance_km + $range * (mt_rand() / mt_getrandmax());
            // $max_distance_random = rand($min_distance_km, $max_distance_km);
            // for($i = 0;$i <= $max_distance_random; $i++){
            while($distance_completed < $max_distance_random){
                // Se realiza un sorteo aleatorio sobre si se cambiara de calle o no.
                $keep_going = rand(0,1);
                // Se agrega el nuevo punto al recorrido
                array_push($new_trip_points, $point_to_add);
                $last_point_added = $point_to_add;
                $possible_next_road = null;
                $position = 0;

                // Si no se desea cambiar de calle no se necesita hacer la consulta.
                if(!$keep_going){
                    $possible_roads = DB::select('select *
                                                from(
                                                    select r.* as road,st_dwithin(r.geom, ST_MakePoint(:longitude, :latitude), 2.0, true) as distance
	                                                from roads r) as distance
                                                where distance.distance = \'t\'
                                                and distance.name <> :name', ['longitude' => $point_to_add->getLng(),
                                                                                'latitude' => $point_to_add->getLat(),
                                                                                'name' => "\'".$random_road->name."\'",
                                                                            ]);
                    // var_dump($possible_roads);
                }
                else{
                    $possible_roads = array();
                }

                // Se convierte el tipo de array devuelto por la base de datos a un array convensional.
                $aux = array();
                foreach($possible_roads as $possible_road){
                    array_push($aux, $possible_road);
                }
                $possible_roads = $aux;

                // // Se quita la calle actual de la lista de alternativas a tomar.
                // for($j = 0;$j < count($possible_roads);$j++) {
                //     if($possible_roads[$j]->name == $random_road->name){
                //         array_splice($possible_roads, $j, 1);
                //         break;
                //     }
                // }

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

                // Si no se encontro una calle siguiente valida, se intenta seguir un punto mas en la misma.
                if(empty($possible_next_road)){
                    if($point_position < count($random_road_points)-1){
                        $point_to_add = $random_road_points[$point_position+1];
                        $point_position++;
                    }
                    else{
                        $again = true;
                        break;
                    }
                }
                else{
                    // Si hay una nueva calle para tomar, se obtienen los puntos de la misma.
                    $possible_next_road_points = $possible_next_road->geom->getPoints();
                    // Se busca dentro de sus puntos, el punto actual que se esta usando.
                    for($j = 0;$j < count($possible_next_road_points);$j++){
                        if($possible_next_road_points[$j]->getLat() == $last_point_added->getLat() && $possible_next_road_points[$j]->getLng() == $last_point_added->getLng()){
                            $position = $j;
                            break;
                        }
                    }
                    // Si la posicion fue encontrada...
                    if(!empty($position)){
                        // Se determina si se puede obtener un punto siguiente.
                        if(count($possible_next_road_points)-1 > $position){
                            $is_in_the_trip = false;
                            $point_to_add = $possible_next_road_points[$position + 1];
                            // Se determina si el punto a agregar ya fue agregado anteriormente.
                            for($j = 0;$j < count($new_trip_points);$j++){
                                if($new_trip_points[$j]->getLat() == $point_to_add->getLat() && $new_trip_points[$j]->getLng() == $point_to_add->getLng()){
                                    $is_in_the_trip = true;
                                }
                            }
                            // Si se vuelve a un punto por donde ya se paso se vuelve a calcular el recorrido.
                            if($is_in_the_trip){
                                $again = true;
                                break;
                            }
                            $point_position = $position + 1;
                            $random_road = $possible_next_road;
                        }
                        // Se determina si dentro de la calle actual habria un punto siguiente para usar.
                        else{
                            if($point_position < count($random_road_points)-1){
                                $point_to_add = $random_road_points[$point_position+1];
                                $point_position++;
                            }
                            // Si no hay punto siguiente se corta el proceso.
                            else {
                                $again = true;
                                break;
                            }
                        }
                    }
                    // Si la posicion no fue encontrada, se intenta seguir un punto mas por la misma calle.
                    else{
                        if($point_position < count($random_road_points)-1){
                            $point_to_add = $random_road_points[$point_position+1];
                            $point_position++;
                        }
                        // Si no hay punto siguiente se corta el proceso.
                        else {
                            $again = true;
                            break;
                        }
                    }
                }
                $distance_completed +=  $this->clvHelperService->calculateDistance($new_trip_points[count($new_trip_points)-1]->getLat(),
                $new_trip_points[count($new_trip_points)-1]->getLng(),
                $point_to_add->getLat(),
                $point_to_add->getLng());
            }
            if(count($new_trip_points) > $min_distance_km && !$again){
                // $linea_csv = "Recorrido ".$k.",Recorrido generado ".$k.",".count($new_trip_points);
                // fwrite($file, $linea_csv . PHP_EOL);
                $name = Name::all()->random(1)->name;
                $new_trip = new Trip();
                $new_trip->name = 'Recorrido '.$k;
                $new_trip->description = 'Recorrido generado '.$k;
                $new_trip->distance_km = $distance_completed;
                $new_trip->user = $name;
                $new_trip->time = date(DATE_RFC2822);
                $new_trip->duration = date("H:i:s");
                $new_trip->geom = new LineString($new_trip_points);
                $new_trip->save();
            // foreach($new_trip_points as $new_trip_point){
                // $linea_csv = $new_trip_point->latitude.",".$new_trip_point->longitude;
                // fwrite($file, $linea_csv . PHP_EOL);
            // }
        }
        /*
        SELECT r.*
        FROM roads r
        JOIN geo_point_road gpr
        ON gpr.road_id = r.id
        JOIN geo_points gp
        ON gpr.geo_point_id = gp.id
        WHERE gp.latitude >= -42.742411494255066
        */
    }
    // fclose($file);
    return "Ok";
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

}
