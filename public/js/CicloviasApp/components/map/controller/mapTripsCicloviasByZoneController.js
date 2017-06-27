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
            'adminLayers',
            'adminMenu',
            TripsCicloviasController
        ]);

    function TripsCicloviasController(vm, creatorMap, srvLayers, dataServer, srvViewZone, srvModelZone, srvViewTrip, adminLayers, adminMenu) {

        // ********************* declaracion de variables y metodos *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************
        vm.map = creatorMap.getMap();
        // datos del servidor
        vm.tripsCicloviasJson = [];
        // capa de recorridos
        vm.layerTripsByZone;
        // zonas recuperadas de la DB
        vm.zonesJson;
        // zone seleccionada
        // vm.selectedZone = undefined;
        vm.selectedZone = {
            id: 0,
            name: ''
        }
        //
        vm.isZoneSelected = false;

        // ===============>>>>>> FLAGS <<<<<===============
        // indica si el menu se encuentra abierto o cerrado
        vm.openMenuTripsCiclovia = false;
        vm.isZoneSelected = false;

        // **************************** FUNCIONES ****************************
        // permite la visualizacion de la capa de tramos ponderados (segun el estado del checkbox)
        vm.viewLayerTripsCiclovia = viewLayerTripsCiclovia;
        // permite la visualizacion de la capa de zonas
        vm.viewLayerZones = viewLayerZones;
        vm.viewZoneSelected = viewZoneSelected;

        vm.findTripsByZone = findTripsByZone;

        vm.selectZone = selectZone;
        vm.resetLayer = resetLayer;

        // vm.findTripsRanking = findTripsRanking;
        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PRIVADO ***********************************
        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        var enableEventClick;
        // recupera los datos del servidor y los guarda en una variable
        var findTripsCiclovias;
        // variable para visualizar un solo popup en el mapa
        var popup = null;
        // refleja la visualizacion de las zonas
        var allZonesShow = false;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Descripcion de las funciones ************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // ********************** PUBLICAS **********************
        function viewLayerTripsCiclovia() {
            adminLayers.viewLayer(vm.layerTripsByZone);
        }

        // permite la visualizacion o no de una zona
        function selectZone(zone) {
            srvViewZone.viewZone(zone, vm.zonesLayer);
        }

        function viewZoneSelected(){
            // buscar los datos json de la zona
            var zone = getZoneJsonSelected(vm.selectedZone.id);
            console.log(zone);
            srvViewZone.viewZone(zone, vm.zonesLayer);
        }

        // muestra u oculta la visualizacion de todas las zonas
        function viewLayerZones(){
            if (allZonesShow) {
                allZonesShow = false;
                vm.isZoneSelected = false;
                vm.zonesLayer.getSource().clear();
            } else {
                allZonesShow = true;
                vm.isZoneSelected = true;
                srvViewZone.addZones(vm.zonesJson, vm.zonesLayer);
            }
            // console.log("Cant de zonas: "+srvModelZone.getZones().length);
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
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if(adminMenu.activeTripsCiclovias()){
                console.log("Se hizo click en el mapa.");
                // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
                vm.callbackZonesOnClick(evt.pixel);
                if(vm.selectedZone.id == 0){
                    console.log("No se selecciona ninguna zona");
                }
            }
        });

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
            vm.selectedZone = srvModelZone.getZone(zone.getId());
            vm.isZoneSelected = true;
            // se refrescan los datos de la zona en la vista
            vm.$apply();
            console.log("Zona seleccionada: "+vm.selectedZone.name);
        }

        // ********************** PRIVADAS **********************
        // Busca todas los recorridos de la BD ************** terminar

        // Busca todas las zonas de la BD
        function findAllZones() {
            console.log("Entro a findAllZones()\n");
            dataServer.getZones()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.zonesJson = data;
                    // vm.totalItems = vm.zonesJson.length;
                    console.log("Datos recuperados prom ZONES con EXITO! = " + data);
                    srvModelZone.setZones(vm.zonesJson);
                    srvModelZone.setZonesLayer(vm.zonesLayer);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las ZONES");
                })
        }

        // Modificado por JLDEVIA el 28/05/2017. S.U: Adaptación visual a spatial-data.
        function findTripsByZone() {
            dataServer.getTripsRankingByZone(vm.selectedZone.id)
                .then(function(data) {
                    vm.tripsCicloviasJson = data;
                    console.log("Trips recuperados POSIBLES_CICLOVIAS:");
                    console.log(data);
                    // proceso y genracion de capa de recorridos
                    // vm.layerTripsByZone = srvLayers.getLayerTrips(vm.tripsCicloviasJson);
                    // vm.map.addLayer(vm.layerTripsByZone);
                    generateTripsByZone();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS CICLOVIAS");
                })
        }

        function generateTripsByZone() {
            vm.layerTripsCiclovias = srvLayers.getLayer(null);
            vm.map.addLayer(vm.layerTripsCiclovias);
            // srvViewTrip.viewTrip(vm.tripsCicloviasJson, vm.layerTripsCiclovias);
            srvViewTrip.addTrips(vm.tripsCicloviasJson, vm.layerTripsCiclovias);
            console.log("Capa de trayectos ponderados: "+vm.layerTripsCiclovias.getVisible());
        }

        // recupera los datos json de la zona seleccionada
        function getZoneJsonSelected(idZone){
            var zoneJson;
            for (var i = 0; i < vm.zonesJson.length; i++) {
                if((vm.zonesJson[i]).id == idZone){
                    console.log("id: "+(vm.zonesJson[i]).id);
                    zoneJson = vm.zonesJson[i];
                    return zoneJson;
                }
            }
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
            // vm.selectedZone = undefined;
            vm.selectedZone = {
                id: 0,
                name: ''
            }
            vm.zonesLayer.getSource().clear();
            vm.layerTripsCiclovias.getSource().clear();
        }



        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Inicializacion de datos *****************************
        // ******************************************************************************
        // al crear el controlador ejecutamos esta funcion
        // findTripsCiclovias();
        // vm.viewLayerTripsCiclovia();
        createLayerZone(vm.zonesJson);
        findAllZones();
        // srvViewZone.addZones(vm.zonesJson, vm.zonesLayer);
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    } // fin Constructor

})()
