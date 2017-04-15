<?php

use Illuminate\Database\Seeder;
use App\Models\Centrality;
use App\modelos\GeoPoint;

class CentralitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Se agrega centralidad 1
      $centralidad1 = new Centrality;
      $centralidad1->name = 'Plaza';
      $centralidad1->save();

      $punto1 = new GeoPoint;
      $punto1->latitude = -42.7672777;
      $punto1->length = -65.036735;

      $centralidad1->geoPoint()->save($punto1);
      //------------------------------------

      //Se agrega centralidad 2
      $centralidad2 = new Centrality;
      $centralidad2->name = 'Terminal';
      $centralidad2->location = 'En algun lugar de la ciudad';
      $centralidad2->save();

      $punto2 = new GeoPoint;
      $punto2->latitude = -42.7653271;
      $punto2->length = -65.0410575;

      $centralidad2->geoPoint()->save($punto2);
      //------------------------------------

      //Se agrega centralidad 3
      $centralidad3 = new Centrality;
      $centralidad3->name = 'UNPSJB';
      $centralidad3->location = 'En algun lugar de la ciudad';
      $centralidad3->save();

      $punto3 = new GeoPoint;
      $punto3->latitude = -42.7859094;
      $punto3->length = -65.0057736;

      $centralidad3->geoPoint()->save($punto3);
      //------------------------------------
    }
}
