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
    public function run(){
        //Se agrega la Centralidad N°1

        $centralidad1 = new Centrality;
        $centralidad1->name = 'Escuela Nro. 42';
        $centralidad1->location = '25 De Mayo 1090';

        $centralidad1->save();

        $punto1 = new GeoPoint;
        $punto1->latitude = -42.775144;
        $punto1->longitude = -65.029309;
        $punto1->order = '-1';

        $centralidad1->geoPoint()->save($punto1);

        //------------------------------------

        //Se agrega la Centralidad N°2

        $centralidad2 = new Centrality;
        $centralidad2->name = 'Escuela Nro. 46';
        $centralidad2->location = 'Juan Muzzio 707';

        $centralidad2->save();

        $punto2 = new GeoPoint;
        $punto2->latitude = -42.764473;
        $punto2->longitude = -65.046056;
        $punto2->order = '-1';

        $centralidad2->geoPoint()->save($punto2);

        //------------------------------------

        //Se agrega la Centralidad N°3

        $centralidad3 = new Centrality;
        $centralidad3->name = 'Escuela Nro. 84 - 607 - 7701';
        $centralidad3->location = 'Sarmiento 268';

        $centralidad3->save();

        $punto3 = new GeoPoint;
        $punto3->latitude = -42.769791;
        $punto3->longitude = -65.035243;
        $punto3->order = '-1';

        $centralidad3->geoPoint()->save($punto3);

        //------------------------------------

        //Se agrega la Centralidad N°4

        $centralidad4 = new Centrality;
        $centralidad4->name = 'Escuela Nro. 110';
        $centralidad4->location = 'Av.Gales 1050';

        $centralidad4->save();

        $punto4 = new GeoPoint;
        $punto4->latitude = -42.774374;
        $punto4->longitude = -65.045014;
        $punto4->order = '-1';

        $centralidad4->geoPoint()->save($punto4);

        //------------------------------------

        //Se agrega la Centralidad N°5

        $centralidad5 = new Centrality;
        $centralidad5->name = 'Escuela Nro. 124';
        $centralidad5->location = 'Av. Domec García Norte 299-399';

        $centralidad5->save();

        $punto5 = new GeoPoint;
        $punto5->latitude = -42.75926649570465;
        $punto5->longitude = -65.03874868154526;
        $punto5->order = '-1';

        $centralidad5->geoPoint()->save($punto5);

        //------------------------------------

        //Se agrega la Centralidad N°6

        $centralidad6 = new Centrality;
        $centralidad6->name = 'Escuela Nro. 150';
        $centralidad6->location = 'Fuerte San Jose 115';

        $centralidad6->save();

        $punto6 = new GeoPoint;
        $punto6->latitude =  -42.76753842830658;
        $punto6->longitude = -65.04273980855942;
        $punto6->order = '-1';

        $centralidad6->geoPoint()->save($punto6);

        //------------------------------------

        //Se agrega la Centralidad N°7

        $centralidad7 = new Centrality;
        $centralidad7->name = 'Escuela Nro. 152';
        $centralidad7->location = 'La Pampa 579';

        $centralidad7->save();

        $punto7 = new GeoPoint;
        $punto7->latitude = -42.776885;
        $punto7->longitude = -65.053322;
        $punto7->order = '-1';

        $centralidad7->geoPoint()->save($punto7);

        //------------------------------------

        //Se agrega la Centralidad N°8

        $centralidad8 = new Centrality;
        $centralidad8->name = 'Escuela Nro. 158';
        $centralidad8->location = 'Av. Julio A. Roca 1750';

        $centralidad8->save();

        $punto8 = new GeoPoint;
        $punto8->latitude = -42.780299;
        $punto8->longitude = -65.024358;
        $punto8->order = '-1';

        $centralidad8->geoPoint()->save($punto8);

        //------------------------------------

        //Se agrega la Centralidad N°9

        $centralidad9 = new Centrality;
        $centralidad9->name = 'Escuela Nro. 168';
        $centralidad9->location = 'Santa Cruz 1155';

        $centralidad9->save();

        $punto9 = new GeoPoint;
        $punto9->latitude = -42.784195;
        $punto9->longitude = -65.053651;
        $punto9->order = '-1';

        $centralidad9->geoPoint()->save($punto9);

        //------------------------------------

        //Se agrega la Centralidad N°10

        $centralidad10 = new Centrality;
        $centralidad10->name = 'Escuela Nro. 170';
        $centralidad10->location = 'Jose Menendez 445';

        $centralidad10->save();

        $punto10 = new GeoPoint;
        $punto10->latitude = -42.76108;
        $punto10->longitude = -65.042743;
        $punto10->order = '-1';

        $centralidad10->geoPoint()->save($punto10);

        //------------------------------------

        //Se agrega la Centralidad N°11

        $centralidad11 = new Centrality;
        $centralidad11->name = 'Escuela Nro. 213';
        $centralidad11->location = 'Santiago Del Estero 1051';

        $centralidad11->save();

        $punto11 = new GeoPoint;
        $punto11->latitude = -42.784645;
        $punto11->longitude = -65.059035;
        $punto11->order = '-1';

        $centralidad11->geoPoint()->save($punto11);

        //------------------------------------

        //Se agrega la Centralidad N°12

        $centralidad12 = new Centrality;
        $centralidad12->name = 'Escuela Nro. 222';
        $centralidad12->location = 'Albarracin y C. Marzullo';

        $centralidad12->save();

        $punto12 = new GeoPoint;
        $punto12->latitude = -42.78757452964783;
        $punto12->longitude = -65.0732606649399;
        $punto12->order = '-1';

        $centralidad12->geoPoint()->save($punto12);

        //------------------------------------

        //Se agrega la Centralidad N°13

        $centralidad13 = new Centrality;
        $centralidad13->name = 'Escuela Nro. 305';
        $centralidad13->location = 'Roberto Gomez 383';

        $centralidad13->save();

        $punto13 = new GeoPoint;
        $punto13->latitude = -42.759297;
        $punto13->longitude = -65.04168;
        $punto13->order = '-1';

        $centralidad13->geoPoint()->save($punto13);

        //------------------------------------

        //Se agrega la Centralidad N°14

        $centralidad14 = new Centrality;
        $centralidad14->name = 'Escuela Nro. 410';
        $centralidad14->location = 'Mitre 581';

        $centralidad14->save();

        $punto14 = new GeoPoint;
        $punto14->latitude =  -42.770329;
        $punto14->longitude = -65.033941;
        $punto14->order = '-1';

        $centralidad14->geoPoint()->save($punto14);

        //------------------------------------

        //Se agrega la Centralidad N°15

        $centralidad15 = new Centrality;
        $centralidad15->name = 'Escuela Nro. 434';
        $centralidad15->location = 'Santiago Del Estero 1051';
        $centralidad15->save();

        $punto15 = new GeoPoint;
        $punto15->latitude = -42.784781;
        $punto15->longitude = -65.058936;
        $punto15->order = '-1';

        $centralidad15->geoPoint()->save($punto15);

        //------------------------------------

        //Se agrega la Centralidad N°16

        $centralidad16 = new Centrality;
        $centralidad16->name = 'Escuela Nro. 448';
        $centralidad16->location = 'Domecq Garcia 645';

        $centralidad16->save();

        $punto16 = new GeoPoint;
        $punto16->latitude = -42.767423;
        $punto16->longitude = -65.044225;
        $punto16->order = '-1';

        $centralidad16->geoPoint()->save($punto16);

        //------------------------------------

        //Se agrega la Centralidad N°17

        $centralidad17 = new Centrality;
        $centralidad17->name = 'Escuela Nro. 449';
        $centralidad17->location = 'Necochea Y Juan XXIII';

        $centralidad17->save();

        $punto17 = new GeoPoint;
        $punto17->latitude = -42.759759;
        $punto17->longitude = -65.049028;
        $punto17->order = '-1';

        $centralidad17->geoPoint()->save($punto17);

        //------------------------------------

        //Se agrega la Centralidad N°18

        $centralidad18 = new Centrality;
        $centralidad18->name = 'Escuela Nro. 457';
        $centralidad18->location = 'La Pampa Y Gales 579';

        $centralidad18->save();

        $punto18 = new GeoPoint;
        $punto18->latitude = -42.776736;
        $punto18->longitude = -65.053457;
        $punto18->order = '-1';

        $centralidad18->geoPoint()->save($punto18);

        //------------------------------------

        //Se agrega la Centralidad N°19

        $centralidad19 = new Centrality;
        $centralidad19->name = 'Escuela Nro. 464';
        $centralidad19->location = 'Travelin 1285';

        $centralidad19->save();

        $punto19 = new GeoPoint;
        $punto19->latitude = -42.761816;
        $punto19->longitude = -65.059728;
        $punto19->order = '-1';

        $centralidad19->geoPoint()->save($punto19);

        //------------------------------------

        //Se agrega la Centralidad N°20

        $centralidad20 = new Centrality;
        $centralidad20->name = 'Escuela Nro. 516';
        $centralidad20->location = 'Jose Podesta 168';

        $centralidad20->save();

        $punto20 = new GeoPoint;
        $punto20->latitude = -42.761522;
        $punto20->longitude = -65.044193;
        $punto20->order = '-1';

        $centralidad20->geoPoint()->save($punto20);

        //------------------------------------

        //Se agrega la Centralidad N°21

        $centralidad21 = new Centrality;
        $centralidad21->name = 'Escuela Nro. 520';
        $centralidad21->location = 'Roberto Gomez 75';

        $centralidad21->save();

        $punto21 = new GeoPoint;
        $punto21->latitude = -42.759901;
        $punto21->longitude = -65.038129;
        $punto21->order = '-1';

        $centralidad21->geoPoint()->save($punto21);

        //------------------------------------

        //Se agrega la Centralidad N°22

        $centralidad22 = new Centrality;
        $centralidad22->name = 'Escuela Nro. 524';
        $centralidad22->location = 'Espora 505';

        $centralidad22->save();

        $punto22 = new GeoPoint;
        $punto22->latitude = -42.764992;
        $punto22->longitude = -65.044811;
        $punto22->order = '-1';

        $centralidad22->geoPoint()->save($punto22);

        //------------------------------------

        //Se agrega la Centralidad N°23

        $centralidad23 = new Centrality;
        $centralidad23->name = 'Escuela Nro. 556';
        $centralidad23->location = 'Albarracin 25';

        $centralidad23->save();

        $punto23 = new GeoPoint;
        $punto23->latitude =  -42.772016;
        $punto23->longitude = -65.030024;
        $punto23->order = '-1';

        $centralidad23->geoPoint()->save($punto23);

        //------------------------------------

        //Se agrega la Centralidad N°24

        $centralidad24 = new Centrality;
        $centralidad24->name = 'Escuela Nro. 651';
        $centralidad24->location = 'Rosales Nº 695';

        $centralidad24->save();

        $punto24 = new GeoPoint;
        $punto24->latitude =  -42.7753221988678;
        $punto24->longitude = -65.04394948482513;
        $punto24->order = '-1';

        $centralidad24->geoPoint()->save($punto24);

        //------------------------------------

        //Se agrega la Centralidad N°25

        $centralidad25 = new Centrality;
        $centralidad25->name = 'Escuela Nro. 617';
        $centralidad25->location = 'Fuerte San Jose 115';

        $centralidad25->save();

        $punto25 = new GeoPoint;
        $punto25->latitude = -42.76772618293762;
        $punto25->longitude = -65.04238307476045;
        $punto25->order = '-1';

        $centralidad25->geoPoint()->save($punto25);

        //------------------------------------

        //Se agrega la Centralidad N°26

        $centralidad26 = new Centrality;
        $centralidad26->name = 'Escuela Nro. 703';
        $centralidad26->location = 'Villegas 451';

        $centralidad26->save();

        $punto26 = new GeoPoint;
        $punto26->latitude = -42.772214;
        $punto26->longitude = -65.04402;
        $punto26->order = '-1';

        $centralidad26->geoPoint()->save($punto26);

        //------------------------------------

        //Se agrega la Centralidad N°27

        $centralidad27 = new Centrality;
        $centralidad27->name = 'Escuela Nro. 728';
        $centralidad27->location = 'Roberts 61';

        $centralidad27->save();

        $punto27 = new GeoPoint;
        $punto27->latitude = -42.77883;
        $punto27->longitude = -65.02429;
        $punto27->order = '-1';

        $centralidad27->geoPoint()->save($punto27);

        //------------------------------------

        //Se agrega la Centralidad N°28

        $centralidad28 = new Centrality;
        $centralidad28->name = 'Escuela Nro. 741';
        $centralidad28->location = 'Moreno 142';

        $centralidad28->save();

        $punto28 = new GeoPoint;
        $punto28->latitude = -42.774426;
        $punto28->longitude = -65.030419;
        $punto28->order = '-1';

        $centralidad28->geoPoint()->save($punto28);

        //------------------------------------

        //Se agrega la Centralidad N°29

        $centralidad29 = new Centrality;
        $centralidad29->name = 'Escuela Nro. 750';
        $centralidad29->location = 'Avda. Gales 892';

        $centralidad29->save();

        $punto29 = new GeoPoint;
        $punto29->latitude = -42.773617;
        $punto29->longitude = -65.043012;
        $punto29->order = '-1';

        $centralidad29->geoPoint()->save($punto29);

        //------------------------------------

        //Se agrega la Centralidad N°30

        $centralidad30 = new Centrality;
        $centralidad30->name = 'Escuela Nro. 785';
        $centralidad30->location = 'Jauretche 1041';

        $centralidad30->save();

        $punto30 = new GeoPoint;
        $punto30->latitude = -42.751165;
        $punto30->longitude = -65.047066;
        $punto30->order = '-1';

        $centralidad30->geoPoint()->save($punto30);

        //------------------------------------

        //Se agrega la Centralidad N°31

        $centralidad31 = new Centrality;
        $centralidad31->name = 'Escuela Nro. 786';
        $centralidad31->location = 'J. Menendez 445';

        $centralidad31->save();

        $punto31 = new GeoPoint;
        $punto31->latitude = -42.761163;
        $punto31->longitude = -65.042732;
        $punto31->order = '-1';

        $centralidad31->geoPoint()->save($punto31);

        //------------------------------------

        //Se agrega la Centralidad N°32

        $centralidad32 = new Centrality;
        $centralidad32->name = 'Escuela Nro. 803';
        $centralidad32->location = '25 de Mayo 1068';

        $centralidad32->save();

        $punto32 = new GeoPoint;
        $punto32->latitude = -42.774909;
        $punto32->longitude = -65.029442;
        $punto32->order = '-1';

        $centralidad32->geoPoint()->save($punto32);

        //------------------------------------

        //Se agrega la Centralidad N°33

        $centralidad33 = new Centrality;
        $centralidad33->name = 'Escuela Nro. 805';
        $centralidad33->location = 'Pujol 255';

        $centralidad33->save();

        $punto33 = new GeoPoint;
        $punto33->latitude = -42.759943;
        $punto33->longitude = -65.040543;
        $punto33->order = '-1';

        $centralidad33->geoPoint()->save($punto33);

        //------------------------------------

        //Se agrega la Centralidad N°34

        $centralidad34 = new Centrality;
        $centralidad34->name = 'Escuela Nro. 1020';
        $centralidad34->location = 'Colon 352';

        $centralidad34->save();

        $punto34 = new GeoPoint;
        $punto34->latitude = -42.77217;
        $punto34->longitude = -65.047334;
        $punto34->order = '-1';

        $centralidad34->geoPoint()->save($punto34);

        //------------------------------------

        //Se agrega la Centralidad N°35

        $centralidad35 = new Centrality;
        $centralidad35->name = 'Escuela Nro. 1026 - Escuela Mutualista';
        $centralidad35->location = 'Dr. Avila 351';

        $centralidad35->save();

        $punto35 = new GeoPoint;
        $punto35->latitude = -42.764743;
        $punto35->longitude = -65.040146;
        $punto35->order = '-1';

        $centralidad35->geoPoint()->save($punto35);

        //------------------------------------

        //Se agrega la Centralidad N°36

        $centralidad36 = new Centrality;
        $centralidad36->name = 'Escuela Nro. 1430';
        $centralidad36->location = 'Dorrego 275';

        $centralidad36->save();

        $punto36 = new GeoPoint;
        $punto36->latitude = -42.783632;
        $punto36->longitude = -65.026766;
        $punto36->order = '-1';

        $centralidad36->geoPoint()->save($punto36);

        //------------------------------------

        //Se agrega la Centralidad N°37

        $centralidad37 = new Centrality;
        $centralidad37->name = 'Escuela Nro. 1433';
        $centralidad37->location = 'San Martin 852';

        $centralidad37->save();

        $punto37 = new GeoPoint;
        $punto37->latitude =  -42.77435;
        $punto37->longitude = -65.034642;
        $punto37->order = '-1';

        $centralidad37->geoPoint()->save($punto37);

        //------------------------------------

        //Se agrega la Centralidad N°38

        $centralidad38 = new Centrality;
        $centralidad38->name = 'Escuela Nro. 7707';
        $centralidad38->location = 'Tecka 1562';

        $centralidad38->save();

        $punto38 = new GeoPoint;
        $punto38->latitude = -42.759936;
        $punto38->longitude = -65.061364;
        $punto38->order = '-1';

        $centralidad38->geoPoint()->save($punto38);

        //------------------------------------

        //Se agrega la Centralidad N°39

        $centralidad39 = new Centrality;
        $centralidad39->name = 'FAPE';
        $centralidad39->location = '9 de Julio';

        $centralidad39->save();

        $punto39 = new GeoPoint;
        $punto39->latitude = -42.770656;
        $punto39->longitude = -65.041005;
        $punto39->order = '-1';

        $centralidad39->geoPoint()->save($punto39);

        //------------------------------------

        //Se agrega la Centralidad N°40

        $centralidad40 = new Centrality;
        $centralidad40->name = 'Escuela Municipal de Pesca Juan Demonte';
        $centralidad40->location = 'Juan Muzzio N 10 Esq. Menendez';

        $centralidad40->save();

        $punto40 = new GeoPoint;
        $punto40->latitude =  -42.760642;
        $punto40->longitude = -65.044249;
        $punto40->order = '-1';

        $centralidad40->geoPoint()->save($punto40);

        //------------------------------------

        //Se agrega la Centralidad N°41

        $centralidad41 = new Centrality;
        $centralidad41->name = 'UNPSJB';
        $centralidad41->location = 'Bv. Almirante Brown 3051';

        $centralidad41->save();

        $punto41 = new GeoPoint;
        $punto41->latitude = -42.785667;
        $punto41->longitude = -65.005941;
        $punto41->order = '-1';

        $centralidad41->geoPoint()->save($punto41);

        //------------------------------------

        //Se agrega la Centralidad N°42

        $centralidad42 = new Centrality;
        $centralidad42->name = 'CENPAT';
        $centralidad42->location = 'Bv. Almte Brown 2915';

        $centralidad42->save();

        $punto42 = new GeoPoint;
        $punto42->latitude = -42.784779;
        $punto42->longitude = -65.008926;
        $punto42->order = '-1';

        $centralidad42->geoPoint()->save($punto42);

        //------------------------------------

        //Se agrega la Centralidad N°43

        $centralidad43 = new Centrality;
        $centralidad43->name = 'Instituto Patagonico de Ciencias Sociales';
        $centralidad43->location = 'Marcos A. Zar 345';

        $centralidad43->save();

        $punto43 = new GeoPoint;
        $punto43->latitude = -42.76851;
        $punto43->longitude = -65.036751;
        $punto43->order = '-1';

        $centralidad43->geoPoint()->save($punto43);

        //------------------------------------

        //Se agrega la Centralidad N°44

        $centralidad44 = new Centrality;
        $centralidad44->name = 'UTN';
        $centralidad44->location = 'Av. del Trabajo 1536';

        $centralidad44->save();

        $punto44 = new GeoPoint;
        $punto44->latitude = -42.768933176994324;
        $punto44->longitude = -65.05462735891342;
        $punto44->order = '-1';

        $centralidad44->geoPoint()->save($punto44);

        //------------------------------------

        //Se agrega la Centralidad N°45

        $centralidad45 = new Centrality;
        $centralidad45->name = 'Universidad de Comahue';
        $centralidad45->location = 'Av Julio Argentino Roca 743';

        $centralidad45->save();

        $punto45 = new GeoPoint;
        $punto45->latitude = -42.771245;
        $punto45->longitude = -65.03009;
        $punto45->order = '-1';

        $centralidad45->geoPoint()->save($punto45);

        //------------------------------------

        //Se agrega la Centralidad N°46

        $centralidad46 = new Centrality;
        $centralidad46->name = 'Terminal de Omnibus';
        $centralidad46->location = 'Dr Avila 400';

        $centralidad46->save();

        $punto46 = new GeoPoint;
        $punto46->latitude = -42.765444;
        $punto46->longitude =  -65.040727;
        $punto46->order = '-1';

        $centralidad46->geoPoint()->save($punto46);

        //------------------------------------

        //Se agrega la Centralidad N°47

        $centralidad47 = new Centrality;
        $centralidad47->name = 'Hospital Isola';
        $centralidad47->location = 'Roberto Gómez 383';

        $centralidad47->save();

        $punto47 = new GeoPoint;
        $punto47->latitude = -42.759283;
        $punto47->longitude = -65.041662;
        $punto47->order = '-1';

        $centralidad47->geoPoint()->save($punto47);

        //------------------------------------

        //Se agrega la Centralidad N°48

        $centralidad48 = new Centrality;
        $centralidad48->name = 'Sanatorio de la Ciudad';
        $centralidad48->location = 'Laprida 42';

        $centralidad48->save();

        $punto48 = new GeoPoint;
        $punto48->latitude = -42.770023;
        $punto48->longitude = -65.04434;
        $punto48->order = '-1';

        $centralidad48->geoPoint()->save($punto48);

        //------------------------------------

        //Se agrega la Centralidad N°49

        $centralidad49 = new Centrality;
        $centralidad49->name = 'SEP';
        $centralidad49->location = 'Sarmiento 125';

        $centralidad49->save();

        $punto49 = new GeoPoint;
        $punto49->latitude = -42.769252;
        $punto49->longitude = -65.033409;
        $punto49->order = '-1';

        $centralidad49->geoPoint()->save($punto49);

        //------------------------------------

        //Se agrega la Centralidad N°50

        $centralidad50 = new Centrality;
        $centralidad50->name = 'Consultorio de la Mujer';
        $centralidad50->location = '28 de Julio 355';

        $centralidad50->save();

        $punto50 = new GeoPoint;
        $punto50->latitude = -42.767286;
        $punto50->longitude = -65.038279;
        $punto50->order = '-1';

        $centralidad50->geoPoint()->save($punto50);

        //------------------------------------


        //Se agrega la Centralidad N°51

        $centralidad51 = new Centrality;
        $centralidad51->name = ' Centro de Salud Barrio Fontana';
        $centralidad51->location = 'La Rioja 703';

        $centralidad51->save();

        $punto51 = new GeoPoint;
        $punto51->latitude = -42.778909;
        $punto51->longitude = -65.054188;
        $punto51->order = '-1';

        $centralidad51->geoPoint()->save($punto51);

        //------------------------------------

        //Se agrega la Centralidad N°52

        $centralidad52 = new Centrality;
        $centralidad52->name = 'Centro de Salud Dr. Ramon Carrillo';
        $centralidad52->location = 'Alcueznaga y Marcos A. Zar.';

        $centralidad52->save();

        $punto52 = new GeoPoint;
        $punto52->latitude = -42.785542;
        $punto52->longitude = -65.025984;
        $punto52->order = '-1';

        $centralidad52->geoPoint()->save($punto52);

        //------------------------------------

        //Se agrega la Centralidad N°53

        $centralidad53 = new Centrality;
        $centralidad53->name = 'Centro de Salud Dr. Rene Favaloro';
        $centralidad53->location = 'Chile 1725 Barrio Pujol II';

        $centralidad53->save();

        $punto53 = new GeoPoint;
        $punto53->latitude = -42.757506;
        $punto53->longitude = -65.060733;
        $punto53->order = '-1';

        $centralidad53->geoPoint()->save($punto53);

        //------------------------------------

        //Se agrega la Centralidad N°54

        $centralidad54 = new Centrality;
        $centralidad54->name = 'Servicio de Adolescencia Dr. Pozzi';
        $centralidad54->location = 'Juan Acosta 350';

        $centralidad54->save();

        $punto54 = new GeoPoint;
        $punto54->latitude = -42.758257;
        $punto54->longitude = -65.041084;
        $punto54->order = '-1';

        $centralidad54->geoPoint()->save($punto54);

        //------------------------------------

        //Se agrega la Centralidad N°55

        $centralidad55 = new Centrality;
        $centralidad55->name = 'Centro de Salud Madre Teresa de Calcuta';
        $centralidad55->location = 'Dorrego 1292 Barrio Gob. Galina';

        $centralidad55->save();

        $punto55 = new GeoPoint;
        $punto55->latitude = -42.788311;
        $punto55->longitude = -65.040347;
        $punto55->order = '-1';

        $centralidad55->geoPoint()->save($punto55);

        //------------------------------------

        //Se agrega la Centralidad N°56

        $centralidad56 = new Centrality;
        $centralidad56->name = 'Centro de Adicciones';
        $centralidad56->location = 'Dorrego 223';

        $centralidad56->save();

        $punto56 = new GeoPoint;
        $punto56->latitude = -42.783456;
        $punto56->longitude = -65.026064;
        $punto56->order = '-1';

        $centralidad56->geoPoint()->save($punto56);

        //------------------------------------

        //Se agrega la Centralidad N°57

        $centralidad57 = new Centrality;
        $centralidad57->name = 'Banco Frances';
        $centralidad57->location = 'Roque Saenz Peña 30';

        $centralidad57->save();

        $punto57 = new GeoPoint;
        $punto57->latitude = -42.76497960090637;
        $punto57->longitude = -65.0348299741745;
        $punto57->order = '-1';

        $centralidad57->geoPoint()->save($punto57);

        //------------------------------------

        //Se agrega la Centralidad N°58

        $centralidad58 = new Centrality;
        $centralidad58->name = 'Banco de la Nacion Argentina';
        $centralidad58->location = '9 de Julio 127';

        $centralidad58->save();

        $punto58 = new GeoPoint;
        $punto58->latitude = -42.768185;
        $punto58->longitude = -65.034118;
        $punto58->order = '-1';

        $centralidad58->geoPoint()->save($punto58);

        //------------------------------------

        //Se agrega la Centralidad N°59

        $centralidad59 = new Centrality;
        $centralidad59->name = 'Banco Galicia';
        $centralidad59->location = 'Bartolome Mitre 25';

        $centralidad59->save();

        $punto59 = new GeoPoint;
        $punto59->latitude = -42.76510834693909;
        $punto59->longitude = -65.03727614879608;
        $punto59->order = '-1';

        $centralidad59->geoPoint()->save($punto59);

        //------------------------------------

        //Se agrega la Centralidad N°60

        $centralidad60 = new Centrality;
        $centralidad60->name = 'Banco Patagonia';
        $centralidad60->location = 'Mitre 102';

        $centralidad60->save();

        $punto60 = new GeoPoint;
        $punto60->latitude = -42.76573061943054;
        $punto60->longitude = -65.03663241863251;
        $punto60->order = '-1';

        $centralidad60->geoPoint()->save($punto60);

        //------------------------------------

        //Se agrega la Centralidad N°61

        $centralidad61 = new Centrality;
        $centralidad61->name = 'Banco Macro';
        $centralidad61->location = 'Roque Saenz Peña 280';

        $centralidad61->save();

        $punto61 = new GeoPoint;
        $punto61->latitude = -42.766154408454895;
        $punto61->longitude = -65.03785818815231;
        $punto61->order = '-1';

        $centralidad61->geoPoint()->save($punto61);

        //------------------------------------

        //Se agrega la Centralidad N°62

        $centralidad62 = new Centrality;
        $centralidad62->name = 'Banco del Chubut';
        $centralidad62->location = '25 de Mayo 154';

        $centralidad62->save();

        $punto62 = new GeoPoint;
        $punto62->latitude = -42.76556432247162;
        $punto62->longitude = -65.03500431776047;
        $punto62->order = '-1';

        $centralidad62->geoPoint()->save($punto62);

        //------------------------------------

        //Se agrega la Centralidad N°63

        $centralidad63 = new Centrality;
        $centralidad63->name = 'Banco Santender';
        $centralidad63->location = '28 de Julio 56';

        $centralidad63->save();

        $punto63 = new GeoPoint;
        $punto63->latitude = -42.76606857776642;
        $punto63->longitude = -65.03422111272812;
        $punto63->order = '-1';

        $centralidad63->geoPoint()->save($punto63);

        //------------------------------------

        //Se agrega la Centralidad N°64

        $centralidad64 = new Centrality;
        $centralidad64->name = 'Banco Credicoop';
        $centralidad64->location = 'Roque Saenz Peña y 25 de Mayo';

        $centralidad64->save();

        $punto64 = new GeoPoint;
        $punto64->latitude = -42.765036;
        $punto64->longitude = -65.03555;
        $punto64->order = '-1';

        $centralidad64->geoPoint()->save($punto64);

        //------------------------------------

        //Se agrega la Centralidad N°65

        $centralidad65 = new Centrality;
        $centralidad65->name = 'Farmacia ADOS';
        $centralidad65->location = 'Mitre 476';

        $centralidad65->save();

        $punto65 = new GeoPoint;
        $punto65->latitude = 42.769188;
        $punto65->longitude = -65.034642;
        $punto65->order = '-1';

        $centralidad65->geoPoint()->save($punto65);

        //------------------------------------

        //Se agrega la Centralidad N°66

        $centralidad66 = new Centrality;
        $centralidad66->name = 'Farmacia Ampal';
        $centralidad66->location = 'Domeg Garcia y Uruguay';

        $centralidad66->save();

        $punto66 = new GeoPoint;
        $punto66->latitude = -42.756071;
        $punto66->longitude = -65.038705;
        $punto66->order = '-1';

        $centralidad66->geoPoint()->save($punto66);

        //------------------------------------

        //Se agrega la Centralidad N°67

        $centralidad67 = new Centrality;
        $centralidad67->name = 'Farmacia Atlantica';
        $centralidad67->location = 'Juan B. Justo y Gales';

        $centralidad67->save();

        $punto67 = new GeoPoint;
        $punto67->latitude = -42.772801;
        $punto67->longitude = -42.772801;
        $punto67->order = '-1';

        $centralidad67->geoPoint()->save($punto67);

        //------------------------------------

        //Se agrega la Centralidad N°68

        $centralidad68 = new Centrality;
        $centralidad68->name = 'Farmacia Central';
        $centralidad68->location = '25 de Mayo 272';

        $centralidad68->save();

        $punto68 = new GeoPoint;
        $punto68->latitude = -42.766798;
        $punto68->longitude = -65.034526;
        $punto68->order = '-1';

        $centralidad68->geoPoint()->save($punto68);

        //------------------------------------

        //Se agrega la Centralidad N°69

        $centralidad69 = new Centrality;
        $centralidad69->name = 'Farmacia de la Costa';
        $centralidad69->location = 'Av. Roca 568';

        $centralidad69->save();

        $punto69 = new GeoPoint;
        $punto69->latitude = -42.769232;
        $punto69->longitude = -65.031214;
        $punto69->order = '-1';

        $centralidad69->geoPoint()->save($punto69);

        //------------------------------------

        //Se agrega la Centralidad N°70

        $centralidad70 = new Centrality;
        $centralidad70->name = 'Farmacia DASU';
        $centralidad70->location = 'Marcos A. Zar y Belgrano';

        $centralidad70->save();

        $punto70 = new GeoPoint;
        $punto70->latitude = -42.767987;
        $punto70->longitude = -65.037071;
        $punto70->order = '-1';

        $centralidad70->geoPoint()->save($punto70);

        //------------------------------------

        //Se agrega la Centralidad N°71

        $centralidad71 = new Centrality;
        $centralidad71->name = 'Farmacia Gales';
        $centralidad71->location = 'Roca 2438';

        $centralidad71->save();

        $punto71 = new GeoPoint;
        $punto71->latitude = -42.78545;
        $punto71->longitude = -65.021096;
        $punto71->order = '-1';

        $centralidad71->geoPoint()->save($punto71);

        //------------------------------------

        //Se agrega la Centralidad N°72

        $centralidad72 = new Centrality;
        $centralidad72->name = 'Farmacia Gacio';
        $centralidad72->location = 'Juan B. Justo 2018';

        $centralidad72->save();

        $punto72 = new GeoPoint;
        $punto72->latitude = -42.78505;
        $punto72->longitude = -65.032735;
        $punto72->order = '-1';

        $centralidad72->geoPoint()->save($punto72);

        //------------------------------------

        //Se agrega la Centralidad N°73

        $centralidad73 = new Centrality;
        $centralidad73->name = 'Farmacia Lahuen Hue';
        $centralidad73->location = 'Roque S. Peña 386';

        $centralidad73->save();

        $punto73 = new GeoPoint;
        $punto73->latitude = -42.7664;
        $punto73->longitude = -65.039312;
        $punto73->order = '-1';

        $centralidad73->geoPoint()->save($punto73);

        //------------------------------------

        //Se agrega la Centralidad N°74

        $centralidad74 = new Centrality;
        $centralidad74->name = 'Farmacia Moderna';
        $centralidad74->location = 'B. Mitre 502';

        $centralidad74->save();

        $punto74 = new GeoPoint;
        $punto74->latitude =-42.766764;
        $punto74->longitude = -65.032933;
        $punto74->order = '-1';

        $centralidad74->geoPoint()->save($punto74);

        //------------------------------------

        //Se agrega la Centralidad N°75

        $centralidad75 = new Centrality;
        $centralidad75->name = 'Municipalidad de Puerto Madryn';
        $centralidad75->location = 'Belgrano 206';

        $centralidad75->save();

        $punto75 = new GeoPoint;
        $punto75->latitude = -42.767802;
        $punto75->longitude = -65.035842;
        $punto75->order = '-1';

        $centralidad75->geoPoint()->save($punto75);

        //------------------------------------

        //Se agrega la Centralidad N°76

        $centralidad76 = new Centrality;
        $centralidad76->name = 'Muni Cerca 1';
        $centralidad76->location = 'Juan Muzzio 1106 y W. Jones';

        $centralidad76->save();

        $punto76 = new GeoPoint;
        $punto76->latitude = -42.770004;
        $punto76->longitude = -65.048827;
        $punto76->order = '-1';

        $centralidad76->geoPoint()->save($punto76);

        //------------------------------------

        //Se agrega la Centralidad N°77

        $centralidad77 = new Centrality;
        $centralidad77->name = 'Muni Cerca 2';
        $centralidad77->location = 'España 1986';

        $centralidad77->save();

        $punto77 = new GeoPoint;
        $punto77->latitude = -42.779831;
        $punto77->longitude = -65.057018;
        $punto77->order = '-1';

        $centralidad77->geoPoint()->save($punto77);

        //------------------------------------

        //Se agrega la Centralidad N°78

        $centralidad78 = new Centrality;
        $centralidad78->name = 'Muni Cerca 3';
        $centralidad78->location = 'Lavalle y Juan B. Justo';

        $centralidad78->save();

        $punto78 = new GeoPoint;
        $punto78->latitude = -42.783953;
        $punto78->longitude = -65.033382;
        $punto78->order = '-1';

        $centralidad78->geoPoint()->save($punto78);

        //------------------------------------

        //Se agrega la Centralidad N°79

        $centralidad79 = new Centrality;
        $centralidad79->name = 'Escuela Municipal N 1 Victor Moron';
        $centralidad79->location = 'Anita Jones 44 B. 21 de Enero';

        $centralidad79->save();

        $punto79 = new GeoPoint;
        $punto79->latitude = -42.756251;
        $punto79->longitude = -65.058715;
        $punto79->order = '-1';

        $centralidad79->geoPoint()->save($punto79);

        //------------------------------------

        //Se agrega la Centralidad N°80

        $centralidad80 = new Centrality;
        $centralidad80->name = 'Escuela Municipal N 3 C. B. De Padilla Esc. Verde';
        $centralidad80->location = 'Albarracin Norte 2982 - B San Miguel';

        $centralidad80->save();

        $punto80 = new GeoPoint;
        $punto80->latitude = -42.785315;
        $punto80->longitude = -65.066941;
        $punto80->order = '-1';

        $centralidad80->geoPoint()->save($punto80);

        //------------------------------------

        //Se agrega la Centralidad N°81

        $centralidad81 = new Centrality;
        $centralidad81->name = 'CDI N 1 Piedra Libre';
        $centralidad81->location = 'Juan Muzzio y Necochea. B Perito Moreno';

        $centralidad81->save();

        $punto81 = new GeoPoint;
        $punto81->latitude = -42.76175;
        $punto81->longitude =  -65.044995;
        $punto81->order = '-1';

        $centralidad81->geoPoint()->save($punto81);

        //------------------------------------

        //Se agrega la Centralidad N°82

        $centralidad82 = new Centrality;
        $centralidad82->name = 'CDI N 2 Paraiso de Colores';
        $centralidad82->location = 'Anita Jones 20 - B. 21 de Enero';

        $centralidad82->save();

        $punto82 = new GeoPoint;
        $punto82->latitude = -42.756476;
        $punto82->longitude = -65.058729;
        $punto82->order = '-1';

        $centralidad82->geoPoint()->save($punto82);

        //------------------------------------

        //Se agrega la Centralidad N°83

        $centralidad83 = new Centrality;
        $centralidad83->name = 'CDI N 3 Abracadabra';
        $centralidad83->location = 'Gualjaina s/n e/Tecka y El: Maiten B. Pujol';

        $centralidad83->save();

        $punto83 = new GeoPoint;
        $punto83->latitude = -42.759644;
        $punto83->longitude = -65.060376;
        $punto83->order = '-1';

        $centralidad83->geoPoint()->save($punto83);

        //------------------------------------

        //Se agrega la Centralidad N°84

        $centralidad84 = new Centrality;
        $centralidad84->name = 'CDI N 4 Pichi Nekum';
        $centralidad84->location = 'Albarracin Sur 2985 B. San Miguel';

        $centralidad84->save();

        $punto84 = new GeoPoint;
        $punto84->latitude = -42.785323;
        $punto84->longitude = -65.066951;
        $punto84->order = '-1';

        $centralidad84->geoPoint()->save($punto84);

        //------------------------------------

        //Se agrega la Centralidad N°85

        $centralidad85 = new Centrality;
        $centralidad85->name = 'CDI N 8 Acuarela';
        $centralidad85->location = 'La Rioja 725';

        $centralidad85->save();

        $punto85 = new GeoPoint;
        $punto85->latitude = -42.779007;
        $punto85->longitude = -65.054161;
        $punto85->order = '-1';

        $centralidad85->geoPoint()->save($punto85);

        //------------------------------------

        //Se agrega la Centralidad N°86

        $centralidad86 = new Centrality;
        $centralidad86->name = 'Club Municipal de Ciencias';
        $centralidad86->location = 'Juan Muzzio y Necochea';

        $centralidad86->save();

        $punto86 = new GeoPoint;
        $punto86->latitude = -42.761937;
        $punto86->longitude = -65.045162;
        $punto86->order = '-1';

        $centralidad86->geoPoint()->save($punto86);

        //------------------------------------

        //Se agrega la Centralidad N°87

        $centralidad87 = new Centrality;
        $centralidad87->name = 'Subsecretaria de Desarrollo Comunitario';
        $centralidad87->location = 'Bouchard y 9 de Julio';

        $centralidad87->save();

        $punto87 = new GeoPoint;
        $punto87->latitude = -42.773154;
        $punto87->longitude = -65.048568;
        $punto87->order = '-1';

        $centralidad87->geoPoint()->save($punto87);

        //------------------------------------

        //Se agrega la Centralidad N°88

        $centralidad88 = new Centrality;
        $centralidad88->name = 'Gimnasio Municipal I';
        $centralidad88->location = 'Sarmiento 1235';

        $centralidad88->save();

        $punto88 = new GeoPoint;
        $punto88->latitude = -42.774204;
        $punto88->longitude = -65.048274;
        $punto88->order = '-1';

        $centralidad88->geoPoint()->save($punto88);

        //------------------------------------

        //Se agrega la Centralidad N°89

        $centralidad89 = new Centrality;
        $centralidad89->name = 'Gimansio Municipal II';
        $centralidad89->location = 'Berwyn y Pasaje Evita';

        $centralidad89->save();

        $punto89 = new GeoPoint;
        $punto89->latitude = -42.760866;
        $punto89->longitude = -65.045612;
        $punto89->order = '-1';

        $centralidad89->geoPoint()->save($punto89);

        //------------------------------------

        //Se agrega la Centralidad N°90

        $centralidad90 = new Centrality;
        $centralidad90->name = 'Biblioteca Popular Agustin Pujol';
        $centralidad90->location = 'Anita Jones 44';

        $centralidad90->save();

        $punto90 = new GeoPoint;
        $punto90->latitude = -42.756221;
        $punto90->longitude = -65.058597;
        $punto90->order = '-1';

        $centralidad90->geoPoint()->save($punto90);

        //------------------------------------

        //Se agrega la Centralidad N°91

        $centralidad91 = new Centrality;
        $centralidad91->name = 'Carrefour';
        $centralidad91->location = 'Av. Gales 1315';

        $centralidad91->save();

        $punto91 = new GeoPoint;
        $punto91->latitude = -42.775578;
        $punto91->longitude = -65.04869;
        $punto91->order = '-1';

        $centralidad91->geoPoint()->save($punto91);

        //------------------------------------

        //Se agrega la Centralidad N°92

        $centralidad92 = new Centrality;
        $centralidad92->name = 'Supermercados Vea';
        $centralidad92->location = 'Manuel Belgrano 370';

        $centralidad92->save();

        $punto92 = new GeoPoint;
        $punto92->latitude = -42.7683;
        $punto92->longitude = -65.037942;
        $punto92->order = '-1';

        $centralidad92->geoPoint()->save($punto92);

        //------------------------------------

        //Se agrega la Centralidad N°93

        $centralidad93 = new Centrality;
        $centralidad93->name = 'Hiper Tehuelche';
        $centralidad93->location = '9 de Julio 1941';

        $centralidad93->save();

        $punto93 = new GeoPoint;
        $punto93->latitude = -42.774177;
        $punto93->longitude =  -65.051584;
        $punto93->order = '-1';

        $centralidad93->geoPoint()->save($punto93);

        //------------------------------------

        //Se agrega la Centralidad N°94

        $centralidad94 = new Centrality;
        $centralidad94->name = 'La Anonima';
        $centralidad94->location = 'Italia 500';

        $centralidad94->save();

        $punto94 = new GeoPoint;
        $punto94->latitude = -42.76738;
        $punto94->longitude = -65.042814;
        $punto94->order = '-1';

        $centralidad94->geoPoint()->save($punto94);

        //------------------------------------

        //Se agrega la Centralidad N°95

        $centralidad95 = new Centrality;
        $centralidad95->name = 'Chango Mas';
        $centralidad95->location = 'Juan B. Justo 1885';

        $centralidad95->save();

        $punto95 = new GeoPoint;
        $punto95->latitude = -42.784578;
        $punto95->longitude = -65.033073;
        $punto95->order = '-1';

        $centralidad95->geoPoint()->save($punto95);

        //------------------------------------

        //Se agrega la Centralidad N°96

        $centralidad96 = new Centrality;
        $centralidad96->name = 'Supermercado Clemente';
        $centralidad96->location = 'Marcelo T. de Alvear 2561';

        $centralidad96->save();

        $punto96 = new GeoPoint;
        $punto96->latitude = -42.789752;
        $punto96->longitude = -65.028259;
        $punto96->order = '-1';

        $centralidad96->geoPoint()->save($punto96);

        //------------------------------------

        //Se agrega la Centralidad N°97

        $centralidad97 = new Centrality;
        $centralidad97->name = 'Cine Teatro Auditorium';
        $centralidad97->location = '28 de Julio 129';

        $centralidad97->save();

        $punto97 = new GeoPoint;
        $punto97->latitude = -42.766152;
        $punto97->longitude = -65.035412;
        $punto97->order = '-1';

        $centralidad97->geoPoint()->save($punto97);

        //------------------------------------

        //Se agrega la Centralidad N°98

        $centralidad98 = new Centrality;
        $centralidad98->name = 'El portal de Madryn';
        $centralidad98->location = 'Av. Julio Argentino Roca 230';

        $centralidad98->save();

        $punto98 = new GeoPoint;
        $punto98->latitude = -42.76575;
        $punto98->longitude = -65.03365;
        $punto98->order = '-1';

        $centralidad98->geoPoint()->save($punto98);

        //------------------------------------

        //Se agrega la Centralidad N°99

        $centralidad99 = new Centrality;
        $centralidad99->name = 'Comisaria 1';
        $centralidad99->location = 'Bartolome Mitre 346';

        $centralidad99->save();

        $punto99 = new GeoPoint;
        $punto99->latitude = -42.768017;
        $punto99->longitude = -65.035393;
        $punto99->order = '-1';

        $centralidad99->geoPoint()->save($punto99);

        //------------------------------------

        //Se agrega la Centralidad N°100

        $centralidad100 = new Centrality;
        $centralidad100->name = 'Comisaria 3';
        $centralidad100->location = 'Juan B. Justo 1699';

        $centralidad100->save();

        $punto100 = new GeoPoint;
        $punto100->latitude = -42.783863;
        $punto100->longitude = -65.033555;
        $punto100->order = '-1';

        $centralidad100->geoPoint()->save($punto100);

        //------------------------------------

        //Se agrega la Centralidad N°101

        $centralidad101 = new Centrality;
        $centralidad101->name = 'Comisaria de la Mujer';
        $centralidad101->location = '9 de Julio 441';

        $centralidad101->save();

        $punto101 = new GeoPoint;
        $punto101->latitude = -42.769608;
        $punto101->longitude = -65.038283;
        $punto101->order = '-1';

        $centralidad101->geoPoint()->save($punto101);

        //------------------------------------

        //Se agrega la Centralidad N°102

        $centralidad102 = new Centrality;
        $centralidad102->name = 'Casa de la Mujer';
        $centralidad102->location = 'Bartolome Mitre 376';

        $centralidad102->save();

        $punto102 = new GeoPoint;
        $punto102->latitude = -42.768299;
        $punto102->longitude = -65.035202;
        $punto102->order = '-1';

        $centralidad102->geoPoint()->save($punto102);

        //------------------------------------

        //Se agrega la Centralidad N°103

        $centralidad103 = new Centrality;
        $centralidad103->name = 'Biblioteca Popular El Porvenir';
        $centralidad103->location = 'Pje Williams 325';

        $centralidad103->save();

        $punto103 = new GeoPoint;
        $punto103->latitude = -42.760277;
        $punto103->longitude = -65.04857;
        $punto103->order = '-1';

        $centralidad103->geoPoint()->save($punto103);

        //------------------------------------

        //Se agrega la Centralidad N°104

        $centralidad104 = new Centrality;
        $centralidad104->name = 'Casa de la Cultura';
        $centralidad104->location = 'Roque Saenz Peña 86';

        $centralidad104->save();

        $punto104 = new GeoPoint;
        $punto104->latitude = -42.765086;
        $punto104->longitude = -65.035597;
        $punto104->order = '-1';

        $centralidad104->geoPoint()->save($punto104);

        //------------------------------------

        //Se agrega la Centralidad N°105

        $centralidad105 = new Centrality;
        $centralidad105->name = 'Centro Comunitario Quemu-CGB III';
        $centralidad105->location = 'Tucuman 311';

        $centralidad105->save();

        $punto105 = new GeoPoint;
        $punto105->latitude = -42.758302;
        $punto105->longitude = -65.043151;
        $punto105->order = '-1';

        $centralidad105->geoPoint()->save($punto105);

        //------------------------------------

        //Se agrega la Centralidad N°106

        $centralidad106 = new Centrality;
        $centralidad106->name = 'Centro Cultural San Miguel';
        $centralidad106->location = 'Garagarza 778';

        $centralidad106->save();

        $punto106 = new GeoPoint;
        $punto106->latitude = -42.785038;
        $punto106->longitude = -65.069529;
        $punto106->order = '-1';

        $centralidad106->geoPoint()->save($punto106);

        //------------------------------------

        //Se agrega la Centralidad N°107

        $centralidad107 = new Centrality;
        $centralidad107->name = 'Centro de Dia Hospital Isola';
        $centralidad107->location = 'Dorrego 233,';

        $centralidad107->save();

        $punto107 = new GeoPoint;
        $punto107->latitude = -42.783493;
        $punto107->longitude = -65.026174;
        $punto107->order = '-1';

        $centralidad107->geoPoint()->save($punto107);

        //------------------------------------

        //Se agrega la Centralidad N°108

        $centralidad108 = new Centrality;
        $centralidad108->name = 'Centro de Dia Salud Mental';
        $centralidad108->location = '9 de Julio 544';

        $centralidad108->save();

        $punto108 = new GeoPoint;
        $punto108->latitude = -42.770072;
        $punto108->longitude = -65.039698;
        $punto108->order = '-1';

        $centralidad108->geoPoint()->save($punto108);

        //------------------------------------

        //Se agrega la Centralidad N°109

        $centralidad109 = new Centrality;
        $centralidad109->name = 'Centro de Gestion Barrial N I';
        $centralidad109->location = 'Albarracin y Tomas Mate';

        $centralidad109->save();

        $punto109 = new GeoPoint;
        $punto109->latitude = -42.78258;
        $punto109->longitude = -65.061032;
        $punto109->order = '-1';

        $centralidad109->geoPoint()->save($punto109);

        //------------------------------------

        //Se agrega la Centralidad N°110

        $centralidad110 = new Centrality;
        $centralidad110->name = 'Centro de Gestion Barrial N II';
        $centralidad110->location = 'Rio Mayo y El Maiten';

        $centralidad110->save();

        $punto110 = new GeoPoint;
        $punto110->latitude = -42.757984;
        $punto110->longitude = -65.063081;
        $punto110->order = '-1';

        $centralidad110->geoPoint()->save($punto110);

        //------------------------------------

        //Se agrega la Centralidad N°111

        $centralidad111 = new Centrality;
        $centralidad111->name = 'Centro de Gestion Barrial N 4 Sede Junta Vecinal B. Peron';
        $centralidad111->location = 'Albarracin 3445';

        $centralidad111->save();

        $punto111 = new GeoPoint;
        $punto111->latitude = -42.785572;
        $punto111->longitude = -65.068821;
        $punto111->order = '-1';

        $centralidad111->geoPoint()->save($punto111);

        //------------------------------------

        //Se agrega la Centralidad N°112

        $centralidad112 = new Centrality;
        $centralidad112->name = 'Centro de Jubilados';
        $centralidad112->location = '1 de Marzo 483';

        $centralidad112->save();

        $punto112 = new GeoPoint;
        $punto112->latitude = -42.76656;
        $punto112->longitude =-65.041053;
        $punto112->order = '-1';

        $centralidad112->geoPoint()->save($punto112);

        //------------------------------------

        //Se agrega la Centralidad N°113

        $centralidad113 = new Centrality;
        $centralidad113->name = 'Ex Casa del Gerente del Ferrocarril';
        $centralidad113->location = 'Domecq Garcia 98';

        $centralidad113->save();

        $punto113 = new GeoPoint;
        $punto113->latitude = -42.769945;
        $punto113->longitude = -65.046326;
        $punto113->order = '-1';

        $centralidad113->geoPoint()->save($punto113);

        //------------------------------------

        //Se agrega la Centralidad N°114

        $centralidad114 = new Centrality;
        $centralidad114->name = 'Feria de Servicio Pujol II';
        $centralidad114->location = 'Rio Pico y Chile';

        $centralidad114->save();

        $punto114 = new GeoPoint;
        $punto114->latitude = -42.757552;
        $punto114->longitude =-65.060705;
        $punto114->order = '-1';

        $centralidad114->geoPoint()->save($punto114);

        //------------------------------------

        //Se agrega la Centralidad N°115

        $centralidad115 = new Centrality;
        $centralidad115->name = 'Hogar Nuestros Abuelos';
        $centralidad115->location = 'Albarracin Norte 3098';

        $centralidad115->save();

        $punto115 = new GeoPoint;
        $punto115->latitude = -42.785805;
        $punto115->longitude = -65.068286;
        $punto115->order = '-1';

        $centralidad115->geoPoint()->save($punto115);

        //------------------------------------

        //Se agrega la Centralidad N°116

        $centralidad116 = new Centrality;
        $centralidad116->name = 'Hogar de Ancianos Nuestras Raices';
        $centralidad116->location = 'Rio Pico 1914 B. Pujol II';

        $centralidad116->save();

        $punto116 = new GeoPoint;
        $punto116->latitude = -42.757124;
        $punto116->longitude = -65.061811;
        $punto116->order = '-1';

        $centralidad116->geoPoint()->save($punto116);

        //------------------------------------

        //Se agrega la Centralidad N°117

        $centralidad117 = new Centrality;
        $centralidad117->name = 'Junta Vecinal Desembarco';
        $centralidad117->location = 'Roca y Libertad';

        $centralidad117->save();

        $punto117 = new GeoPoint;
        $punto117->latitude = -42.78738;
        $punto117->longitude = -65.019868;
        $punto117->order = '-1';

        $centralidad117->geoPoint()->save($punto117);

        //------------------------------------

        //Se agrega la Centralidad N°118

        $centralidad118 = new Centrality;
        $centralidad118->name = 'Junta Vecinal El Porvenir';
        $centralidad118->location = 'Roberto Gomez y Juan XXIII';

        $centralidad118->save();

        $punto118 = new GeoPoint;
        $punto118->latitude = -42.757583;
        $punto118->longitude = -65.047681;
        $punto118->order = '-1';

        $centralidad118->geoPoint()->save($punto118);

        //------------------------------------

        //Se agrega la Centralidad N°119

        $centralidad119 = new Centrality;
        $centralidad119->name = 'Junta Vecinal Fontana';
        $centralidad119->location = 'Buenos Aires entre España y Gales';

        $centralidad119->save();

        $punto119 = new GeoPoint;
        $punto119->latitude = -42.778528;
        $punto119->longitude = -65.055391;
        $punto119->order = '-1';

        $centralidad119->geoPoint()->save($punto119);

        //------------------------------------

        //Se agrega la Centralidad N°120

        $centralidad120 = new Centrality;
        $centralidad120->name = 'Junta Vecinal Galina';
        $centralidad120->location = 'Dorrego 1288';

        $centralidad120->save();

        $punto120 = new GeoPoint;
        $punto120->latitude = -42.788311;
        $punto120->longitude = -65.040303;
        $punto120->order = '-1';

        $centralidad120->geoPoint()->save($punto120);

        //------------------------------------

        //Se agrega la Centralidad N°121

        $centralidad121 = new Centrality;
        $centralidad121->name = 'Junta Vecinal Guemes';
        $centralidad121->location = 'Ferrocarril Patagonico y Pasaje Becker';

        $centralidad121->save();

        $punto121 = new GeoPoint;
        $punto121->latitude = -42.772205;
        $punto121->longitude = -65.052839;
        $punto121->order = '-1';

        $centralidad121->geoPoint()->save($punto121);

        //------------------------------------

        //Se agrega la Centralidad N°122

        $centralidad122 = new Centrality;
        $centralidad122->name = 'Junta Vecinal Piedra Buena';
        $centralidad122->location = 'Lewis Jones 528';

        $centralidad122->save();

        $punto122 = new GeoPoint;
        $punto122->latitude = -42.781608;
        $punto122->longitude = -65.032336;
        $punto122->order = '-1';

        $centralidad122->geoPoint()->save($punto122);

        //------------------------------------

        //Se agrega la Centralidad N°123

        $centralidad123 = new Centrality;
        $centralidad123->name = 'Junta Vecinal Roque Gonzales';
        $centralidad123->location = 'Albarracin y Alberdi';

        $centralidad123->save();

        $punto123 = new GeoPoint;
        $punto123->latitude = -42.783008;
        $punto123->longitude = -65.061548;
        $punto123->order = '-1';

        $centralidad123->geoPoint()->save($punto123);

        //------------------------------------

        //Se agrega la Centralidad N°124

        $centralidad124 = new Centrality;
        $centralidad124->name = 'Junta Vecinal Ruca Hue';
        $centralidad124->location = 'Patricias Argentina y Fuerte San Jose';

        $centralidad124->save();

        $punto124 = new GeoPoint;
        $punto124->latitude = -42.766393;
        $punto124->longitude = -65.048398;
        $punto124->order = '-1';

        $centralidad124->geoPoint()->save($punto124);

        //------------------------------------

        //Se agrega la Centralidad N°125

        $centralidad125 = new Centrality;
        $centralidad125->name = 'Talleres Spencer';
        $centralidad125->location = 'San Martin 652';

        $centralidad125->save();

        $punto125 = new GeoPoint;
        $punto125->latitude = -42.772044;
        $punto125->longitude = -65.036075;
        $punto125->order = '-1';

        $centralidad125->geoPoint()->save($punto125);

        //------------------------------------

        //Se agrega la Centralidad N°126

        $centralidad126 = new Centrality;
        $centralidad126->name = 'Teatro Del Muelle';
        $centralidad126->location = 'Av. Rawson 60';

        $centralidad126->save();

        $punto126 = new GeoPoint;
        $punto126->latitude = -42.762753;
        $punto126->longitude = -65.035256;
        $punto126->order = '-1';

        $centralidad126->geoPoint()->save($punto126);

        //------------------------------------

        //Se agrega la Centralidad N°127

        $centralidad127 = new Centrality;
        $centralidad127->name = 'Teatro de La Rosada';
        $centralidad127->location = 'Paulina Escardo 187';

        $centralidad127->save();

        $punto127 = new GeoPoint;
        $punto127->latitude = -42.761269;
        $punto127->longitude = -65.038146;
        $punto127->order = '-1';

        $centralidad127->geoPoint()->save($punto127);

        //------------------------------------

        //Se agrega la Centralidad N°128

        $centralidad128 = new Centrality;
        $centralidad128->name = 'Museo de arte';
        $centralidad128->location = 'Av. Roca 444';

        $centralidad128->save();

        $punto128 = new GeoPoint;
        $punto128->latitude = -42.767957;
        $punto128->longitude = -65.032157;
        $punto128->order = '-1';

        $centralidad128->geoPoint()->save($punto128);

        //------------------------------------

        //Se agrega centralidad N°129

        $centralidad129 = new Centrality;
        $centralidad129->name = 'Museo Oceanografico';
        $centralidad129->location = 'Av. Domec García Norte 1';

        $centralidad129->save();

        $punto129 = new GeoPoint;
        $punto129->latitude = -42.76224;
        $punto129->longitude = -65.0400489;
        $punto129->order = '-1';

        $centralidad129->geoPoint()->save($punto129);

        //------------------------------------

        //Se agrega centralidad N°130

        $centralidad130 = new Centrality;
        $centralidad130->name = 'Clinica Santa Maria';
        $centralidad130->location = 'Bartolomé Mitre 643,';

        $centralidad130->save();

        $punto130 = new GeoPoint;
        $punto130->latitude = -42.7711356;
        $punto130->longitude = -65.0335442;
        $punto130->order = '-1';

        $centralidad130->geoPoint()->save($punto130);

        //------------------------------------

        //Se agrega centralidad N°131

        $centralidad131 = new Centrality;
        $centralidad131->name = 'Aeropuerto El Tehuelche';
        $centralidad131->location = 'Aeropuerto Puerto Madryn';

        $centralidad131->save();

        $punto131 = new GeoPoint;
        $punto131->latitude = -42.7691016;
        $punto131->longitude = -65.1062229;
        $punto131->order = '-1';

        $centralidad131->geoPoint()->save($punto131);

        //------------------------------------

        //Se agrega centralidad N°132

        $centralidad132 = new Centrality;
        $centralidad132->name = 'Pista de Atletismo';
        $centralidad132->location = 'Mariano Moreno ';

        $centralidad132->save();

        $punto132 = new GeoPoint;
        $punto132->latitude = -42.77671694755554;
        $punto132->longitude = -65.03405749797821;
        $punto132->order = '-1';

        $centralidad132->geoPoint()->save($punto132);

        //------------------------------------
    }
}
