<?php

use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\Models\GeoPoint;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //----------Zona 1: Barrio Peron ---------------
        $punto1 = GeoPoint::create(['latitude'=>'-42.7871448', 'longitude'=>'-65.0697815']);
        $punto2 = GeoPoint::create(['latitude'=>'-42.7891147', 'longitude'=>'-65.0686872']);
        $punto3 = GeoPoint::create(['latitude'=>'-42.7917497', 'longitude'=>'-65.0731744']);
        $punto4 = GeoPoint::create(['latitude'=>'-42.78765', 'longitude'=>'-65.0755313']);

        $zona1 = Zone::create([
          'name'=>'Barrio Peron',
          'description'=>'Gales-Villarino y R.Gimenez/Reinal'
        ]);
        $zona1->geopoints()->save($punto1);
        $zona1->geopoints()->save($punto2);
        $zona1->geopoints()->save($punto3);
        $zona1->geopoints()->save($punto4);
      //--------------------------------

      //----------Zona 2: Zona Inventada 1---------------
        $punto5 = GeoPoint::create(['latitude'=>'-42.7814254', 'longitude'=>'-65.057715']);
        $punto6 = GeoPoint::create(['latitude'=>'-42.7804549', 'longitude'=>'-65.0607623']);
        $punto7 = GeoPoint::create(['latitude'=>'-42.7854272', 'longitude'=>'-65.0568768']);
        $punto8 = GeoPoint::create(['latitude'=>'-42.7841716', 'longitude'=>'-65.0528535']);

        $zona2 = Zone::create([
          'name'=>'Zona Inventada 1',
          'description'=>'Gales-Alem y Santiago y Bs. As.'
        ]);

        $zona2->geopoints()->save($punto5);
        $zona2->geopoints()->save($punto6);
        $zona2->geopoints()->save($punto7);
        $zona2->geopoints()->save($punto8);
        //--------------------------------
      //----------Zona 3: Zona Inventada 2 ---------------
      $punto9 = GeoPoint::create(['latitude'=>'-42.782642', 'longitude'=>'-65.043939']);
      $punto10 = GeoPoint::create(['latitude'=>'-42.785006', 'longitude'=>'-65.042433']);
      $punto11 = GeoPoint::create(['latitude'=>'-42.782282', 'longitude'=>'-65.034504']);
      $punto12 = GeoPoint::create(['latitude'=>'-42.779910', 'longitude'=>'-65.035965']);


      $zona3 = new Zone([
        'name'=>'Zona Inventada 2',
        'description'=>'Villarino-Lewis Jone y L. Piedra Buena y J.B Justo'
      ]);
      $zona3->geopoints()->save($punto9);
      $zona3->geopoints()->save($punto10);
      $zona3->geopoints()->save($punto11);
      $zona3->geopoints()->save($punto12);
    //
      //--------------------------------

      //----------Zona 4:  Zona Inventada 3---------------
      $punto13 = GeoPoint::create(['latitude'=>'-42.776742', 'longitude'=>'-65.026503']);
      $punto14 = GeoPoint::create(['latitude'=>'-42.776065', 'longitude'=>'-65.024572']);
      $punto15 = GeoPoint::create(['latitude'=>'-42.779131', 'longitude'=>'-65.025093']);
      $punto16 = GeoPoint::create(['latitude'=>'-42.778084', 'longitude'=>'-65.022003']);

      $zona4 = new Zone([
        'name'=>'Zona Inventada 3',
        'description'=>'Fragata Sarmiento-E.Roberts y A. J.A Roca-Bv Almte Brown.'
      ]);
      $zona4->geopoints()->save($punto13);
      $zona4->geopoints()->save($punto14);
      $zona4->geopoints()->save($punto15);
      $zona4->geopoints()->save($punto16);
      // //--------------------------------
    }
}
