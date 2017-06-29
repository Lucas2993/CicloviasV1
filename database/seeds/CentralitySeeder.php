<?php

use Illuminate\Database\Seeder;

use Phaza\LaravelPostgis\Geometries\Point;

use App\Models\Centrality;

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
        $centralidad1->type = 'Educacion';
        $centralidad1->location = '25 De Mayo 1090';
        $centralidad1->geom = new Point(-42.775144, -65.029309);

        $centralidad1->save();


        //------------------------------------

        //Se agrega la Centralidad N°2

        $centralidad2 = new Centrality;
        $centralidad2->name = 'Escuela Nro. 46';
        $centralidad2->type = 'Educacion';
        $centralidad2->location = 'Juan Muzzio 707';
        $centralidad2->geom = new Point(-42.764473, -65.046056);

        $centralidad2->save();


        //------------------------------------

        //Se agrega la Centralidad N°3

        $centralidad3 = new Centrality;
        $centralidad3->name = 'Escuela Nro. 84 - 607 - 7701';
        $centralidad3->type = 'Educacion';
        $centralidad3->location = 'Sarmiento 268';
        $centralidad3->geom = new Point(-42.769791, -65.035243);

        $centralidad3->save();


        //------------------------------------

        //Se agrega la Centralidad N°4

        $centralidad4 = new Centrality;
        $centralidad4->name = 'Escuela Nro. 110';
        $centralidad4->type = 'Educacion';
        $centralidad4->location = 'Av.Gales 1050';
        $centralidad4->geom = new Point(-42.774374, -65.045014);

        $centralidad4->save();


        //------------------------------------

        //Se agrega la Centralidad N°5

        $centralidad5 = new Centrality;
        $centralidad5->name = 'Escuela Nro. 124';
        $centralidad5->type = 'Educacion';
        $centralidad5->location = 'Av. Domec García Norte 299-399';
        $centralidad5->geom = new Point(-42.75926649570465, -65.03874868154526);

        $centralidad5->save();


        //------------------------------------

        //Se agrega la Centralidad N°6

        $centralidad6 = new Centrality;
        $centralidad6->name = 'Escuela Nro. 150';
        $centralidad6->type = 'Educacion';
        $centralidad6->location = 'Fuerte San Jose 115';
        $centralidad6->geom = new Point( -42.76753842830658, -65.04273980855942);

        $centralidad6->save();


        //------------------------------------

        //Se agrega la Centralidad N°7

        $centralidad7 = new Centrality;
        $centralidad7->name = 'Escuela Nro. 152';
        $centralidad7->type = 'Educacion';
        $centralidad7->location = 'La Pampa 579';
        $centralidad7->geom = new Point(-42.776885, -65.053322);

        $centralidad7->save();


        //------------------------------------

        //Se agrega la Centralidad N°8

        $centralidad8 = new Centrality;
        $centralidad8->name = 'Escuela Nro. 158';
        $centralidad8->type = 'Educacion';
        $centralidad8->location = 'Av. Julio A. Roca 1750';
        $centralidad8->geom = new Point(-42.780299, -65.024358);

        $centralidad8->save();


        //------------------------------------

        //Se agrega la Centralidad N°9

        $centralidad9 = new Centrality;
        $centralidad9->name = 'Escuela Nro. 168';
        $centralidad9->type = 'Educacion';
        $centralidad9->location = 'Santa Cruz 1155';
        $centralidad9->geom = new Point(-42.784195, -65.053651);

        $centralidad9->save();


        //------------------------------------

        //Se agrega la Centralidad N°10

        $centralidad10 = new Centrality;
        $centralidad10->name = 'Escuela Nro. 170';
        $centralidad10->type = 'Educacion';
        $centralidad10->location = 'Jose Menendez 445';
        $centralidad10->geom = new Point(-42.76108, -65.042743);

        $centralidad10->save();


        //------------------------------------

        //Se agrega la Centralidad N°11

        $centralidad11 = new Centrality;
        $centralidad11->name = 'Escuela Nro. 213';
        $centralidad11->type = 'Educacion';
        $centralidad11->location = 'Santiago Del Estero 1051';
        $centralidad11->geom = new Point(-42.784645, -65.059035);

        $centralidad11->save();


        //------------------------------------

        //Se agrega la Centralidad N°12

        $centralidad12 = new Centrality;
        $centralidad12->name = 'Escuela Nro. 222';
        $centralidad12->type = 'Educacion';
        $centralidad12->location = 'Albarracin y C. Marzullo';
        $centralidad12->geom = new Point(-42.78757452964783, -65.0732606649399);

        $centralidad12->save();


        //------------------------------------

        //Se agrega la Centralidad N°13

        $centralidad13 = new Centrality;
        $centralidad13->name = 'Escuela Nro. 305';
        $centralidad13->type = 'Educacion';
        $centralidad13->location = 'Roberto Gomez 383';
        $centralidad13->geom = new Point(-42.759297, -65.04168);

        $centralidad13->save();


        //------------------------------------

        //Se agrega la Centralidad N°14

        $centralidad14 = new Centrality;
        $centralidad14->name = 'Escuela Nro. 410';
        $centralidad14->type = 'Educacion';
        $centralidad14->location = 'Mitre 581';
        $centralidad14->geom = new Point( -42.770329, -65.033941);

        $centralidad14->save();


        //------------------------------------

        //Se agrega la Centralidad N°15

        $centralidad15 = new Centrality;
        $centralidad15->name = 'Escuela Nro. 434';
        $centralidad15->type = 'Educacion';
        $centralidad15->geom = new Point(-42.784781, -65.058936);
        $centralidad15->location = 'Santiago Del Estero 1051';
        $centralidad15->save();


        //------------------------------------

        //Se agrega la Centralidad N°16

        $centralidad16 = new Centrality;
        $centralidad16->name = 'Escuela Nro. 448';
        $centralidad16->type = 'Educacion';
        $centralidad16->location = 'Domecq Garcia 645';
        $centralidad16->geom = new Point(-42.767423, -65.044225);

        $centralidad16->save();


        //------------------------------------

        //Se agrega la Centralidad N°17

        $centralidad17 = new Centrality;
        $centralidad17->name = 'Escuela Nro. 449';
        $centralidad17->type = 'Educacion';
        $centralidad17->location = 'Necochea Y Juan XXIII';
        $centralidad17->geom = new Point(-42.759759, -65.049028);

        $centralidad17->save();


        //------------------------------------

        //Se agrega la Centralidad N°18

        $centralidad18 = new Centrality;
        $centralidad18->name = 'Escuela Nro. 457';
        $centralidad18->type = 'Educacion';
        $centralidad18->location = 'La Pampa Y Gales 579';
        $centralidad18->geom = new Point(-42.776736, -65.053457);

        $centralidad18->save();


        //------------------------------------

        //Se agrega la Centralidad N°19

        $centralidad19 = new Centrality;
        $centralidad19->name = 'Escuela Nro. 464';
        $centralidad19->type = 'Educacion';
        $centralidad19->location = 'Travelin 1285';
        $centralidad19->geom = new Point(-42.761816, -65.059728);

        $centralidad19->save();


        //------------------------------------

        //Se agrega la Centralidad N°20

        $centralidad20 = new Centrality;
        $centralidad20->name = 'Escuela Nro. 516';
        $centralidad20->type = 'Educacion';
        $centralidad20->location = 'Jose Podesta 168';
        $centralidad20->geom = new Point(-42.761522, -65.044193);

        $centralidad20->save();


        //------------------------------------

        //Se agrega la Centralidad N°21

        $centralidad21 = new Centrality;
        $centralidad21->name = 'Escuela Nro. 520';
        $centralidad21->type = 'Educacion';
        $centralidad21->location = 'Roberto Gomez 75';
        $centralidad21->geom = new Point(-42.759901, -65.038129);

        $centralidad21->save();


        //------------------------------------

        //Se agrega la Centralidad N°22

        $centralidad22 = new Centrality;
        $centralidad22->name = 'Escuela Nro. 524';
        $centralidad22->type = 'Educacion';
        $centralidad22->location = 'Espora 505';
        $centralidad22->geom = new Point(-42.764992, -65.044811);

        $centralidad22->save();


        //------------------------------------

        //Se agrega la Centralidad N°23

        $centralidad23 = new Centrality;
        $centralidad23->name = 'Escuela Nro. 556';
        $centralidad23->type = 'Educacion';
        $centralidad23->location = 'Albarracin 25';
        $centralidad23->geom = new Point( -42.772016, -65.030024);

        $centralidad23->save();


        //------------------------------------

        //Se agrega la Centralidad N°24

        $centralidad24 = new Centrality;
        $centralidad24->name = 'Escuela Nro. 651';
        $centralidad24->type = 'Educacion';
        $centralidad24->location = 'Rosales Nº 695';
        $centralidad24->geom = new Point( -42.7753221988678, -65.04394948482513);

        $centralidad24->save();


        //------------------------------------

        //Se agrega la Centralidad N°25

        $centralidad25 = new Centrality;
        $centralidad25->name = 'Escuela Nro. 617';
        $centralidad25->type = 'Educacion';
        $centralidad25->location = 'Fuerte San Jose 115';
        $centralidad25->geom = new Point(-42.76772618293762, -65.04238307476045);

        $centralidad25->save();


        //------------------------------------

        //Se agrega la Centralidad N°26

        $centralidad26 = new Centrality;
        $centralidad26->name = 'Escuela Nro. 703';
        $centralidad26->type = 'Educacion';
        $centralidad26->location = 'Villegas 451';
        $centralidad26->geom = new Point(-42.772214, -65.04402);

        $centralidad26->save();


        //------------------------------------

        //Se agrega la Centralidad N°27

        $centralidad27 = new Centrality;
        $centralidad27->name = 'Escuela Nro. 728';
        $centralidad27->type = 'Educacion';
        $centralidad27->location = 'Roberts 61';
        $centralidad27->geom = new Point(-42.77883, -65.02429);

        $centralidad27->save();


        //------------------------------------

        //Se agrega la Centralidad N°28

        $centralidad28 = new Centrality;
        $centralidad28->name = 'Escuela Nro. 741';
        $centralidad28->type = 'Educacion';
        $centralidad28->location = 'Moreno 142';
        $centralidad28->geom = new Point(-42.774426, -65.030419);

        $centralidad28->save();


        //------------------------------------

        //Se agrega la Centralidad N°29

        $centralidad29 = new Centrality;
        $centralidad29->name = 'Escuela Nro. 750';
        $centralidad29->type = 'Educacion';
        $centralidad29->location = 'Avda. Gales 892';
        $centralidad29->geom = new Point(-42.773617, -65.043012);

        $centralidad29->save();


        //------------------------------------

        //Se agrega la Centralidad N°30

        $centralidad30 = new Centrality;
        $centralidad30->name = 'Escuela Nro. 785';
        $centralidad30->type = 'Educacion';
        $centralidad30->location = 'Jauretche 1041';
        $centralidad30->geom = new Point(-42.751165, -65.047066);

        $centralidad30->save();


        //------------------------------------

        //Se agrega la Centralidad N°31

        $centralidad31 = new Centrality;
        $centralidad31->name = 'Escuela Nro. 786';
        $centralidad31->type = 'Educacion';
        $centralidad31->location = 'J. Menendez 445';
        $centralidad31->geom = new Point(-42.761163, -65.042732);

        $centralidad31->save();


        //------------------------------------

        //Se agrega la Centralidad N°32

        $centralidad32 = new Centrality;
        $centralidad32->name = 'Escuela Nro. 803';
        $centralidad32->type = 'Educacion';
        $centralidad32->location = '25 de Mayo 1068';
        $centralidad32->geom = new Point(-42.774909, -65.029442);

        $centralidad32->save();


        //------------------------------------

        //Se agrega la Centralidad N°33

        $centralidad33 = new Centrality;
        $centralidad33->name = 'Escuela Nro. 805';
        $centralidad33->type = 'Educacion';
        $centralidad33->location = 'Pujol 255';
        $centralidad33->geom = new Point(-42.759943, -65.040543);

        $centralidad33->save();


        //------------------------------------

        //Se agrega la Centralidad N°34

        $centralidad34 = new Centrality;
        $centralidad34->name = 'Escuela Nro. 1020';
        $centralidad34->type = 'Educacion';
        $centralidad34->location = 'Colon 352';
        $centralidad34->geom = new Point(-42.77217, -65.047334);

        $centralidad34->save();


        //------------------------------------

        //Se agrega la Centralidad N°35

        $centralidad35 = new Centrality;
        $centralidad35->name = 'Escuela Nro. 1026 - Escuela Mutualista';
        $centralidad35->type = 'Educacion';
        $centralidad35->location = 'Dr. Avila 351';
        $centralidad35->geom = new Point(-42.764743, -65.040146);

        $centralidad35->save();


        //------------------------------------

        //Se agrega la Centralidad N°36

        $centralidad36 = new Centrality;
        $centralidad36->name = 'Escuela Nro. 1430';
        $centralidad36->type = 'Educacion';
        $centralidad36->location = 'Dorrego 275';
        $centralidad36->geom = new Point(-42.783632, -65.026766);

        $centralidad36->save();


        //------------------------------------

        //Se agrega la Centralidad N°37

        $centralidad37 = new Centrality;
        $centralidad37->name = 'Escuela Nro. 1433';
        $centralidad37->type = 'Educacion';
        $centralidad37->location = 'San Martin 852';
        $centralidad37->geom = new Point( -42.77435, -65.034642);

        $centralidad37->save();


        //------------------------------------

        //Se agrega la Centralidad N°38

        $centralidad38 = new Centrality;
        $centralidad38->name = 'Escuela Nro. 7707';
        $centralidad38->type = 'Educacion';
        $centralidad38->location = 'Tecka 1562';
        $centralidad38->geom = new Point(-42.759936, -65.061364);

        $centralidad38->save();


        //------------------------------------

        //Se agrega la Centralidad N°39

        $centralidad39 = new Centrality;
        $centralidad39->name = 'FAPE';
        $centralidad39->type = 'Educacion';
        $centralidad39->location = '9 de Julio';
        $centralidad39->geom = new Point(-42.770656, -65.041005);

        $centralidad39->save();


        //------------------------------------

        //Se agrega la Centralidad N°40

        $centralidad40 = new Centrality;
        $centralidad40->name = 'Escuela Municipal de Pesca Juan Demonte';
        $centralidad40->type = 'Educacion';
        $centralidad40->location = 'Juan Muzzio N 10 Esq. Menendez';
        $centralidad40->geom = new Point( -42.760642, -65.044249);

        $centralidad40->save();


        //------------------------------------

        //Se agrega la Centralidad N°41

        $centralidad41 = new Centrality;
        $centralidad41->name = 'UNPSJB';
        $centralidad41->type = 'Educacion_Universitaria';
        $centralidad41->location = 'Bv. Almirante Brown 3051';
        $centralidad41->geom = new Point(-42.785667, -65.005941);

        $centralidad41->save();


        //------------------------------------

        //Se agrega la Centralidad N°42

        $centralidad42 = new Centrality;
        $centralidad42->name = 'CENPAT';
        $centralidad42->type = 'Educacion';
        $centralidad42->location = 'Bv. Almte Brown 2915';
        $centralidad42->geom = new Point(-42.784779, -65.008926);

        $centralidad42->save();


        //------------------------------------

        //Se agrega la Centralidad N°43

        $centralidad43 = new Centrality;
        $centralidad43->name = 'Instituto Patagonico de Ciencias Sociales';
        $centralidad43->type = 'Educacion';
        $centralidad43->location = 'Marcos A. Zar 345';
        $centralidad43->geom = new Point(-42.76851, -65.036751);

        $centralidad43->save();


        //------------------------------------

        //Se agrega la Centralidad N°44

        $centralidad44 = new Centrality;
        $centralidad44->name = 'UTN';
        $centralidad44->type = 'Educacion_Universitaria';
        $centralidad44->location = 'Av. del Trabajo 1536';
        $centralidad44->geom = new Point(-42.768933176994324, -65.05462735891342);

        $centralidad44->save();


        //------------------------------------

        //Se agrega la Centralidad N°45

        $centralidad45 = new Centrality;
        $centralidad45->name = 'Universidad de Comahue';
        $centralidad45->type = 'Educacion_Universitaria';
        $centralidad45->location = 'Av Julio Argentino Roca 743';
        $centralidad45->geom = new Point(-42.771245, -65.03009);

        $centralidad45->save();


        //------------------------------------

        //Se agrega la Centralidad N°46

        $centralidad46 = new Centrality;
        $centralidad46->name = 'Terminal de Omnibus';
        $centralidad46->type = 'Transporte';
        $centralidad46->location = 'Dr Avila 400';
        $centralidad46->geom = new Point(-42.765444,  -65.040727);

        $centralidad46->save();


        //------------------------------------

        //Se agrega la Centralidad N°47

        $centralidad47 = new Centrality;
        $centralidad47->name = 'Hospital Isola';
        $centralidad47->type = 'Salud';
        $centralidad47->location = 'Roberto Gómez 383';
        $centralidad47->geom = new Point(-42.759283, -65.041662);

        $centralidad47->save();


        //------------------------------------

        //Se agrega la Centralidad N°48

        $centralidad48 = new Centrality;
        $centralidad48->name = 'Sanatorio de la Ciudad';
        $centralidad48->type = 'Salud';
        $centralidad48->location = 'Laprida 42';
        $centralidad48->geom = new Point(-42.770023, -65.04434);

        $centralidad48->save();


        //------------------------------------

        //Se agrega la Centralidad N°49

        $centralidad49 = new Centrality;
        $centralidad49->name = 'SEP';
        $centralidad49->type = 'Salud';
        $centralidad49->location = 'Sarmiento 125';
        $centralidad49->geom = new Point(-42.769252, -65.033409);

        $centralidad49->save();


        //------------------------------------

        //Se agrega la Centralidad N°50

        $centralidad50 = new Centrality;
        $centralidad50->name = 'Consultorio de la Mujer';
        $centralidad50->type = 'Salud';
        $centralidad50->location = '28 de Julio 355';
        $centralidad50->geom = new Point(-42.767286, -65.038279);

        $centralidad50->save();


        //------------------------------------


        //Se agrega la Centralidad N°51

        $centralidad51 = new Centrality;
        $centralidad51->name = ' Centro de Salud Barrio Fontana';
        $centralidad51->type = 'Salud';
        $centralidad51->location = 'La Rioja 703';
        $centralidad51->geom = new Point(-42.778909, -65.054188);

        $centralidad51->save();


        //------------------------------------

        //Se agrega la Centralidad N°52

        $centralidad52 = new Centrality;
        $centralidad52->name = 'Centro de Salud Dr. Ramon Carrillo';
        $centralidad52->type = 'Salud';
        $centralidad52->location = 'Alcueznaga y Marcos A. Zar.';
        $centralidad52->geom = new Point(-42.785542, -65.025984);

        $centralidad52->save();


        //------------------------------------

        //Se agrega la Centralidad N°53

        $centralidad53 = new Centrality;
        $centralidad53->name = 'Centro de Salud Dr. Rene Favaloro';
        $centralidad53->type = 'Salud';
        $centralidad53->location = 'Chile 1725 Barrio Pujol II';
        $centralidad53->geom = new Point(-42.757506, -65.060733);

        $centralidad53->save();


        //------------------------------------

        //Se agrega la Centralidad N°54

        $centralidad54 = new Centrality;
        $centralidad54->name = 'Servicio de Adolescencia Dr. Pozzi';
        $centralidad54->type = 'Salud';
        $centralidad54->location = 'Juan Acosta 350';
        $centralidad54->geom = new Point(-42.758257, -65.041084);

        $centralidad54->save();


        //------------------------------------

        //Se agrega la Centralidad N°55

        $centralidad55 = new Centrality;
        $centralidad55->name = 'Centro de Salud Madre Teresa de Calcuta';
        $centralidad55->type = 'Salud';
        $centralidad55->location = 'Dorrego 1292 Barrio Gob. Galina';
        $centralidad55->geom = new Point(-42.788311, -65.040347);

        $centralidad55->save();


        //------------------------------------

        //Se agrega la Centralidad N°56

        $centralidad56 = new Centrality;
        $centralidad56->name = 'Centro de Adicciones';
        $centralidad56->type = 'Salud';
        $centralidad56->location = 'Dorrego 223';
        $centralidad56->geom = new Point(-42.783456, -65.026064);

        $centralidad56->save();


        //------------------------------------

        //Se agrega la Centralidad N°57

        $centralidad57 = new Centrality;
        $centralidad57->name = 'Banco Frances';
        $centralidad57->type = 'Financiero';
        $centralidad57->location = 'Roque Saenz Peña 30';
        $centralidad57->geom = new Point(-42.76497960090637, -65.0348299741745);

        $centralidad57->save();


        //------------------------------------

        //Se agrega la Centralidad N°58

        $centralidad58 = new Centrality;
        $centralidad58->name = 'Banco de la Nacion Argentina';
        $centralidad58->type = 'Financiero';
        $centralidad58->location = '9 de Julio 127';
        $centralidad58->geom = new Point(-42.768185, -65.034118);

        $centralidad58->save();


        //------------------------------------

        //Se agrega la Centralidad N°59

        $centralidad59 = new Centrality;
        $centralidad59->name = 'Banco Galicia';
        $centralidad59->type = 'Financiero';
        $centralidad59->location = 'Bartolome Mitre 25';
        $centralidad59->geom = new Point(-42.76510834693909, -65.03727614879608);

        $centralidad59->save();


        //------------------------------------

        //Se agrega la Centralidad N°60

        $centralidad60 = new Centrality;
        $centralidad60->name = 'Banco Patagonia';
        $centralidad60->type = 'Financiero';
        $centralidad60->location = 'Mitre 102';
        $centralidad60->geom = new Point(-42.76573061943054, -65.03663241863251);

        $centralidad60->save();


        //------------------------------------

        //Se agrega la Centralidad N°61

        $centralidad61 = new Centrality;
        $centralidad61->name = 'Banco Macro';
        $centralidad61->type = 'Financiero';
        $centralidad61->location = 'Roque Saenz Peña 280';
        $centralidad61->geom = new Point(-42.766154408454895, -65.03785818815231);

        $centralidad61->save();


        //------------------------------------

        //Se agrega la Centralidad N°62

        $centralidad62 = new Centrality;
        $centralidad62->name = 'Banco del Chubut';
        $centralidad62->type = 'Financiero';
        $centralidad62->location = '25 de Mayo 154';
        $centralidad62->geom = new Point(-42.76556432247162, -65.03500431776047);

        $centralidad62->save();


        //------------------------------------

        //Se agrega la Centralidad N°63

        $centralidad63 = new Centrality;
        $centralidad63->name = 'Banco Santender';
        $centralidad63->type = 'Financiero';
        $centralidad63->location = '28 de Julio 56';
        $centralidad63->geom = new Point(-42.76606857776642, -65.03422111272812);

        $centralidad63->save();


        //------------------------------------

        //Se agrega la Centralidad N°64

        $centralidad64 = new Centrality;
        $centralidad64->name = 'Banco Credicoop';
        $centralidad64->type = 'Financiero';
        $centralidad64->location = 'Roque Saenz Peña y 25 de Mayo';
        $centralidad64->geom = new Point(-42.765036, -65.03555);

        $centralidad64->save();


        //------------------------------------

        //Se agrega la Centralidad N°65

        $centralidad65 = new Centrality;
        $centralidad65->name = 'Farmacia ADOS';
        $centralidad65->type = 'Farmacia';
        $centralidad65->location = 'Mitre 476';
        $centralidad65->geom = new Point(42.769188, -65.034642);

        $centralidad65->save();


        //------------------------------------

        //Se agrega la Centralidad N°66

        $centralidad66 = new Centrality;
        $centralidad66->name = 'Farmacia Ampal';
        $centralidad66->type = 'Farmacia';
        $centralidad66->location = 'Domeg Garcia y Uruguay';
        $centralidad66->geom = new Point(-42.756071, -65.038705);

        $centralidad66->save();


        //------------------------------------

        //Se agrega la Centralidad N°67

        $centralidad67 = new Centrality;
        $centralidad67->name = 'Farmacia Atlantica';
        $centralidad67->type = 'Farmacia';
        $centralidad67->location = 'Juan B. Justo y Gales';
        $centralidad67->geom = new Point(-42.772801, -42.772801);

        $centralidad67->save();


        //------------------------------------

        //Se agrega la Centralidad N°68

        $centralidad68 = new Centrality;
        $centralidad68->name = 'Farmacia Central';
        $centralidad68->type = 'Farmacia';
        $centralidad68->location = '25 de Mayo 272';
        $centralidad68->geom = new Point(-42.766798, -65.034526);

        $centralidad68->save();


        //------------------------------------

        //Se agrega la Centralidad N°69

        $centralidad69 = new Centrality;
        $centralidad69->name = 'Farmacia de la Costa';
        $centralidad69->type = 'Farmacia';
        $centralidad69->location = 'Av. Roca 568';
        $centralidad69->geom = new Point(-42.769232, -65.031214);

        $centralidad69->save();


        //------------------------------------

        //Se agrega la Centralidad N°70

        $centralidad70 = new Centrality;
        $centralidad70->name = 'Farmacia DASU';
        $centralidad70->type = 'Farmacia';
        $centralidad70->location = 'Marcos A. Zar y Belgrano';
        $centralidad70->geom = new Point(-42.767987, -65.037071);

        $centralidad70->save();


        //------------------------------------

        //Se agrega la Centralidad N°71

        $centralidad71 = new Centrality;
        $centralidad71->name = 'Farmacia Gales';
        $centralidad71->type = 'Farmacia';
        $centralidad71->location = 'Roca 2438';
        $centralidad71->geom = new Point(-42.78545, -65.021096);

        $centralidad71->save();


        //------------------------------------

        //Se agrega la Centralidad N°72

        $centralidad72 = new Centrality;
        $centralidad72->name = 'Farmacia Gacio';
        $centralidad72->type = 'Farmacia';
        $centralidad72->location = 'Juan B. Justo 2018';
        $centralidad72->geom = new Point(-42.78505, -65.032735);

        $centralidad72->save();


        //------------------------------------

        //Se agrega la Centralidad N°73

        $centralidad73 = new Centrality;
        $centralidad73->name = 'Farmacia Lahuen Hue';
        $centralidad73->type = 'Farmacia';
        $centralidad73->location = 'Roque S. Peña 386';
        $centralidad73->geom = new Point(-42.7664, -65.039312);

        $centralidad73->save();


        //------------------------------------

        //Se agrega la Centralidad N°74

        $centralidad74 = new Centrality;
        $centralidad74->name = 'Farmacia Moderna';
        $centralidad74->type = 'Farmacia';
        $centralidad74->location = 'B. Mitre 502';
        $centralidad74->geom = new Point(-42.766764, -65.032933);

        $centralidad74->save();


        //------------------------------------

        //Se agrega la Centralidad N°75

        $centralidad75 = new Centrality;
        $centralidad75->name = 'Municipalidad de Puerto Madryn';
        $centralidad75->type = 'Edificio_Publico';
        $centralidad75->location = 'Belgrano 206';
        $centralidad75->geom = new Point(-42.767802, -65.035842);

        $centralidad75->save();


        //------------------------------------

        //Se agrega la Centralidad N°76

        $centralidad76 = new Centrality;
        $centralidad76->name = 'Muni Cerca 1';
        $centralidad76->type = 'Edificio_Publico';
        $centralidad76->location = 'Juan Muzzio 1106 y W. Jones';
        $centralidad76->geom = new Point(-42.770004, -65.048827);

        $centralidad76->save();


        //------------------------------------

        //Se agrega la Centralidad N°77

        $centralidad77 = new Centrality;
        $centralidad77->name = 'Muni Cerca 2';
        $centralidad77->type = 'Edificio_Publico';
        $centralidad77->location = 'España 1986';
        $centralidad77->geom = new Point(-42.779831, -65.057018);

        $centralidad77->save();


        //------------------------------------

        //Se agrega la Centralidad N°78

        $centralidad78 = new Centrality;
        $centralidad78->name = 'Muni Cerca 3';
        $centralidad78->type = 'Edificio_Publico';
        $centralidad78->location = 'Lavalle y Juan B. Justo';
        $centralidad78->geom = new Point(-42.783953, -65.033382);

        $centralidad78->save();


        //------------------------------------

        //Se agrega la Centralidad N°79

        $centralidad79 = new Centrality;
        $centralidad79->name = 'Escuela Municipal N 1 Victor Moron';
        $centralidad79->type = 'Edificio_Publico';
        $centralidad79->location = 'Anita Jones 44 B. 21 de Enero';
        $centralidad79->geom = new Point(-42.756251, -65.058715);

        $centralidad79->save();


        //------------------------------------

        //Se agrega la Centralidad N°80

        $centralidad80 = new Centrality;
        $centralidad80->name = 'Escuela Municipal N 3 C. B. De Padilla Esc. Verde';
        $centralidad80->type = 'Edificio_Publico';
        $centralidad80->location = 'Albarracin Norte 2982 - B San Miguel';
        $centralidad80->geom = new Point(-42.785315, -65.066941);

        $centralidad80->save();


        //------------------------------------

        //Se agrega la Centralidad N°81

        $centralidad81 = new Centrality;
        $centralidad81->name = 'CDI N 1 Piedra Libre';
        $centralidad81->type = 'Edificio_Publico';
        $centralidad81->location = 'Juan Muzzio y Necochea. B Perito Moreno';
        $centralidad81->geom = new Point(-42.76175,  -65.044995);

        $centralidad81->save();


        //------------------------------------

        //Se agrega la Centralidad N°82

        $centralidad82 = new Centrality;
        $centralidad82->name = 'CDI N 2 Paraiso de Colores';
        $centralidad82->type = 'Edificio_Publico';
        $centralidad82->location = 'Anita Jones 20 - B. 21 de Enero';
        $centralidad82->geom = new Point(-42.756476, -65.058729);

        $centralidad82->save();


        //------------------------------------

        //Se agrega la Centralidad N°83

        $centralidad83 = new Centrality;
        $centralidad83->name = 'CDI N 3 Abracadabra';
        $centralidad83->type = 'Edificio_Publico';
        $centralidad83->location = 'Gualjaina s/n e/Tecka y El: Maiten B. Pujol';
        $centralidad83->geom = new Point(-42.759644, -65.060376);

        $centralidad83->save();


        //------------------------------------

        //Se agrega la Centralidad N°84

        $centralidad84 = new Centrality;
        $centralidad84->name = 'CDI N 4 Pichi Nekum';
        $centralidad84->type = 'Edificio_Publico';
        $centralidad84->location = 'Albarracin Sur 2985 B. San Miguel';
        $centralidad84->geom = new Point(-42.785323, -65.066951);

        $centralidad84->save();


        //------------------------------------

        //Se agrega la Centralidad N°85

        $centralidad85 = new Centrality;
        $centralidad85->name = 'CDI N 8 Acuarela';
        $centralidad85->type = 'Edificio_Publico';
        $centralidad85->location = 'La Rioja 725';
        $centralidad85->geom = new Point(-42.779007, -65.054161);

        $centralidad85->save();


        //------------------------------------

        //Se agrega la Centralidad N°86

        $centralidad86 = new Centrality;
        $centralidad86->name = 'Club Municipal de Ciencias';
        $centralidad86->type = 'Edificio_Publico';
        $centralidad86->location = 'Juan Muzzio y Necochea';
        $centralidad86->geom = new Point(-42.761937, -65.045162);

        $centralidad86->save();


        //------------------------------------

        //Se agrega la Centralidad N°87

        $centralidad87 = new Centrality;
        $centralidad87->name = 'Subsecretaria de Desarrollo Comunitario';
        $centralidad87->type = 'Edificio_Publico';
        $centralidad87->location = 'Bouchard y 9 de Julio';
        $centralidad87->geom = new Point(-42.773154, -65.048568);

        $centralidad87->save();


        //------------------------------------

        //Se agrega la Centralidad N°88

        $centralidad88 = new Centrality;
        $centralidad88->name = 'Gimnasio Municipal I';
        $centralidad88->type = 'Edificio_Publico';
        $centralidad88->location = 'Sarmiento 1235';
        $centralidad88->geom = new Point(-42.774204, -65.048274);

        $centralidad88->save();


        //------------------------------------

        //Se agrega la Centralidad N°89

        $centralidad89 = new Centrality;
        $centralidad89->name = 'Gimansio Municipal II';
        $centralidad89->type = 'Edificio_Publico';
        $centralidad89->location = 'Berwyn y Pasaje Evita';
        $centralidad89->geom = new Point(-42.760866, -65.045612);

        $centralidad89->save();


        //------------------------------------

        //Se agrega la Centralidad N°90

        $centralidad90 = new Centrality;
        $centralidad90->name = 'Biblioteca Popular Agustin Pujol';
        $centralidad90->type = 'Edificio_Publico';
        $centralidad90->location = 'Anita Jones 44';
        $centralidad90->geom = new Point(-42.756221, -65.058597);

        $centralidad90->save();


        //------------------------------------

        //Se agrega la Centralidad N°91

        $centralidad91 = new Centrality;
        $centralidad91->name = 'Carrefour';
        $centralidad91->type = 'Comercial';
        $centralidad91->location = 'Av. Gales 1315';
        $centralidad91->geom = new Point(-42.775578, -65.04869);

        $centralidad91->save();


        //------------------------------------

        //Se agrega la Centralidad N°92

        $centralidad92 = new Centrality;
        $centralidad92->name = 'Supermercados Vea';
        $centralidad92->type = 'Comercial';
        $centralidad92->location = 'Manuel Belgrano 370';
        $centralidad92->geom = new Point(-42.7683, -65.037942);

        $centralidad92->save();


        //------------------------------------

        //Se agrega la Centralidad N°93

        $centralidad93 = new Centrality;
        $centralidad93->name = 'Hiper Tehuelche';
        $centralidad93->type = 'Comercial';
        $centralidad93->location = '9 de Julio 1941';
        $centralidad93->geom = new Point(-42.774177,  -65.051584);

        $centralidad93->save();


        //------------------------------------

        //Se agrega la Centralidad N°94

        $centralidad94 = new Centrality;
        $centralidad94->name = 'La Anonima';
        $centralidad94->type = 'Comercial';
        $centralidad94->location = 'Italia 500';
        $centralidad94->geom = new Point(-42.76738, -65.042814);

        $centralidad94->save();


        //------------------------------------

        //Se agrega la Centralidad N°95

        $centralidad95 = new Centrality;
        $centralidad95->name = 'Chango Mas';
        $centralidad95->type = 'Comercial';
        $centralidad95->location = 'Juan B. Justo 1885';
        $centralidad95->geom = new Point(-42.784578, -65.033073);

        $centralidad95->save();


        //------------------------------------

        //Se agrega la Centralidad N°96

        $centralidad96 = new Centrality;
        $centralidad96->name = 'Supermercado Clemente';
        $centralidad96->type = 'Comercial';
        $centralidad96->location = 'Marcelo T. de Alvear 2561';
        $centralidad96->geom = new Point(-42.789752, -65.028259);

        $centralidad96->save();


        //------------------------------------

        //Se agrega la Centralidad N°97

        $centralidad97 = new Centrality;
        $centralidad97->name = 'Cine Teatro Auditorium';
        $centralidad97->type = 'Comercial';
        $centralidad97->location = '28 de Julio 129';
        $centralidad97->geom = new Point(-42.766152, -65.035412);

        $centralidad97->save();


        //------------------------------------

        //Se agrega la Centralidad N°98

        $centralidad98 = new Centrality;
        $centralidad98->name = 'El portal de Madryn';
        $centralidad98->type = 'Comercial';
        $centralidad98->location = 'Av. Julio Argentino Roca 230';
        $centralidad98->geom = new Point(-42.76575, -65.03365);

        $centralidad98->save();


        //------------------------------------

        //Se agrega la Centralidad N°99

        $centralidad99 = new Centrality;
        $centralidad99->name = 'Comisaria 1';
        $centralidad99->type = 'Seguridad';
        $centralidad99->location = 'Bartolome Mitre 346';
        $centralidad99->geom = new Point(-42.768017, -65.035393);

        $centralidad99->save();


        //------------------------------------

        //Se agrega la Centralidad N°100

        $centralidad100 = new Centrality;
        $centralidad100->name = 'Comisaria 3';
        $centralidad100->type = 'Seguridad';
        $centralidad100->location = 'Juan B. Justo 1699';
        $centralidad100->geom = new Point(-42.783863, -65.033555);

        $centralidad100->save();


        //------------------------------------

        //Se agrega la Centralidad N°101

        $centralidad101 = new Centrality;
        $centralidad101->name = 'Comisaria de la Mujer';
        $centralidad101->type = 'Seguridad';
        $centralidad101->location = '9 de Julio 441';
        $centralidad101->geom = new Point(-42.769608, -65.038283);

        $centralidad101->save();


        //------------------------------------

        //Se agrega la Centralidad N°102

        $centralidad102 = new Centrality;
        $centralidad102->name = 'Casa de la Mujer';
        $centralidad102->type = 'ONG';
        $centralidad102->location = 'Bartolome Mitre 376';
        $centralidad102->geom = new Point(-42.768299, -65.035202);

        $centralidad102->save();


        //------------------------------------

        //Se agrega la Centralidad N°103

        $centralidad103 = new Centrality;
        $centralidad103->name = 'Biblioteca Popular El Porvenir';
        $centralidad103->type = 'Cultura';
        $centralidad103->location = 'Pje Williams 325';
        $centralidad103->geom = new Point(-42.760277, -65.04857);

        $centralidad103->save();


        //------------------------------------

        //Se agrega la Centralidad N°104

        $centralidad104 = new Centrality;
        $centralidad104->name = 'Casa de la Cultura';
        $centralidad104->type = 'Cultura';
        $centralidad104->location = 'Roque Saenz Peña 86';
        $centralidad104->geom = new Point(-42.765086, -65.035597);

        $centralidad104->save();


        //------------------------------------

        //Se agrega la Centralidad N°105

        $centralidad105 = new Centrality;
        $centralidad105->name = 'Centro Comunitario Quemu-CGB III';
        $centralidad105->type = 'Cultura';
        $centralidad105->location = 'Tucuman 311';
        $centralidad105->geom = new Point(-42.758302, -65.043151);

        $centralidad105->save();


        //------------------------------------

        //Se agrega la Centralidad N°106

        $centralidad106 = new Centrality;
        $centralidad106->name = 'Centro Cultural San Miguel';
        $centralidad106->type = 'Cultura';
        $centralidad106->location = 'Garagarza 778';
        $centralidad106->geom = new Point(-42.785038, -65.069529);

        $centralidad106->save();


        //------------------------------------

        //Se agrega la Centralidad N°107

        $centralidad107 = new Centrality;
        $centralidad107->name = 'Centro de Dia Hospital Isola';
        $centralidad107->type = 'Salud';
        $centralidad107->location = 'Dorrego 233,';
        $centralidad107->geom = new Point(-42.783493, -65.026174);

        $centralidad107->save();


        //------------------------------------

        //Se agrega la Centralidad N°108

        $centralidad108 = new Centrality;
        $centralidad108->name = 'Centro de Dia Salud Mental';
        $centralidad108->type = 'Salud';
        $centralidad108->location = '9 de Julio 544';
        $centralidad108->geom = new Point(-42.770072, -65.039698);

        $centralidad108->save();


        //------------------------------------

        //Se agrega la Centralidad N°109

        $centralidad109 = new Centrality;
        $centralidad109->name = 'Centro de Gestion Barrial N I';
        $centralidad109->type = 'Edificio_Publico';
        $centralidad109->location = 'Albarracin y Tomas Mate';
        $centralidad109->geom = new Point(-42.78258, -65.061032);

        $centralidad109->save();


        //------------------------------------

        //Se agrega la Centralidad N°110

        $centralidad110 = new Centrality;
        $centralidad110->name = 'Centro de Gestion Barrial N II';
        $centralidad110->type = 'Edificio_Publico';
        $centralidad110->location = 'Rio Mayo y El Maiten';
        $centralidad110->geom = new Point(-42.757984, -65.063081);

        $centralidad110->save();


        //------------------------------------

        //Se agrega la Centralidad N°111

        $centralidad111 = new Centrality;
        $centralidad111->name = 'Centro de Gestion Barrial N 4 Sede Junta Vecinal B. Peron';
        $centralidad111->type = 'Edificio_Publico';
        $centralidad111->location = 'Albarracin 3445';
        $centralidad111->geom = new Point(-42.785572, -65.068821);

        $centralidad111->save();


        //------------------------------------

        //Se agrega la Centralidad N°112

        $centralidad112 = new Centrality;
        $centralidad112->name = 'Centro de Jubilados';
        $centralidad112->type = 'Social';
        $centralidad112->location = '1 de Marzo 483';
        $centralidad112->geom = new Point(-42.76656, -65.041053);

        $centralidad112->save();


        //------------------------------------

        //Se agrega la Centralidad N°113

        $centralidad113 = new Centrality;
        $centralidad113->name = 'Ex Casa del Gerente del Ferrocarril';
        $centralidad113->type = 'Cultura';
        $centralidad113->location = 'Domecq Garcia 98';
        $centralidad113->geom = new Point(-42.769945, -65.046326);

        $centralidad113->save();


        //------------------------------------

        //Se agrega la Centralidad N°114

        $centralidad114 = new Centrality;
        $centralidad114->name = 'Feria de Servicio Pujol II';
        $centralidad114->type = 'Social';
        $centralidad114->location = 'Rio Pico y Chile';
        $centralidad114->geom = new Point(-42.757552, -65.060705);

        $centralidad114->save();


        //------------------------------------

        //Se agrega la Centralidad N°115

        $centralidad115 = new Centrality;
        $centralidad115->name = 'Hogar Nuestros Abuelos';
        $centralidad115->type = 'Social';
        $centralidad115->location = 'Albarracin Norte 3098';
        $centralidad115->geom = new Point(-42.785805, -65.068286);

        $centralidad115->save();


        //------------------------------------

        //Se agrega la Centralidad N°116

        $centralidad116 = new Centrality;
        $centralidad116->name = 'Hogar de Ancianos Nuestras Raices';
        $centralidad116->type = 'Social';
        $centralidad116->location = 'Rio Pico 1914 B. Pujol II';
        $centralidad116->geom = new Point(-42.757124, -65.061811);

        $centralidad116->save();


        //------------------------------------

        //Se agrega la Centralidad N°117

        $centralidad117 = new Centrality;
        $centralidad117->name = 'Junta Vecinal Desembarco';
        $centralidad117->type = 'Edificio_Publico';
        $centralidad117->location = 'Roca y Libertad';
        $centralidad117->geom = new Point(-42.78738, -65.019868);

        $centralidad117->save();


        //------------------------------------

        //Se agrega la Centralidad N°118

        $centralidad118 = new Centrality;
        $centralidad118->name = 'Junta Vecinal El Porvenir';
        $centralidad118->type = 'Edificio_Publico';
        $centralidad118->location = 'Roberto Gomez y Juan XXIII';
        $centralidad118->geom = new Point(-42.757583, -65.047681);

        $centralidad118->save();


        //------------------------------------

        //Se agrega la Centralidad N°119

        $centralidad119 = new Centrality;
        $centralidad119->name = 'Junta Vecinal Fontana';
        $centralidad119->type = 'Edificio_Publico';
        $centralidad119->location = 'Buenos Aires entre España y Gales';
        $centralidad119->geom = new Point(-42.778528, -65.055391);

        $centralidad119->save();


        //------------------------------------

        //Se agrega la Centralidad N°120

        $centralidad120 = new Centrality;
        $centralidad120->name = 'Junta Vecinal Galina';
        $centralidad120->type = 'Edificio_Publico';
        $centralidad120->location = 'Dorrego 1288';
        $centralidad120->geom = new Point(-42.788311, -65.040303);

        $centralidad120->save();


        //------------------------------------

        //Se agrega la Centralidad N°121

        $centralidad121 = new Centrality;
        $centralidad121->name = 'Junta Vecinal Guemes';
        $centralidad121->type = 'Edificio_Publico';
        $centralidad121->location = 'Ferrocarril Patagonico y Pasaje Becker';
        $centralidad121->geom = new Point(-42.772205, -65.052839);

        $centralidad121->save();


        //------------------------------------

        //Se agrega la Centralidad N°122

        $centralidad122 = new Centrality;
        $centralidad122->name = 'Junta Vecinal Piedra Buena';
        $centralidad122->type = 'Edificio_Publico';
        $centralidad122->location = 'Lewis Jones 528';
        $centralidad122->geom = new Point(-42.781608, -65.032336);

        $centralidad122->save();


        //------------------------------------

        //Se agrega la Centralidad N°123

        $centralidad123 = new Centrality;
        $centralidad123->name = 'Junta Vecinal Roque Gonzales';
        $centralidad123->type = 'Edificio_Publico';
        $centralidad123->location = 'Albarracin y Alberdi';
        $centralidad123->geom = new Point(-42.783008, -65.061548);

        $centralidad123->save();


        //------------------------------------

        //Se agrega la Centralidad N°124

        $centralidad124 = new Centrality;
        $centralidad124->name = 'Junta Vecinal Ruca Hue';
        $centralidad124->type = 'Edificio_Publico';
        $centralidad124->location = 'Patricias Argentina y Fuerte San Jose';
        $centralidad124->geom = new Point(-42.766393, -65.048398);

        $centralidad124->save();


        //------------------------------------

        //Se agrega la Centralidad N°125

        $centralidad125 = new Centrality;
        $centralidad125->name = 'Talleres Spencer';
        $centralidad125->type = 'Cultura';
        $centralidad125->location = 'San Martin 652';
        $centralidad125->geom = new Point(-42.772044, -65.036075);

        $centralidad125->save();


        //------------------------------------

        //Se agrega la Centralidad N°126

        $centralidad126 = new Centrality;
        $centralidad126->name = 'Teatro Del Muelle';
        $centralidad126->type = 'Cultura';
        $centralidad126->location = 'Av. Rawson 60';
        $centralidad126->geom = new Point(-42.762753, -65.035256);

        $centralidad126->save();


        //------------------------------------

        //Se agrega la Centralidad N°127

        $centralidad127 = new Centrality;
        $centralidad127->name = 'Teatro de La Rosada';
        $centralidad127->type = 'Cultura';
        $centralidad127->location = 'Paulina Escardo 187';
        $centralidad127->geom = new Point(-42.761269, -65.038146);

        $centralidad127->save();


        //------------------------------------

        //Se agrega la Centralidad N°128

        $centralidad128 = new Centrality;
        $centralidad128->name = 'Museo de arte';
        $centralidad128->type = 'Cultura';
        $centralidad128->location = 'Av. Roca 444';
        $centralidad128->geom = new Point(-42.767957, -65.032157);

        $centralidad128->save();


        //------------------------------------

        //Se agrega centralidad N°129

        $centralidad129 = new Centrality;
        $centralidad129->name = 'Museo Oceanografico';
        $centralidad129->type = 'Cultura';
        $centralidad129->location = 'Av. Domec García Norte 1';
        $centralidad129->geom = new Point(-42.76224, -65.0400489);

        $centralidad129->save();


        //------------------------------------

        //Se agrega centralidad N°130

        $centralidad130 = new Centrality;
        $centralidad130->name = 'Clinica Santa Maria';
        $centralidad130->type = 'Cultura';
        $centralidad130->location = 'Bartolomé Mitre 643,';
        $centralidad130->geom = new Point(-42.7711356, -65.0335442);

        $centralidad130->save();


        //------------------------------------

        //Se agrega centralidad N°131

        $centralidad131 = new Centrality;
        $centralidad131->name = 'Aeropuerto El Tehuelche';
        $centralidad131->type = 'Transporte';
        $centralidad131->location = 'Aeropuerto Puerto Madryn';
        $centralidad131->geom = new Point(-42.7691016, -65.1062229);

        $centralidad131->save();


        //------------------------------------

        //Se agrega centralidad N°132

        $centralidad132 = new Centrality;
        $centralidad132->name = 'Pista de Atletismo';
        $centralidad132->type = 'Espacio_Publico';
        $centralidad132->location = 'Mariano Moreno ';
        $centralidad132->geom = new Point(-42.77671694755554, -65.03405749797821);

        $centralidad132->save();


        //------------------------------------
    }
}
