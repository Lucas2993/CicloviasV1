/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripByCentralityController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'dataServer',
            'adminLayers',
            'adminMenu',
            'srvViewTrip',
            'creatorStyle',
            'srvModelCentrality',
            MapTripByCentralityController
        ]);

    function MapTripByCentralityController(vm, creatorMap, srvLayers, dataServer, adminLayers, adminMenu,srvViewTrip,creatorStyle,srvModelCentrality) {

        // ******************* DECLARACION DE VARIABLES Y FUNCIONES *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************
        vm.map = creatorMap.getMap();
        // usada para almacenar los datos recuperados del servidor, para no volver a pedir los datos
        vm.tripstocentralityJson;
        // capa que refleja los recorridos encontrados
        vm.tripsLayerByCentrality;

        vm.openMenuTripsByCentrality = false;

        // #################### FLAGS ####################
        // Bandera que indica si la capa de recorridos de una determinada distancia esta creada.
        vm.isLayerByCentralityCreated = false;
        // Modelo para usar con el checkbox (es necesario declararlo asi).
        vm.selectTripByCentrality = {
            checkbox: false
        };

        vm.selectedCentrality = {
            id: 0,
            name: '',
            location: '',
            latitude: '',
            longitude: ''
        }

        // *******************************FUNCIONES PUBLICAS ****************************
        // Se obtienen todos los recorridos con la distancia seleccionada y se agregan en una capa.
        vm.getTripsToSelectedCentrality = getTripsToSelectedCentrality;
        // Permite la visualizacion de la capa de recorridos de una determinada distancia (si existe).
        vm.viewTripsToSelectedCentrality = viewTripsToSelectedCentrality;
        // Se setean todo lo relacionado con los recorridos de una determinada distancia.
        vm.resetLayerToSelectedCentrality = resetLayerToSelectedCentrality;

        vm.toogleViewTrips = toogleViewTrips;
        // **************************************************************************************
        // *************************** Descripcion de las funciones *****************************

        // *********************** PUBLICAS ***********************
        // Evento que se ejecuta al checkear ver capa de recorridos, hace un toogle de la capa de recorridos
        function toogleViewTrips() {
            console.log("entro a la seleccion de VST recorridos");
            if (vm.tripstocentralityJson == null) {
                return;
            }
            adminLayers.viewLayer(vm.tripsLayerByCentrality);
        }


        function getTripsToSelectedCentrality() {
            dataServer.getTripsToCentrality(vm.selectedCentrality.geom.coordinates[1], vm.selectedCentrality.geom.coordinates[0])
                .then(function(data) {
                    vm.tripstocentralityJson = data;
                    console.log("Datos recuperados prom TRIPS de determinada centralidad con EXITO! = " + data);
                    resetLayerToSelectedCentrality();
                    vm.viewTripsToSelectedCentrality();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS de una determinada centralidad");
                })
        }

        function viewTripsToSelectedCentrality() {

            if (vm.tripstocentralityJson == null) {
                return;
            }
            vm.selectTripByCentrality.checkbox = true;
            srvViewTrip.addTrips(vm.tripstocentralityJson, vm.tripsLayerByCentrality);
        }

        function resetLayerToSelectedCentrality() {
            vm.tripsLayerByCentrality.getSource().clear();

            vm.isLayerByCentralityCreated = false;
            // Se desmarca el checkbox.
            vm.selectTripByCentrality.checkbox = false;

            vm.selectedCentrality = {
                id: 0,
                name: '',
                location: '',
                latitude: '',
                longitude: ''
            }
        }

        // Se captura el evento de click dentro del mapa.
        vm.map.on('click', function(evt) {
            if (adminMenu.activeTripsToCentrality()) {
                // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
                vm.callbackMarkersOnClick(evt.pixel);
            }
        });

        // Modificacion y borrado de una centralidad.
        vm.callbackMarkersOnClick = function(pixel) {
            // Determina que elemento se clickeo (indicador de centralidad).
            vm.map.forEachFeatureAtPixel(pixel, function(feature, layer) {
                // Se obtienen los datos de coordenadas del indicador y se busca si corresponde a una centralidad.
                vm.searchCentrality(feature);
            })
        }

        // Se realiza la busqueda de la centralidad a la que pertenece el punto dado.
        vm.searchCentrality = function(point) {
            vm.selectedCentrality = srvModelCentrality.getCentrality(point.getId());
            vm.$apply();
        }

        vm.$watch('openMenuTripsByCentrality', function(isOpen) {
            if (isOpen) {
                console.log('El menu de TRIP_CENTRALITY esta abierto');
                enableEventClick();
            }
        });

        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveTripsToCentrality(true);
            console.log('Entro a actualizacion de eventos TRIP_CENTRALITY');
        }

        var layer;

        // Este metodo genera una capa
        function generateLayer() {
            vm.tripsLayerByCentrality = srvLayers.getLayer(null);
            // Se agrega la capa nueva al mapa.
            vm.tripsLayerByCentrality.setStyle(creatorStyle.getStyleTrip('green', 2));
            vm.map.addLayer(vm.tripsLayerByCentrality);
        }

        generateLayer();

    } // fin Constructor

})()
