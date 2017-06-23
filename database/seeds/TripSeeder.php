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
      $trip1->frequency = 16;
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
      $trip2->frequency = 3;
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
      $trip3->frequency = 30;
      $trip3->geom = $linestring3;
      $trip3->save();

      // ********************** Usados para probar algoritmo "Recorridos similares" ********************
      //----------Recorrido N°4 ---------------

      $puntos4 = array();

      $punto18 = new Point(-65.05864278820195,-42.78316309314362);
      array_push($puntos4, $punto18);
      $punto19 = new Point(-65.05758599785008,-42.782781192819016);
      array_push($puntos4, $punto19);
      $punto20 = new Point(-65.05664722469487,-42.78247409600383);
      array_push($puntos4, $punto20);
      $punto21 = new Point(-65.05572454479375,-42.78216699766537);
      array_push($puntos4, $punto21);

      $linestring4 = new LineString($puntos4);

      $trip4 = new Trip();
      $trip4->name = 'Recorrido 4';
      $trip4->description = 'Recorrido similar 1';
      $trip4->distance_km = '1.2';
      $trip4->user = 'Juan P1';
      $trip4->time = date(DATE_RFC2822);
      $trip4->duration = date("12:00");
      $trip4->frequency = 50;
      $trip4->geom = $linestring4;
      $trip4->save();

      //----------Recorrido N°5 ---------------

      $puntos5 = array();

      $punto22 = new Point(-65.05758599785008,-42.782781192819016);
      array_push($puntos5, $punto22);
      $punto23 = new Point(-65.05664722469487,-42.78247409600383);
      array_push($puntos5, $punto23);
      $punto24 = new Point(-65.05572454479375,-42.78216699766537);
      array_push($puntos5, $punto24);
      $punto25 = new Point(-65.05500034835973,-42.78191895558765);
      array_push($puntos5, $punto25);
      $punto26 = new Point(-65.0543834402863,-42.78169453570867);
      array_push($puntos5, $punto26);
      $punto27 = new Point(-65.05360023525395,-42.78143468009569);  // bs as
      array_push($puntos5, $punto27);

      $linestring5 = new LineString($puntos5);

      $trip5 = new Trip();
      $trip5->name = 'Recorrido 5';
      $trip5->description = 'Recorrido similar 2';
      $trip5->distance_km = '1.4';
      $trip5->user = 'Juan P2';
      $trip5->time = date(DATE_RFC2822);
      $trip5->duration = date("15:00");
      $trip5->frequency = 20;
      $trip5->geom = $linestring5;
      $trip5->save();

      //----------Recorrido N°6 ---------------

      $puntos6 = array();

      $punto28 = new Point(-65.0580741598908,-42.78020350088649);
      array_push($puntos6, $punto28);
      $punto29 = new Point(-65.05736605671086,-42.7813374308327);
      array_push($puntos6, $punto29);
      $punto30 = new Point(-65.05664722469487,-42.78247409600383);
      array_push($puntos6, $punto30);
      $punto31 = new Point(-65.05572454479375,-42.78216699766537);
      array_push($puntos6, $punto31);
      $punto32 = new Point(-65.05500034835973,-42.78191895558765);
      array_push($puntos6, $punto32);

      $linestring6 = new LineString($puntos6);

      $trip6 = new Trip();
      $trip6->name = 'Recorrido 6';
      $trip6->description = 'Recorrido similar 3';
      $trip6->distance_km = '1.3';
      $trip6->user = 'Juan P3';
      $trip6->time = date(DATE_RFC2822);
      $trip6->duration = date("18:00");
      $trip6->frequency = 25;
      $trip6->geom = $linestring6;
      $trip6->save();

      //----------Recorrido N°7 ---------------

      $puntos7 = array();

      $punto33 = new Point(-65.05641119030156,-42.77960502948685);
      array_push($puntos7, $punto33);
      $punto34 = new Point(-65.05570308712163,-42.780778342968475);
      array_push($puntos7, $punto34);
      $punto35 = new Point(-65.05500034835973,-42.78191895558765);
      array_push($puntos7, $punto35);
      $punto36 = new Point(-65.05453364399114,-42.782683945671025); // dobla
      array_push($puntos7, $punto36);
      $punto37 = new Point(-65.0538791849915,-42.78244771711581);
      array_push($puntos7, $punto37);
      $punto38 = new Point(-65.05310670879521,-42.782187864664); // dobla --> Bs As
      array_push($puntos7, $punto38);
      $punto39 = new Point(-65.052527351648,-42.78310915479904);
      array_push($puntos7, $punto39);
      $punto40 = new Point(-65.05192653682866,-42.78409342398366);
      array_push($puntos7, $punto40);

      $linestring7 = new LineString($puntos7);

      $trip7 = new Trip();
      $trip7->name = 'Recorrido 7';
      $trip7->description = 'Recorrido similar 4';
      $trip7->distance_km = '2.1';
      $trip7->user = 'Juan P4';
      $trip7->time = date(DATE_RFC2822);
      $trip7->duration = date("22:00");
      $trip7->frequency = 110;
      $trip7->geom = $linestring7;
      $trip7->save();

      //----------Recorrido N°8 ---------------

      $puntos8 = array();

      $punto41 = new Point(-65.05505935695805,-42.78510917337457);
      array_push($puntos8, $punto41);
      $punto42 = new Point(-65.05411521938481,-42.78480208810705); // dobla arrib
      array_push($puntos8, $punto42);
      $punto43 = new Point(-65.05464093235173,-42.78384145256263);
      array_push($puntos8, $punto43);
      $punto44 = new Point(-65.05519883182683,-42.78292804756452); // dobla der
      array_push($puntos8, $punto44);
      $punto45 = new Point(-65.05453364399114,-42.782683945671025);
      array_push($puntos8, $punto45);
      $punto46 = new Point(-65.05390064266362,-42.78244771711581); // dobla ab
      array_push($puntos8, $punto46);
      $punto47 = new Point(-65.05333201435246,-42.78340050010814); //dobla der
      array_push($puntos8, $punto47);
      $punto48 = new Point(-65.052527351648,-42.78310915479904); // dobla ab
      array_push($puntos8, $punto48);
      $punto49 = new Point(-65.05192653682866,-42.78409342398366);
      array_push($puntos8, $punto49);

      $linestring8 = new LineString($puntos8);

      $trip8 = new Trip();
      $trip8->name = 'Recorrido 8';
      $trip8->description = 'Recorrido similar 5';
      $trip8->distance_km = '2.5';
      $trip8->user = 'Juan P5';
      $trip8->time = date(DATE_RFC2822);
      $trip8->duration = date("24:00");
      $trip8->frequency = 72;
      $trip8->geom = $linestring8;
      $trip8->save();

      // *************************************************************************************************

    }
}
