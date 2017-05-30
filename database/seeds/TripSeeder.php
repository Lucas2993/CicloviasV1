<?php

use Illuminate\Database\Seeder;
use App\Models\Trip;

use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;


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

      $puntos = array();

      $punto1 = new Point(-65.00562071800232,-42.785433072287184);
      array_push($puntos, $punto1);
      $punto2 = new Point(-65.00694036483765,-42.78510236674321);
      array_push($puntos, $punto2);
      $punto3 = new Point(-65.00773429870605,-42.784976383214136);
      array_push($puntos, $punto3);
      $punto4 = new Point(-65.0084088742733,-42.78490573167801);
      array_push($puntos, $punto4);
      $punto5 = new Point(-65.01536250114441,-42.782913366452874);
      array_push($puntos, $punto5);
      $punto6 = new Point(-65.0175513460938,-42.78147877687065);
      array_push($puntos, $punto6);
      $punto7 = new Point(-65.02320544269719,-42.78338435801508);
      array_push($puntos, $punto7);

      $linestring = new LineString($puntos);

      $trip1 = new Trip();

      $trip1->name = 'Recorrido 1';
      $trip1->description = 'UNPSJB a la casa de Demian';
      $trip1->distance_km = '1.5';
      $trip1->user = 'Demián Barry';
      $trip1->time = date(DATE_RFC2822);
      $trip1->geom = $linestring;
      $trip1->duration = date('15:05');

      $trip1->save();

      //----------Recorrido N°2 ---------------

      $puntos2 = array();

      $punto8 = new Point(-65.04119770076909,-42.765932713793624);
      array_push($puntos2, $punto8);
      $punto9 = new Point(-65.04009799507298,-42.76669671991541);
      array_push($puntos2, $punto9);
      $punto10 = new Point(-65.0355436041657,-42.76513719225123);
      array_push($puntos2, $punto10);
      $punto11 = new Point(-65.03435270336308,-42.76710234820214);
      array_push($puntos2, $punto11);
      $punto12 = new Point(-65.03293113258519,-42.76659432788915);
      array_push($puntos2, $punto12);

      $linestring2 = new LineString($puntos2);

      $trip2 = new Trip();
      $trip2->name = 'Recorrido 2';
      $trip2->description = 'Terminal a monumento a los colonos galeses';
      $trip2->distance_km = '1.0';
      $trip2->user = 'Juan Pérez';
      $trip2->time = date(DATE_RFC2822);
      $trip2->duration = date("10:00");
      $trip2->geom = $linestring2;
      $trip2->save();

      //----------Recorrido N°3 ---------------

      $puntos3 = array();

      $punto13 = new Point(-65.04040913131871,-42.772765114262484);
      array_push($puntos3, $punto13);
      $punto14 = new Point(-65.03244833496251,-42.7700519342084);
      array_push($puntos3, $punto14);
      $punto15 = new Point(-65.02794222381749,-42.77719494233547);
      array_push($puntos3, $punto15);
      $punto16 = new Point( -65.02440170791783,-42.77596643510379);
      array_push($puntos3, $punto16);
      $punto17 = new Point( -65.02548532035985, -42.77496628621933);
      array_push($puntos3, $punto17);

      $linestring3 = new LineString($puntos3);

      $trip3 = new Trip();
      $trip3->name = 'Recorrido 3';
      $trip3->description = 'YPF J.B. Justo a parador Yoaquina';
      $trip3->distance_km = '2.0';
      $trip3->user = 'Juan Pérez';
      $trip3->time = date(DATE_RFC2822);
      $trip3->duration = date("20:00");
      $trip3->geom = $linestring3;
      $trip3->save();


    }
}
