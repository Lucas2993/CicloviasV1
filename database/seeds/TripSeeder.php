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
      $punto1 = GeoPoint::create(['latitude'=>'-42.785433072287184', 'longitude'=>'-65.00562071800232','order' => '1']);
      $punto2 = GeoPoint::create(['latitude'=>'-42.78510236674321', 'longitude'=>'-65.00694036483765','order' => '2']);
      $punto3 = GeoPoint::create(['latitude'=>'-42.784976383214136', 'longitude'=>'-65.00773429870605','order' => '3']);
      $punto4 = GeoPoint::create(['latitude'=>'-42.78490573167801', 'longitude'=>'-65.0084088742733','order' => '4']);
      $punto5 = GeoPoint::create(['latitude'=>'-42.782913366452874', 'longitude'=>'-65.01536250114441','order' => '5']);
      $punto6 = GeoPoint::create(['latitude'=>'-42.78147877687065', 'longitude'=>'-65.0175513460938','order' => '6']);
      $punto7 = GeoPoint::create(['latitude'=>'-42.78338435801508', 'longitude'=>'-65.02320544269719','order' => '7']);

      $trip1 = Trip::create([
          'name'=>'Recorrido 1',
          'description'=>'UNPSJB a la casa de Demian'
      ]);
      $trip1->geopoints()->save($punto1);
      $trip1->geopoints()->save($punto2);
      $trip1->geopoints()->save($punto3);
      $trip1->geopoints()->save($punto4);
      $trip1->geopoints()->save($punto5);
      $trip1->geopoints()->save($punto6);
      $trip1->geopoints()->save($punto7);

      //----------Recorrido N°2 ---------------

      $punto8 = GeoPoint::create(['latitude'=>'-42.765932713793624', 'longitude'=>'-65.04119770076909','order' => '1']);
      $punto9 = GeoPoint::create(['latitude'=>'-42.76669671991541', 'longitude'=>'-65.04009799507298','order' => '2']);
      $punto10 = GeoPoint::create(['latitude'=>'-42.76513719225123', 'longitude'=>'-65.0355436041657','order' => '3']);
      $punto11 = GeoPoint::create(['latitude'=>'-42.76710234820214', 'longitude'=>'-65.03435270336308','order' => '4']);
      $punto12 = GeoPoint::create(['latitude'=>'-42.76659432788915', 'longitude'=>'-65.03293113258519','order' => '5']);

      $trip2 = Trip::create([
          'name'=>'Recorrido 2',
          'description'=>'Terminal a monumento a los colonos galeses'
      ]);
      $trip2->geopoints()->save($punto8);
      $trip2->geopoints()->save($punto9);
      $trip2->geopoints()->save($punto10);
      $trip2->geopoints()->save($punto11);
      $trip2->geopoints()->save($punto12);

      //----------Recorrido N°3 ---------------

      $punto13 = GeoPoint::create(['latitude'=>'-42.772765114262484', 'longitude'=>'-65.04040913131871','order' => '1']);
      $punto14 = GeoPoint::create(['latitude'=>'-42.7700519342084', 'longitude'=>'-65.03244833496251','order' => '2']);
      $punto15 = GeoPoint::create(['latitude'=>'-42.77719494233547', 'longitude'=>'-65.02794222381749','order' => '3']);
      $punto16 = GeoPoint::create(['latitude'=>'-42.77596643510379', 'longitude'=>'-65.02440170791783','order' => '4']);
      $punto17 = GeoPoint::create(['latitude'=>'-42.77496628621933', 'longitude'=>'-65.02548532035985','order' => '5']);

      $trip3 = Trip::create([
          'name'=>'Recorrido 3',
          'description'=>'YPF J.B. Justo a parador Yoaquina'
      ]);
      $trip3->geopoints()->save($punto13);
      $trip3->geopoints()->save($punto14);
      $trip3->geopoints()->save($punto15);
      $trip3->geopoints()->save($punto16);
      $trip3->geopoints()->save($punto17);
    }
}
