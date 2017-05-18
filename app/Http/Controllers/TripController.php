<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Trip;
use App\Models\Road;
use App\Models\GeoPoint;
use App\Models\TripPoint;
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
        // Se obtienen los puntos correspodientes.
        foreach($Trips as $trip){
            $trip_points = $trip->trippoint()->get();
            $points = array();
            foreach($trip_points as $trip_point){
                $point = GeoPoint::find($trip_point->geo_point_id);
                $point->order = $trip_point->order;
                array_push($points, $point);
            }
            $trip->points = $points;
        }
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

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $Trip = Trip::find($id);
        $Trip->name = Request::input('name');
        $Trip->description = Request::input('description');
        $Trip->save();

        return $Trip;
    }

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
* Funcionalidad movida a la clase Services\CicloviasHelper.
*/
//   private function calculateDistance($lat1, $long1, $lat2, $long2){
//     $degtorad = 0.01745329;
//     $radtodeg = 57.29577951;
//
//     $dlong = ($long1 - $long2);
//     $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad))
// 			       + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad)
// 			        * cos($dlong * $degtorad));
//
//     $dd = acos($dvalue) * $radtodeg;
//
//     $miles = ($dd * 69.16);
//     $km = ($dd * 111.302);
//
//     return $km;
//   }
//
// /**
// *Funcion que retorna los Recorridos que estan dentro de un rango de una determinada Distancia.
// *
// *@param int $long
// *@param array $result
// */
// public function getToDistance($long){
//   //Variables que determinan el rango de distancia en la que puede estar los Recorridos.
//   $longMin= $long - 0.05;
//   $longMax= $long + 0.05;
//
//   $result = array();
//   $Trips = Trip::all();
//
//   foreach($Trips as $trip){
//     $points = $trip->geopoints()->get();
//     $trip->points= $points;
//     $kmt = $this->tripDistance($points);
//     $kmr = round($kmt, 2);
//       if($kmr >= $longMin && $kmr <= $longMax){
//         $result[] = $trip;
//
//       }
//   }
//
//   return $result;
// }
//
//
//   /**
//   * Funcion que retorna el largo en kilometros de un Recorrido.
//   *
//   * @param $trip
//   * @return int $km
//   */
// public function tripDistance($trip){
//   //saco el numero de elementos
//   $longitud = count($trip);
//   $km=0;
//   //Recorro todos los elementos
//   for($i=1; $i<$longitud; $i++){
//     $j= $i - 1;
//     //Calculo la distancia entre los puntos del recorrido
//     $km += $this->CalculateDistance($trip[$j]->latitude, $trip[$j]->longitude, $trip[$i]->latitude, $trip[$i]->longitude);
//     }
//
//   return $km;
// }
//
// /**
// * Funcion que retorna el largo en kilometros de un Recorrido.
// *
// * @param $id
// * @return int $km
// */
// public function tripIdDistance($id){
// //Busco recorrido por id
// $Trip = Trip::find($id);
//
// $points = $Trip->geopoints()->get();
// //saco el numero de elementos
// $longitud = count($points);
// $km=0;
// //Recorro todos los elementos
// for($i=1; $i<$longitud; $i++){
//   $j= $i - 1;
//   //Calculo la distancia entre los puntos del recorrido
//   $km +=  $this->CalculateDistance($points[$j]->latitude, $points[$j]->longitude, $points[$i]->latitude, $points[$i]->longitude);
//   }
// return $km;
// }

    public function getToDistance($long){
        return $this->clvHelperService->getToDistance($long);
    }

    public function generateTrips($quantity, $max_distance_km){
        ini_set('max_execution_time', 900);
        $file = fopen("/home/lucas/Tempo/archivo.csv", "w");
        $again = false;
        $day_times = ['Morning', 'Afternoon', 'Evening'];
        //   El procedimiento se repite una cantidad n de veces.
        for($k = 0;$k <= $quantity;$k++){
            if($again){
                $again = false;
                $k--;
            }
            $distance_completed = 0.0;
            // Pimero se obtiene una calle de manera aleatoria.
            $random_road = Road::all()->random(1);
            // Se obtienen los puntos de la misma.
            $random_road->points = $random_road->geopoints()->get();

            // Se establecen las variables involucradas en el proceso.
            $new_trip_points = array();
            // Se usa para almacenar el ultimo punto agregado.
            $last_point_added = null;
            // Se toma un punto aleatorio dentro de la primer calle seleccionada.
            $point_position = rand(0, count($random_road->points)-1);
            // Se establece el punto obtenido como punto a agregar.
            $point_to_add = $random_road->points[$point_position];
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
                    $possible_roads = DB::table('roads')
                    ->join('geo_point_road', 'roads.id', '=', 'geo_point_road.road_id')
                    ->join('geo_points', 'geo_points.id', '=', 'geo_point_road.geo_point_id')
                    ->select('roads.*')
                    ->where([
                        ['geo_points.latitude', '=', $point_to_add->latitude],
                        ['geo_points.longitude', '=', $point_to_add->longitude]
                    ])
                    ->get();
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

                // Se quita la calle actual de la lista de alternativas a tomar.
                for($j = 0;$j < count($possible_roads);$j++) {
                    if($possible_roads[$j]->name == $random_road->name){
                        array_splice($possible_roads, $j, 1);
                        break;
                    }
                }

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
                    if($point_position < count($random_road->points)-1){
                        $point_to_add = $random_road->points[$point_position+1];
                        $point_position++;
                    }
                    else{
                        $again = true;
                        break;
                    }
                }
                else{
                    // Si hay una nueva calle para tomar, se obtienen los puntos de la misma.
                    $possible_next_road->points = $possible_next_road->geopoints()->get();
                    // Se busca dentro de sus puntos, el punto actual que se esta usando.
                    for($j = 0;$j < count($possible_next_road->points);$j++){
                        if($possible_next_road->points[$j]->latitude == $last_point_added->latitude && $possible_next_road->points[$j]->longitude == $last_point_added->longitude){
                            $position = $j;
                            break;
                        }
                    }
                    // Si la posicion fue encontrada...
                    if(!empty($position)){
                        // Se determina si se puede obtener un punto siguiente.
                        if(count($possible_next_road->points)-1 > $position){
                            $is_in_the_trip = false;
                            $point_to_add = $possible_next_road->points[$position + 1];
                            // Se determina si el punto a agregar ya fue agregado anteriormente.
                            for($j = 0;$j < count($new_trip_points);$j++){
                                if($new_trip_points[$j]->latitude == $point_to_add->latitude && $new_trip_points[$j]->longitude == $point_to_add->longitude){
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
                            if($point_position < count($random_road->points)-1){
                                $point_to_add = $random_road->points[$point_position+1];
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
                        if($point_position < count($random_road->points)-1){
                            $point_to_add = $random_road->points[$point_position+1];
                            $point_position++;
                        }
                        // Si no hay punto siguiente se corta el proceso.
                        else {
                            $again = true;
                            break;
                        }
                    }
                }
                $distance_completed +=  $this->clvHelperService->calculateDistance($new_trip_points[count($new_trip_points)-1]->latitude,
                $new_trip_points[count($new_trip_points)-1]->longitude,
                $point_to_add->latitude,
                $point_to_add->longitude);
            }
            if(count($new_trip_points) > $min_distance_km && !$again){
                $linea_csv = "Recorrido ".$k.",Recorrido generado ".$k.",".count($new_trip_points);
                fwrite($file, $linea_csv . PHP_EOL);
                $name = Name::all()->random(1)->name;
                $new_trip = Trip::create(['name' => 'Recorrido '.$k,
                                        'description' => 'Recorrido generado '.$k,
                                        'distance_km' => $distance_completed,
                                        'bicyclist' => $name,
                                        'day_time' => $day_times[rand(0, count($day_times)-1)]
                                    ]);
                $order = 1;
                foreach($new_trip_points as $new_trip_point){
                    $linea_csv = $new_trip_point->latitude.",".$new_trip_point->longitude;
                    fwrite($file, $linea_csv . PHP_EOL);
                    // $point_of_trip = GeoPoint::create(['latitude' => $new_trip_point->latitude,'longitude' => $new_trip_point->longitude, 'order' => $order]);
                    // $new_trip->geopoints()->save($new_trip_point);
                    $new_trippoint = TripPoint::create(['order' => $order]);
                    $order++;
                    $new_trip->trippoint()->save($new_trippoint);
                    $new_trip_point->trippoint()->save($new_trippoint);
                }
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
        fclose($file);
        return "Ok";
    }

    /**
    * Funcion que retorna el largo en kilometros de un Recorrido.
    *
    * @param $trip
    * @return int $km
    */
    public function tripDistance($trip){
        //saco el numero de elementos
        $longitud = count($trip);
        $km=0;
        //Recorro todos los elementos
        for($i=1; $i<$longitud; $i++){
            $j= $i - 1;
            //Calculo la distancia entre los puntos del recorrido
            $km += $this->CalculateDistance($trip[$j]->latitude, $trip[$j]->longitude, $trip[$i]->latitude, $trip[$i]->longitude);
        }

        return $km;
    }

}
