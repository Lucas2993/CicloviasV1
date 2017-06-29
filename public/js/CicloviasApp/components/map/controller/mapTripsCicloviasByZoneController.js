/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('tripsCicloviasByZoneController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'dataServer',
            'srvViewZone',
            'srvModelZone',
            'srvViewTrip',
            'srvModelCicloviasByZone',
            'adminLayers',
            'adminMenu',
            TripsCicloviasController
        ]);

    function TripsCicloviasController(vm, creatorMap, srvLayers, dataServer, srvViewZone, srvModelZone, srvViewTrip, srvModelCicloviasByZone, adminLayers, adminMenu) {

        // ********************* declaracion de variables y metodos *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************
        vm.map = creatorMap.getMap();
        // datos del servidor
        vm.tripsCicloviasJson = [];
        // capa de recorridos
        vm.layerTripsCiclovias;
        // vm.layerTripsCicloviasLocal;
        // zonas recuperadas de la DB
        vm.zonesJson;
        // zone seleccionada
        vm.zoneSelected = "";
        var zoneAdded = false;
        // vm.selectedZone = {
        //     id: 0,
        //     name: ''
        // }

        // ===============>>>>>> FLAGS <<<<<===============
        // indica si el menu se encuentra abierto o cerrado
        vm.openMenuTripsCiclovia = false;
        vm.isZoneSelected = false;
        vm.journiesFounded = false;

        // **************************** FUNCIONES ****************************
        // permite la visualizacion de la capa de tramos ponderados (segun el estado del checkbox)
        vm.viewZoneSelected = viewZoneSelected;

        vm.findTripsByZone = findTripsByZone;

        vm.selectZone = selectZone;
        vm.resetLayer = resetLayer;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PRIVADO ***********************************
        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        var enableEventClick;
        // variable para visualizar un solo popup en el mapa
        var popup = null;
        // refleja la visualizacion de las zonas
        var allZonesShow = false;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Descripcion de las funciones ************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // recupera todas las zonas del sistema
        vm.getZones = getZones;
        vm.viewSelectZone = viewSelectZone;
        vm.selectZoneFromMap = selectZoneFromMap;
        vm.viewJourniesFounded = viewJourniesFounded;

        // ********************** PUBLICAS **********************

        // permite la visualizacion o no de una zona
        function selectZone(zone) {
            srvViewZone.viewZone(zone, vm.zonesLayer);
        }

        function viewZoneSelected(){
            // buscar los datos json de la zona
            if(zoneAdded){
                srvViewZone.removeZone(vm.zoneSelected, vm.zoneslayer);
                zoneAdded = false;
            }
            else{
                srvViewZone.addZone(vm.zoneSelected, vm.zoneslayer, "green");
                zoneAdded = true;
            }
        }

        function selectZoneFromMap(){
            // mostramos todas las zonas
            allZonesShow = true;
            // si ya se habia seleccionado una zona se borra y se setea el flag correspondientes
            if(vm.isZoneSelected){
                srvViewZone.removeZone(vm.zoneSelected, vm.zoneslayer);
                vm.isZoneSelected = false;
            }
            // se muestran todas las zonas
            srvViewZone.addAll(getZones(), vm.zonesLayer);
            // controlamos la seleccion de una zona
            vm.map.on('click', function(evt) {
                // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
                if(adminMenu.activeTripsCiclovias()){
                    console.log("Se hizo click en el mapa.");
                    // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
                    vm.callbackZonesOnClick(evt.pixel);
                    if(vm.zoneSelected.id == 0){
                        console.log("No se selecciona ninguna zona");
                    }
                }
            });
        }

        function viewJourniesFounded(){
            adminLayers.viewLayer(vm.layerTripsCiclovias);
            adminLayers.viewLayer(srvModelCicloviasByZone.getCicloviasByZoneLayer());
        }

        // Modificacion y borrado de una centralidad.
        vm.callbackZonesOnClick = function(pixel) {
            // Determina que elemento se clickeo (indicador de centralidad).
            vm.map.forEachFeatureAtPixel(pixel, function(feature, layer) {
                // Se obtienen los datos de coordenadas del indicador y se busca si corresponde a una centralidad.
                vm.searchZone(feature);
            })
        }

        // Se realiza la busqueda de la centralidad a la que pertenece el punto dado.
        vm.searchZone = function(zone) {
            if(!vm.isZoneSelected){
                vm.zoneSelected = srvModelZone.getZone(zone.getId());
                vm.isZoneSelected = true;
                srvViewZone.removeAll(getZones(), vm.zonesLayer);
                srvViewZone.addZone(vm.zoneSelected, vm.zoneslayer, 'green');
                // srvViewZone.addZone(vm.selectedZone, vm.zoneslayer, 'green');
                zoneAdded = true;
                // console.log("Zona seleccionada 1: "+vm.selectedZone.name+"isSelect:"+vm.isZoneSelected);
            }
            // se refrescan los datos de la zona en la vista
            vm.$apply();
        }

        // metodo utilizado por el typeahead
        function getZones() {
            return srvModelZone.getZones();
        }

        function viewSelectZone() {
            viewSelectedZone(vm.zoneSelected, 'green');
            console.log("Entro al metodo de arriba\n");
        }

        // permite la visualizacion de las zona seleccionadas
        function viewSelectedZone(selectedZone, color) {
            if(vm.zoneslayer != undefined){
                vm.zoneslayer.getSource().clear();
            }
            srvViewZone.addZone(selectedZone, vm.zoneslayer, color);
            zoneAdded = true;
            vm.isZoneSelected = true;
            console.log("Se agrego la zona al la cap\n");
        }

        // // ################## OBSERVADORAS ##################
        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuTripsCiclovia', function(isOpen){
            if (isOpen) {
              console.log('El menu de POSIBLES_CICLOVIAS esta abierto');
              enableEventClick();
            }
            else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                console.log("Se cerro el menu POSIBLES_CICLOVIAS\n");
                adminMenu.setActiveTripsCiclovias(false);
                vm.openMenuTripsCiclovia = false;
                resetLayer();
            }
        });

        // Se captura el evento dentro del mapa.
        vm.map.on('pointermove', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if (adminMenu.activeTripsCiclovias()) {
                // buscamos si se clickeo en un marcador
                var featureFound = vm.map.forEachFeatureAtPixel(evt.pixel,
                    function(feature) {
                        return feature;
                    });

                // si se clickea en un marcador, se crea y muestra el popup cn el dato
                if ((featureFound)&&(featureFound.getGeometry().getType() != 'Polygon')) {
                    console.log("FEATURE type:");
                    // console.log(featureFound.getGeometry().getType());
                    var coordinates = featureFound.getGeometry().getCoordinates();
                    // console.log(coordinates);
                    // se borra el popup anterior
                    if (popup != null) {
                        popup.container.style.display = 'none';
                    }
                    popup = new ol.Overlay.Popup({
                        positioning: 'center-center',
                        stopEvent: false,
                        offset: [0, -5],
                        autoPan: false
                        // idFeature: 2
                    });
                    vm.map.addOverlay(popup);
                    // console.log("Entro a mostrar frec.\n");
                    // console.log(vm.tripsCicloviasJson);
                    console.log("Entro a mostrar model frec\n");
                    console.log(srvModelCicloviasByZone.getCicloviasByZone());
                    // popup.show(evt.coordinate, vm.tripsCicloviasJson[featureFound.getId() - 1].frequency);
                    popup.show(evt.coordinate, (srvModelCicloviasByZone.getCicloviasByZone())[featureFound.getId() - 1].frequency);
                    //TODO modificar cuand lea desde el servidor
                    // console.log("Entro a mostrar frec.\n");
                    // console.log(vm.tripsCicloviasJson);
                }
            }
        });

        // ****************************************************************
        // *************************** PRIVADAS ***************************

        function findTripsByZone() {
            dataServer.getTripsRankingByZone(vm.zoneSelected.id)
                .then(function(data) {
                    vm.tripsCicloviasJson = data;
                    console.log("Trips recuperados POSIBLES_CICLOVIAS:");
                    console.log(data);
                    if(vm.tripsCicloviasJson.length > 0){
                        // proceso y genracion de capa de recorridos
                        generateTripsByZone();
                        vm.journeisFounded = true;
                    }
                    else{
                        console.log("No se encontraron trayectos de la zona.\n");
                        alert("No se encontraron trayectos de la zona!");
                    }
                    // // proceso y genracion de capa de recorridos
                    // generateTripsByZone();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS CICLOVIAS");
                })
        }

        function generateTripsByZone() {
            // vm.layerTripsCiclovias = srvLayers.getLayer(null);
            // vm.map.addLayer(vm.layerTripsCiclovias);
            // srvViewTrip.addTrips(vm.tripsCicloviasJson, vm.layerTripsCiclovias);

            console.log("Se genero la capa de TRIP ZONE\n");

            vm.layerTripsCicloviasLocal = srvLayers.getLayer(null);
            // vm.map.addLayer(vm.layerTripsCicloviasLocal);
            // srvViewTrip.addTrips(vm.tripsCicloviasJson, vm.layerTripsCicloviasLocal);
            srvModelCicloviasByZone.setCicloviasByZone(vm.tripsCicloviasJson);
            srvModelCicloviasByZone.setCicloviasByZoneLayer(vm.layerTripsCicloviasLocal);
            srvViewTrip.addTrips(srvModelCicloviasByZone.getCicloviasByZone(), srvModelCicloviasByZone.getCicloviasByZoneLayer());
            vm.map.addLayer(srvModelCicloviasByZone.getCicloviasByZoneLayer());
            // console.log("Capa de trayectos ponderados: "+vm.layerTripsCiclovias.getVisible());
        }

        function enableEventClick(){
            adminMenu.disableAll();
            adminMenu.setActiveTripsCiclovias(true);
        }

        //Generacion de Capa de Zonas a partir del json recibido desde el service
        function createLayerZone(infoZoneJson) {
            vm.zonesLayer = srvLayers.getLayer(null); //TODO a refactorizar
            vm.map.addLayer(vm.zonesLayer);
        }

        // resetea los datos del menu
        function resetLayer(){
            allZonesShow = false;
            vm.isZoneSelected = false;
            vm.journeisFounded = false;
            srvViewZone.removeZone(vm.zoneSelected, vm.zoneslayer);
            vm.zonesLayer.getSource().clear();
            if(vm.layerTripsCiclovias != undefined){
                vm.layerTripsCiclovias.getSource().clear();
            }
            if(srvModelCicloviasByZone.getCicloviasByZoneLayer()){
                srvModelCicloviasByZone.getCicloviasByZoneLayer().getSource().clear();
            }
            // if (srvModelZone.getZ) {
            //
            // }
            // srvViewZone.removeZone(vm.zoneSelected, vm.zoneslayer);
            vm.zoneSelected = "";
            vm.$apply;
            zoneAdded = false;
            console.log("Aca m llamo el LIDER\n");
        }

        function generateLayerZones(){
            vm.zoneslayer = srvLayers.getLayer(null);
            vm.map.addLayer(vm.zoneslayer);
        }

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Inicializacion de datos *****************************
        // ******************************************************************************
        // al crear el controlador ejecutamos esta funcion
        createLayerZone(vm.zonesJson);
        generateLayerZones();

        console.log("************************ Se creo un controlador ********************************\n");

        // recuperamos la capa unica de ciclovias por zona
        vm.layerTripsCiclovias = srvModelCicloviasByZone.getCicloviasByZoneLayer();
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    } // fin Constructor

})()
