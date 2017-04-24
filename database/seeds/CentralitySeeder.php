<?php

use Illuminate\Database\Seeder;
use App\Models\Centrality;
use App\Models\GeoPoint;

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
      $centralidad1->location = 'En algun lugar de la ciudad';
      $centralidad1->save();

      $punto1 = new GeoPoint;
      $punto1->latitude = -42.7672777;
      $punto1->longitude = -65.036735;
      $punto1->order = '-1';

      $centralidad1->geoPoint()->save($punto1);
      //------------------------------------

      //Se agrega centralidad 2
      $centralidad2 = new Centrality;
      $centralidad2->name = 'Terminal';
      $centralidad2->location = 'En algun lugar de la ciudad';
      $centralidad2->save();

      $punto2 = new GeoPoint;
      $punto2->latitude = -42.7653271;
      $punto2->longitude = -65.0410575;
      $punto2->order = '-1';

      $centralidad2->geoPoint()->save($punto2);
      //------------------------------------

      //Se agrega centralidad 3
      $centralidad3 = new Centrality;
      $centralidad3->name = 'UNPSJB';
      $centralidad3->location = 'En algun lugar de la ciudad';
      $centralidad3->save();

      $punto3 = new GeoPoint;
      $punto3->latitude = -42.7859094;
      $punto3->longitude = -65.0057736;
      $punto3->order = '-1';

      $centralidad3->geoPoint()->save($punto3);
      //------------------------------------

      //Se agrega centralidad 4
      $centralidad4 = new Centrality;
      $centralidad4->name = 'Hospital';
      $centralidad4->location = 'En algun lugar de la ciudad';
      $centralidad4->save();

      $punto4 = new GeoPoint;
      $punto4->latitude = -42.7593809;
      $punto4->longitude = -65.0409124;
      $punto4->order = '-1';

      $centralidad4->geoPoint()->save($punto4);
      //------------------------------------

      //Se agrega centralidad 5
      $centralidad5 = new Centrality;
      $centralidad5->name = 'Museo Oceanográfico';
      $centralidad5->location = 'En algun lugar de la ciudad';
      $centralidad5->save();

      $punto5 = new GeoPoint;
      $punto5->latitude = -42.76224;
      $punto5->longitude = -65.0400489;
      $punto5->order = '-1';

      $centralidad5->geoPoint()->save($punto5);
      //------------------------------------

      //Se agrega centralidad 6
      $centralidad6 = new Centrality;
      $centralidad6->name = 'Municipalidad';
      $centralidad6->location = 'En algun lugar de la ciudad';
      $centralidad6->save();

      $punto6 = new GeoPoint;
      $punto6->latitude = -42.7666303;
      $punto6->longitude = -65.0392266;
      $punto6->order = '-1';

      $centralidad6->geoPoint()->save($punto6);
      //------------------------------------

      //Se agrega centralidad 7
      $centralidad7 = new Centrality;
      $centralidad7->name = 'Clinica Santa Maria';
      $centralidad7->location = 'En algun lugar de la ciudad';
      $centralidad7->save();

      $punto7 = new GeoPoint;
      $punto7->latitude = -42.7711356;
      $punto7->longitude = -65.0335442;
      $punto7->order = '-1';

      $centralidad7->geoPoint()->save($punto7);
      //------------------------------------

      //Se agrega centralidad 8
      $centralidad8 = new Centrality;
      $centralidad8->name = 'Aeropuerto';
      $centralidad8->location = 'En algun lugar de la ciudad';
      $centralidad8->save();

      $punto8 = new GeoPoint;
      $punto8->latitude = -42.7691016;
      $punto8->longitude = -65.1062229;
      $punto8->order = '-1';

      $centralidad8->geoPoint()->save($punto8);
      //------------------------------------

      //Se agrega centralidad 9
      $centralidad9 = new Centrality;
      $centralidad9->name = 'Municerca 1';
      $centralidad9->location = 'En algun lugar de la ciudad';
      $centralidad9->save();

      $punto9 = new GeoPoint;
      $punto9->latitude = -42.7796763;
      $punto9->longitude = -65.069411;
      $punto9->order = '-1';

      $centralidad9->geoPoint()->save($punto9);
      //------------------------------------

      //Se agrega centralidad 10
      $centralidad10 = new Centrality;
      $centralidad10->name = 'CDI N°4';
      $centralidad10->location = 'En algun lugar de la ciudad';
      $centralidad10->save();

      $punto10 = new GeoPoint;
      $punto10->latitude = -42.7846824;
      $punto10->longitude = -65.0694021;
      $punto10->order = '-1';

      $centralidad10->geoPoint()->save($punto10);
      //------------------------------------
    }
}
