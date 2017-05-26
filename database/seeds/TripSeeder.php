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

        $trip1 = new Trip();
        $trip1->name = 'Recorrido 1';
        $trip1->description = 'UNPSJB a la casa de Demian';
        $trip1->distance_km = '1.5';
        $trip1->user = 'Demián Barry';
        $trip1->time = date(DATE_RFC2822);
        $trip1->duration = date("H:i:s");
        $trip1->geom = new LineString([
            new Point(-42.785433072287184, -65.00562071800232),
            new Point(-42.78510236674321, -65.00694036483765),
            new Point(-42.784976383214136, -65.00773429870605),
            new Point(-42.78490573167801, -65.0084088742733),
            new Point(-42.782913366452874, -65.01536250114441),
            new Point(-42.78147877687065, -65.0175513460938),
            new Point(-42.78338435801508, -65.02320544269719),
        ]);
        $trip1->save();

        //----------Recorrido N°2 ---------------

        $trip2 = new Trip();
        $trip2->name = 'Recorrido 2';
        $trip2->description = 'Terminal a monumento a los colonos galeses';
        $trip2->distance_km = '1.0';
        $trip2->user = 'Juan Pérez';
        $trip2->time = date(DATE_RFC2822);
        $trip2->duration = date("H:i:s");
        $trip2->geom = new LineString([
            new Point(-42.765932713793624, -65.04119770076909),
            new Point(-42.76669671991541, -65.04009799507298),
            new Point(-42.76513719225123, -65.0355436041657),
            new Point(-42.76710234820214, -65.03435270336308),
            new Point(-42.76659432788915, -65.03293113258519),
        ]);
        $trip2->save();

        //----------Recorrido N°3 ---------------

        $trip3 = new Trip();
        $trip3->name = 'Recorrido 3';
        $trip3->description = 'YPF J.B. Justo a parador Yoaquina';
        $trip3->distance_km = '2.0';
        $trip3->user = 'Juan Pérez';
        $trip3->time = date(DATE_RFC2822);
        $trip3->duration = date("H:i:s");
        $trip3->geom = new LineString([
            new Point(-42.772765114262484, -65.04040913131871),
            new Point(-42.7700519342084, -65.03244833496251),
            new Point(-42.77719494233547, -65.02794222381749),
            new Point(-42.77596643510379, -65.02440170791783),
            new Point(-42.77496628621933, -65.02548532035985),
        ]);
        $trip3->save();

    }
}
