<?php

use Illuminate\Database\Seeder;

use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;

use App\Models\Journey;

class JourneySeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        /*
        ****Trayecto 1**********
        */
        $trayecto1 = new Journey();
        $trayecto1->name = 'Trayecto 1';
        $trayecto1->description = 'El trayecto 1';
        $trayecto1->ponderacion = '5';
        $trayecto1->geom = new LineString([
            new Point(-42.781552, -65.040751),
            new Point(-42.780304, -65.037001),
            new Point(-42.780406, -65.037389),
            new Point(-42.779473, -65.034723),
            new Point(-42.781904, -65.033147),
            new Point(-42.779132, -65.025103),
        ]);
        $trayecto1->save();

        /*
        ****Trayecto 2**********
        */
        $trayecto2 = new Journey();
        $trayecto2->name = 'Trayecto 2';
        $trayecto2->description = 'El trayecto 2';
        $trayecto2->ponderacion = '4';
        $trayecto2->geom = new LineString([
            new Point(-42.77195334434509, -65.02963721752167),
            new Point( -42.767661809921265, -65.03238379955292),
            new Point(-42.76856303215027,  -65.03504455089569),
            new Point(-42.766631841659546, -65.036181807518),
        ]);
        $trayecto2->save();

        /*
        ****Trayecto 3**********
        */
        $trayecto3 = new Journey();
        $trayecto3->name = 'Trayecto 3';
        $trayecto3->description = 'El trayecto 3';
        $trayecto3->ponderacion = '0';
        $trayecto3->geom = new LineString([
            new Point(-42.768117785453796, -65.03694623708725),
            new Point( -42.783840894699104, -65.0270837545395),
            new Point(-42.785664796829224, -65.03242671489716),
            new Point(-42.782338857650764, -65.0344866514206),
            new Point(-42.783025503158576, -65.03654658794403),
        ]);
        $trayecto3->save();
    }
}
