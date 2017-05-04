<?php

use Illuminate\Database\Seeder;
use App\Models\Trip;
use App\Models\GeoPoint;


class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //----------Recorrido N°1 ---------------
      $punto1 = GeoPoint::create(['latitude'=>'-42.78505366189581', 'longitude'=>'-65.00609294918218','order' => '1']);
      $punto2 = GeoPoint::create(['latitude'=>'-42.78147877687065', 'longitude'=>'-65.0175513460938','order' => '2']);
      $punto3 = GeoPoint::create(['latitude'=>'-42.78338435801508', 'longitude'=>'-65.02320544269719','order' => '3']);

      $trip1 = Trip::create([
          'name'=>'Recorrido 1',
          'description'=>'UNPSJB a la casa de Demian'
      ]);
      $trip1->geopoints()->save($punto1);
      $trip1->geopoints()->save($punto2);
      $trip1->geopoints()->save($punto3);

      //----------Recorrido N°2 ---------------

      $punto4 = GeoPoint::create(['latitude'=>'-42.765932713793624', 'longitude'=>'-65.04119770076909','order' => '1']);
      $punto5 = GeoPoint::create(['latitude'=>'-42.76669671991541', 'longitude'=>'-65.04009799507298','order' => '2']);
      $punto6 = GeoPoint::create(['latitude'=>'-42.76513719225123', 'longitude'=>'-65.0355436041657','order' => '3']);
      $punto7 = GeoPoint::create(['latitude'=>'-42.76710234820214', 'longitude'=>'-65.03435270336308','order' => '4']);
      $punto8 = GeoPoint::create(['latitude'=>'-42.76659432788915', 'longitude'=>'-65.03293113258519','order' => '5']);

      $trip2 = Trip::create([
          'name'=>'Recorrido 2',
          'description'=>'Terminal a monumento a los colonos galeses'
      ]);
      $trip2->geopoints()->save($punto4);
      $trip2->geopoints()->save($punto5);
      $trip2->geopoints()->save($punto6);
      $trip2->geopoints()->save($punto7);
      $trip2->geopoints()->save($punto8);

      //----------Recorrido N°3 ---------------

      $punto9 = GeoPoint::create(['latitude'=>'-42.772765114262484', 'longitude'=>'-65.04040913131871','order' => '1']);
      $punto10 = GeoPoint::create(['latitude'=>'-42.7700519342084', 'longitude'=>'-65.03244833496251','order' => '2']);
      $punto11 = GeoPoint::create(['latitude'=>'-42.77719494233547', 'longitude'=>'-65.02794222381749','order' => '3']);
      $punto12 = GeoPoint::create(['latitude'=>'-42.77596643510379', 'longitude'=>'-65.02440170791783','order' => '4']);
      $punto13 = GeoPoint::create(['latitude'=>'-42.77496628621933', 'longitude'=>'-65.02548532035985','order' => '5']);

      $trip3 = Trip::create([
          'name'=>'Recorrido 3',
          'description'=>'YPF J.B. Justo a parador Yoaquina'
      ]);
      $trip3->geopoints()->save($punto9);
      $trip3->geopoints()->save($punto10);
      $trip3->geopoints()->save($punto11);
      $trip3->geopoints()->save($punto12);
      $trip3->geopoints()->save($punto13);
    }
}
