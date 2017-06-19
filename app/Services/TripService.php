<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TripService {


  /**
  * Funcion que retorna la longitud (distancia Manhattan) del recorrido en metros.
  *
  * @param $id
  * @return float $mts
  */
  public function tripLength($id){
    $resultQry = DB::select('select ST_Length(t1.geom)
                            from trips t1
                            where t1.id = ?', [$id]);


    $result = $resultQry?$result[0]->length:0;
    return $result;

  }

}
