<?php

use Illuminate\Database\Seeder;
use App\Models\Journey;
use App\Models\GeoPoint;

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
        $trayecto1 = Journey::create( [
            'peso' => '5.0'
        ]);

        $puntos = array();

        $punto1 = new Geopoint([
            'latitude' => '-42.781552',
            'longitude' => '-65.040751',
            'order' => '1'
        ]);

        array_push($puntos, $punto1);

        $punto2 = new Geopoint([
            'latitude' => '-42.780304',
            'longitude' => '-65.037001',
            'order' => '2'
        ]);

        array_push($puntos, $punto2);

        $punto3 = new Geopoint ([
            'latitude' => '-42.780406',
            'longitude' => '-65.037389',
            'order' => '3'
        ]);

        array_push($puntos, $punto3);

        $punto4 = new Geopoint ([
            'latitude' => '-42.779473',
            'longitude' => '-65.034723',
            'order' => '4'
        ]);

        array_push($puntos, $punto4);

        $punto5 = new Geopoint ([
            'latitude' => '-42.781904',
            'longitude' => '-65.033147',
            'order' => '5'
        ]);

        array_push($puntos, $punto5);

        $punto6 = new Geopoint ([
            'latitude' => '-42.779132',
            'longitude' => '-65.025103',
            'order' => '6'
        ]);

        array_push($puntos, $punto6);

        foreach ($puntos as $punto)
        {
            $trayecto1->points()->save($punto);
        }
        ///////////////////////////////////

        /*
        ****Trayecto 2**********
        */
        $trayecto2 = Journey::create( [
            'peso' => '4.0'
        ]);

        $puntos2 = array();

        $punto7 = new Geopoint([
            'latitude' => '-42.77195334434509',
            'longitude' => '-65.02963721752167',
            'order' => '1'
        ]);

        array_push($puntos2, $punto7);

        $punto8 = new Geopoint([
            'latitude' => ' -42.767661809921265',
            'longitude' => '-65.03238379955292',
            'order' => '2'
        ]);

        array_push($puntos2, $punto8);

        $punto9 = new Geopoint ([
            'latitude' => '-42.76856303215027',
            'longitude' => ' -65.03504455089569',
            'order' => '3'
        ]);

        array_push($puntos2, $punto9);

        $punto10 = new Geopoint ([
            'latitude' => '-42.766631841659546',
            'longitude' => '-65.036181807518',
            'order' => '4'
        ]);

        array_push($puntos2, $punto10);

        foreach ($puntos2 as $punto)
        {
            $trayecto2->points()->save($punto);
        }
        ///////////////////////////////////

        /*
        ****Trayecto 3**********
        */
        $trayecto3 = Journey::create( [
            'peso' => '0'
        ]);

        $puntos3 = array();

        $punto11 = new Geopoint([
            'latitude' => '-42.768117785453796',
            'longitude' => '-65.03694623708725',
            'order' => '1'
        ]);

        array_push($puntos3, $punto11);

        $punto12 = new Geopoint([
            'latitude' => ' -42.783840894699104',
            'longitude' => '-65.0270837545395',
            'order' => '2'
        ]);

        array_push($puntos3, $punto12);

        $punto13 = new Geopoint ([
            'latitude' =>  '-42.785664796829224',
            'longitude' => '-65.03242671489716',
            'order' => '3'
        ]);

        array_push($puntos3, $punto13);

        $punto14 = new Geopoint ([
            'latitude' => '-42.782338857650764',
            'longitude' => '-65.0344866514206',
            'order' => '4'
        ]);

        array_push($puntos3, $punto14);

        $punto15 = new Geopoint ([
            'latitude' => '-42.783025503158576',
            'longitude' => '-65.03654658794403',
            'order' => '5'
        ]);

        array_push($puntos3, $punto15);

        foreach ($puntos3 as $punto)
        {
            $trayecto3->points()->save($punto);
        }
        ///////////////////////////////////

    }
}
