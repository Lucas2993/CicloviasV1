<?php

namespace App\Services;

/**
*
*/
class RankingTrips{

  public function rankingedTrips(){
    // creo los datos artificiales de los recorridos (serian datos que recupero del servidor o desde la vista)
    $trip1 = new stdClass();
    $trip1->id = 1;
    $trip1->idUser = 24;
    $trip1->rangeDay = "morning";
    $trip1->weight = 1;
    $trip1->points = [["id"=>1 ,"long"=>-65.05864278820195, "lat" => -42.78316309314362],
                      ["id"=>2 ,"long" => -65.05758599785008, "lat" => -42.782781192819016],
                      ["id"=>3 ,"long" => -65.05664722469487, "lat" => -42.78247409600383],
                      ["id"=>4 ,"long" => -65.05572454479375, "lat" => -42.78216699766537]
                     ];

    $trip2 = new stdClass();
    $trip2->id = 2;
    $trip2->idUser = 4;
    $trip2->rangeDay = "morning";
    $trip2->weight = 1;
    $trip2->points = [ ["id"=>2 ,"long" => -65.05758599785008, "lat" => -42.782781192819016],
                      ["id"=>3 ,"long" => -65.05664722469487, "lat" => -42.78247409600383],
                      ["id"=>4 ,"long" => -65.05572454479375, "lat" => -42.78216699766537],
                      ["id"=>5 ,"long" => -65.05500034835973, "lat" => -42.78191895558765],
                      ["id"=>6 ,"long" => -65.0543834402863, "lat" => -42.78169453570867],
                      ["id"=>7 ,"long" => -65.05360023525395, "lat" => -42.78143468009569] // bs As
                    ];

    $trip3 = new stdClass();
    $trip3->id = 3;
    $trip3->idUser = 11;
    $trip3->rangeDay = "night";
    $trip3->weight = 1;
    $trip3->points = [  ["id"=>8 ,"long" => -65.0580741598908, "lat" => -42.78020350088649],
                        ["id"=>9 ,"long" => -65.05736605671086, "lat" => -42.7813374308327],
                        ["id"=>3 ,"long" => -65.05664722469487, "lat" => -42.78247409600383],
                        ["id"=>4 ,"long" => -65.05572454479375, "lat" => -42.78216699766537],
                        ["id"=>5 ,"long" => -65.05500034835973, "lat" => -42.78191895558765]
                      ];

    $trip4 = new stdClass();
    $trip4->id = 4;
    $trip4->idUser = 5;
    $trip4->rangeDay = "morning";
    $trip4->weight = 1;
    $trip4->points = [  ["id"=>10 ,"long" => -65.05641119030156, "lat" => -42.77960502948685],
                        ["id"=>11 ,"long" => -65.05570308712163, "lat" => -42.780778342968475],
                        ["id"=>5 ,"long" => -65.05500034835973, "lat" => -42.78191895558765],
                        ["id"=>12 ,"long" => -65.05453364399114, "lat" => -42.782683945671025], // dobla
                        ["id"=>13 ,"long" => -65.0538791849915, "lat" => -42.78244771711581],
                        ["id"=>14 ,"long" => -65.05310670879521, "lat" => -42.782187864664], // dobla --> Bs As
                        ["id"=>15 ,"long" => -65.052527351648, "lat" => -42.78310915479904],
                        ["id"=>16 ,"long" => -65.05192653682866, "lat" => -42.78409342398366]
                      ];


    $trip5 = new stdClass();
    $trip5->id = 5;
    $trip5->idUser = 5;
    $trip5->rangeDay = "lasthight";
    $trip5->weight = 1;
    $trip5->points = [  ["id"=>17 ,"long" => -65.05505935695805, "lat" => -42.78510917337457],
                        ["id"=>18 ,"long" => -65.05411521938481, "lat" => -42.78480208810705], // dobla arr
                        ["id"=>19 ,"long" => -65.05464093235173, "lat" => -42.78384145256263],
                        ["id"=>20 ,"long" => -65.05519883182683, "lat" => -42.78292804756452], // dobla der
                        ["id"=>12 ,"long" => -65.05453364399114, "lat" => -42.782683945671025],
                        ["id"=>13 ,"long" => -65.05390064266362, "lat" => -42.78244771711581], // dobla ab
                        ["id"=>21 ,"long" => -65.05333201435246, "lat" => -42.78340050010814], //dobla der
                        ["id"=>15 ,"long" => -65.052527351648, "lat" => -42.78310915479904], // dobla ab
                        ["id"=>16 ,"long" => -65.05192653682866, "lat" => -42.78409342398366]
                      ];

    // $tripsRecovered = [$trip1, $trip2, $trip3, $trip4, $trip5];
    // ********************* TEST_1 (2 recorridos con trayectos interseccion) *********************
    // $tripsRecovered = [$trip5, $trip4];
    // ********************* TEST_2 (2 recorridos sin trayectos interseccion) *********************
    // $tripsRecovered = [$trip5, $trip1];
    // ********************* TEST_3 (2 recorridos iguales)*********************
    // $tripsRecovered = [$trip1, $trip1];
    // ********************* TEST_4 (2 recorridos con que se cruzan pero no tienen un trayecto interseccion) *********************
    // $tripsRecovered = [$trip2, $trip4];
    // ********************* TEST_5 ===> 2 recorridos con un trayecto de 3 puntos(R2 y R3)
    $tripsRecovered = [$trip2, $trip3];

    $numberTrips = count($tripsRecovered);
    $numberPointsTripComparated= count(($tripsRecovered[0])->points);
    $numberPoinsToCompare;
    // recorridos que se van a comparar
    $tripComparated;
    $tripToCompare;

    $journiesIntersection = array();
    // se van guardando los trayectos interseecion q se encuentran
    //$journeyIntersectionTemp = new stdClass();
    $pointsIntersection;

    $end_intersection = false;

    $pointTrip;$pointTripNext;
    $pointTripToCompare;$pointTripToCompareNext;$pointTripToCompareBefore;

    $finTrip = false;
    $finTrip_R = false;

    $j_increment = 1;

    $cant_int_puntos = 0;

    // con esto vamos agarrando los recorridos recuperados
    for ($i=0 ; ($i < $numberTrips)&&(!$finTrip) ; $i++) {
      if(($i + 1) < $numberTrips){
        $pointsIntersection = array();
        $tripComparated = $tripsRecovered[$i];
        $tripToCompare = $tripsRecovered[$i + 1];
        // buscamos si se encuentra dentro del otro recorrido
        $numberPoinsToCompare = count($tripComparated->points);
        // con esto recorremos el 1er recorrido R1
        for ($j=0; $j < $numberPoinsToCompare; $j += $j_increment) {
          if($j_increment <> 1){
            $j_increment = 1;
          }
          // vamos tomando de uno todos los puntos del recorrido R1
          $pointTrip = $tripComparated->points[$j];
          echo" Valor de j: ".$j."\n";
          // comparamos contra todos los puntos del recorrido R
          for ($i_R=0; $i_R < (count($tripToCompare->points))&&(!$finTrip_R) ; $i_R++) {
            // vemos que no nos pasems de los puntos del recorrido R1
            if(($j + 1) < $numberPoinsToCompare){
              echo" Valor de i_R: ".$i_R."\n";
              // vamos tomando de a uno los puntos de R
              $pointTripToCompare = $tripToCompare->points[$i_R];
              // comparamos los id de en busca de una interseccion
              if ($pointTrip["id"] == $pointTripToCompare["id"]) {
                $cant_int_puntos++;
                // siguiente punto del 1er recorrido(R1)
                $pointTripNext = $tripComparated->points[$j + 1];
                // siguiente y anterior del recorrido donde se busca
                $pointTripToCompareNext = $tripToCompare->points[$i_R + 1];
                $pointTripToCompareBefore = $tripToCompare->points[$i_R - 1];
                print_r($pointTrip);
                echo"\n";
                print_r($pointTripToCompareNext);
                // vemos si el siguiente punto de R1 es igual al sig de R
                if($pointTripNext["id"] == $pointTripToCompareNext["id"]){
                  echo"idR1: ".$pointTripNext["id"]." - "."idR: ".$pointTripToCompareNext["id"]."\n";
                  $pointsIntersection = array();
                  $journeyIntersectionTemp = new stdClass();
                  // si son iguales, se encontro un trayecto interseccion, se guarda
                  array_push($pointsIntersection, $pointTrip, $pointTripNext);
                  // actualizamos el incremento
                  $j_increment += 1;
                  // comparamos con los siguientes puntos
                  for ($i_aux_next= $j + 2, $j_der=$i_R + 2; ($j_der < (count($tripToCompare->points))) && (!$end_intersection); $i_aux_next++, $j_der++) {
                    // $pointTripNext = $tripsRecovered[$i_aux_next];
                    $pointTripNext = $tripComparated->points[$i_aux_next];
                    // siguiente y anterior del recorrido donde se busca
                    $pointTripToCompareNext = $tripToCompare->points[$j_der];
                    echo"Entra a ver si el los siguientes(+2) son iguales";
                    echo"id_R(+2): " .$pointTripNext["id"]. " - - - id_R1(+2): " .$pointTripToCompareNext["id"] . "\n";
                    // vemos si el siguiente punto de R1 es igual al sig de R
                    if($pointTripNext["id"] == $pointTripToCompareNext["id"]){
                      // si son iguales, se guarda
                      array_push($pointsIntersection, $pointTripNext);
                      echo"Los siguientes (+2) son IGUALES";
                      $j_increment += 1;
                    }
                    else {
                      // vaciamos el contenedor de los puntos del trayecto interseccion
                      // $pointsIntersection = array();
                      echo"************** SE SETEA EL ARRAY *************\n";
                      print_r($journiesIntersection);
                      echo"************** FIN ARRAY SETEADO *************\n";
                      $end_intersection = true;
                    }
                  }
                  // una vez que finaliza el trayecto interseccion se crea un objeto con los datos y se guarda
                  $journeyIntersectionTemp -> id = 1;
                  $journeyIntersectionTemp -> points = $pointsIntersection;
                  array_push($journiesIntersection, $journeyIntersectionTemp);
                  echo"Se guardo un trayecto.\n";
                  echo"************** trayecto guardado *************\n";
                  echo $journiesIntersectionTemp;
                  echo"************** trayecto encontrados *************\n";
                  print_r($journiesIntersection);
                  echo"************** FIN TRAYECTO *************\n";
                  // una vez guardado el trayecto lo lipiamos y lo volvems a inicializar
                }
                // vemos si el siguiente punto de R1 es igual al anterior de R
                elseif ($pointTripNext["id"] == $pointTripToCompareBefore["id"]) {
                  // si son iguales, se encontro un trayecto interseccion, se guarda
                  array_push($pointsIntersection, $pointTrip, $pointTripToCompare);
                  array_push($pointsIntersection, $pointTripNext, $pointTripToCompareBefore);
                  // actualizamos el incremento
                  $j_increment += 1;
                  // comparamos con los siguientes puntos
                  for ($i_aux_next= $j + 2, $j_izq= $i_R - 2; ($j_izq < 0) && (!$end_intersection); $i_aux_next++, $j_izq++) {
                    $pointTripNext = $tripsRecovered[$i_aux_next];
                    // siguiente y anterior del recorrido donde se busca
                    $pointTripToCompareNext = $tripToCompare->points[$j_izq];
                    // vemos si el siguiente punto de R1 es igual al sig de R
                    if($pointTripNext["id"] == $pointTripToCompareNext["id"]){
                      // si son iguales, se guarda
                      array_push($pointsIntersection, $pointTripNext, $pointTripToCompareBefore);
                      $j_increment += 1;
                    }
                    else {
                      // vaciamos el contenedor de los puntos del trayecto interseccion
                      $pointsIntersection = array();
                      $end_intersection = true;
                    }
                  }
                  // una vez que finaliza el trayecto interseccion se crea un objeto con los datos y se guarda
                  $journeyIntersectionTemp -> id = 1;
                  $journeyIntersectionTemp -> points = $pointsIntersection;
                  array_push($journiesIntersection, $journeyIntersectionTemp);
                }
              }
            }
            else{
              $finTrip_R = true;
            }
          }
        }
      }
      else{
        $finTrip = true;
      }
    }
    echo "Cantidad de trayectos interseccion: ". $cant_int_puntos . "\n";
    echo"Imprime el cjto de interseccion: " . "\n";
    print_r($journiesIntersection);
  }

  public function prueba($int, $string){
    // return $string;  //returns the second argument passed into the function
    echo $int ." - ".$string;
  }

}
