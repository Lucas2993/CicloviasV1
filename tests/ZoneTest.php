<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Polygon;
use Phaza\LaravelPostgis\PostgisConnection;

use App\Models\Zone;

class ZoneTest extends TestCase{
    use WithoutMiddleware;

    public function testModel(){
        // // Se crean dos nuevos puntos y se los incluye en un arreglo.
        // $point_1 = new GeoPoint(['latitude' => '-42.7672777','longitude' => '-65.036735);
        // $point_2 = new GeoPoint(['latitude' => '-42.036735','longitude' => '-65.7672777'2']);
        // $points = array($point_1, $point_2);
        // // Se crea una zona incorporando el arreglo de puntos.
        // $zone = new Zone(['name' => 'Nueva zona','description' => 'Alta zona','color'=>'blue','points' => $points]);
        // // Se comprueba el funcionamiento del modelo.
        // $this->assertTrue(count($zone->points) == 2);
        // $this->assertTrue($zone->name == 'Nueva zona');
        // $this->assertTrue($zone->description == 'Alta zona');
    }

    public function testSave(){
        $collection = new LineString(
            [
                new Point(-42.77788032338284, -65.06312456999065),
                new Point(-42.77191064812362, -65.05806148137869),
                new Point(-42.77224340967962, -65.05705447953142),
                new Point(-42.77254473909872, -65.05635291423579),
                new Point(-42.77305955559163, -65.05527148108834),
                new Point(-42.773159551696494, -65.05507752384891),
                new Point(-42.77379054136739, -65.05385368216655),
                new Point(-42.77448867008272, -65.0524833248167),
                new Point(-42.775051179604674, -65.05140013146959),
                new Point(-42.775132735522554, -65.05123517561515),
                new Point(-42.77562810600011, -65.05006413992275),
                new Point(-42.77580664053772, -65.04942753437675),
                new Point(-42.77591853894509, -65.0497427777551),
                new Point(-42.775973943325056, -65.04960456017177),
                new Point(-42.77602783896248, -65.04977974194807),
                new Point(-42.77660183169178, -65.04941680554067),
                new Point(-42.77713341199106, -65.04908060740439),
                new Point(-42.7766747542494, -65.04773112099346),
                new Point(-42.777812262329064, -65.04699745300867),
                new Point(-42.778972150090226, -65.0462968097224),
                new Point(-42.77971881002492, -65.04582474093567),
                new Point(-42.77992810614717, -65.04643888298118),
                new Point(-42.78017336063402, -65.0471586370067),
                new Point(-42.78043286435627, -65.04792013291001),
                new Point(-42.78065900810389, -65.0485840634604),
                new Point(-42.78086034141813, -65.04917481999605),
                new Point(-42.78108866446058, -65.04984495315479),
                new Point(-42.78130692921919, -65.05048583347143),
                new Point(-42.7814223480259, -65.05082437854061),
                new Point(-42.781464760455975, -65.05094884980274),
                new Point(-42.78630631536706, -65.04638708281958),
                new Point(-42.78624060124616, -65.04620670426328),
                new Point(-42.78578420661836, -65.0448956069689),
                new Point(-42.785431579951876, -65.04383395511293),
                new Point(-42.785004019070975, -65.04252143289499),
                new Point(-42.78563157216157, -65.04212304103716),
                new Point(-42.786162481908605, -65.04178600471054),
                new Point(-42.78667914242021, -65.0414475434604),
                new Point(-42.78753024086845, -65.04093063149169),
                new Point(-42.788327108403166, -65.0403968718976),
                new Point(-42.78873086467902, -65.04015773620006),
                new Point(-42.7890646320634, -65.03996017474226),
                new Point(-42.78980743632263, -65.03952012482564),
                new Point(-42.790889623841366, -65.03887932832804),
                new Point(-42.79104033046042, -65.03879358145856),
                new Point(-42.791100344887155, -65.03950294192414),
                new Point(-42.79114954665877, -65.04022487524446),
                new Point(-42.79119547948815, -65.04089928317381),
                new Point(-42.79132154331188, -65.0424050082599),
                new Point(-42.79146344893263, -65.04395783964183),
                new Point(-42.791561852475866, -65.04514421421702),
                new Point(-42.79164718025018, -65.04629111002825),
                new Point(-42.791752121677916, -65.04740933973062),
                new Point(-42.791868378674934, -65.04868120971817),
                new Point(-42.791989664813855, -65.05020151931578),
                new Point(-42.79231597230441, -65.05348043601823),
                new Point(-42.79231613994247, -65.05348261531306),
                new Point(-42.79236341387636, -65.05404755558695),
                new Point(-42.787676756535916, -65.05701910790003),
                new Point(-42.78708231196285, -65.0573964611809),
                new Point(-42.78729060225671, -65.05801085468352),
                new Point(-42.78750568189215, -65.05866246383623),
                new Point(-42.78656657346059, -65.05924668248741),
                new Point(-42.78563333236124, -65.05982712928218),
                new Point(-42.784689613882925, -65.06041428159948),
                new Point(-42.784269345257826, -65.05918063309039),
                new Point(-42.78351363286771, -65.05965991031387),
                new Point(-42.78238014810154, -65.06037882614905),
                new Point(-42.78122361310167, -65.0611124103148),
                new Point(-42.78011560932114, -65.06181506525785),
                new Point(-42.78003254466071, -65.06186770360978),
                new Point(-42.77911103822581, -65.06240582179352),
                new Point(-42.777930111887684, -65.0630954009676),
                new Point(-42.77788032338284, -65.06312456999065),
            ]
        );

        $zone1 = new Zone();
        $zone1->name = 'Barrio fontana';
        $zone1->description = 'Barrio 9';
        $zone1->color = 'orange';
        $zone1->geom = new Polygon([$collection]);

        $zone1->save();
        Zone::destroy($zone1->id);
        $this->assertTrue(true);
        // // Se obtiene la cantidad de zonas almacenadas antes de guardar la zona nueva.
        // $records_before = count(Zone::All());
        // // Se crea y persiste una nueva zona.
        // $zone = Zone::create(['name' => 'Nueva zona','description' => 'Alta zona','color'=>'blue']);
        // // Se obtiene la cantidad de zonas almacenadas luego de guardar la zona nueva.
        // $records_after = count(Zone::All());
        // // Se comprueba que la nueva zona se haya guardado (deberia haber una zona mas almacenada).
        // $this->assertTrue($records_after > $records_before);
        //
        // // Se eliminan los datos usados.
        // Zone::destroy($zone->id);
    }

    public function testGeoPoints(){
        // // Se crea y persiste una nueva zona.
        // $zone = Zone::create(['name' => 'Nueva zona','description' => 'Alta zona','color'=>'blue']);
        // // Se crean y persisten dos nuevos puntos.
        // $point_1 = new Point(-42.7672777','longitude' => '-65.036735);
        // $point_2 = new Point(-42.036735','longitude' => '-65.7672777'2']);
        // // Se asocian los nuevos puntos
        // $zone->geopoints()->save($point_1);
        // $zone->geopoints()->save($point_2);
        // // Se recupera la zona recientemente guardada.
        // $zone_db = Zone::find($zone->id);
        // // Se recuperan los puntos.
        // $points = $zone_db->geopoints()->get();
        // // Se corrobora que los dos puntos asignados esten.
        // $this->assertTrue(count($points) == 2);
        // $this->assertTrue($points[0]->order == '1');
        // $this->assertTrue($points[1]->order == '2');
        //
        // // Se eliminan los datos usados.
        // GeoPoint::destroy($point_1->id);
        // GeoPoint::destroy($point_2->id);
        // Zone::destroy($zone->id);
    }
}
