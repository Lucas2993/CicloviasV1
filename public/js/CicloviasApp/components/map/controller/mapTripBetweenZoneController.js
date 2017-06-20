// Responsabilidad :Controlar el modulo de recorridos, permite solo visualizar las recorridos
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripBetweenZoneController', [
            '$scope',
            'creatorMap',
            'adminMenu',
            'srvLayers',
            'dataServer',
            'srvModelZone',
            'srvViewZone',
            'adminLayers',
            'srvViewTrip',
            MapTripBetweenZoneController
        ]);

    function MapTripBetweenZoneController(vm, creatorMap, adminMenu, srvLayers, dataServer, srvModelZone, srvViewZone, adminLayers, srvViewTrip) {
        // ********************************** VARIABLES PUBLICAS ************************
        // Mapa
        vm.map = creatorMap.getMap();
        // Lista de recorridos obtenidas del servidor
        vm.tripsJson = [];
        // capa de recorridos
        vm.tripLayer;
        vm.selectedOrigin = "";
        vm.selectedDestination = "";

        // ********************************** FLAGS PUBLICAS ****************************
        // determina si se quieren ver todos los recorridos o no
        vm.selectedLayer = false;
        // determna el estado de visualizacion del menu
        vm.openMenuTripFinder = false;
        vm.existTripsToShow = false;

        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        // permite la visualizacion o no de un recorrido
        vm.selectTrip = selectTrip;
        // recupera todas las zonas del sistema
        vm.getZones = getZones;
        // recupera los recorridos correspondientes a las zonas seleccionadas
        vm.findTripsBetweenZones = findTripsBetweenZones;
        // permite la visualizacion de los recorridos obtenidos
        vm.viewLayerTripsBetweenZone = viewLayerTripsBetweenZone;
        // agrega los recorridos(features) a la zona
        vm.addTripsBetweenZone = addTripsBetweenZone;
        // limpia la capa que muestra los resultados obtenidos
        vm.resetLayerBetweenZone = resetLayerBetweenZone;
        // muestran las zonas seleccionadas en el mapa
        vm.selectZoneOrigin = selectZoneOrigin;
        vm.selectZoneDestination = selectZoneDestination;


        function selectTrip(trip) {
            console.log("entro a la seleccion de VST recorridos");
            srvViewTrip.viewTrip(trip, vm.tripLayer);
        }

        function getZones() {
            return srvModelZone.getZones();
        }

        function findTripsBetweenZones() {
            console.log(vm.selectedOrigin);
            // if(){
            dataServer.getTripsBetweenZones(vm.selectedOrigin.id, vm.selectedDestination.id)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsJson = data;
                    if(data.length > 0){
                        vm.existTripsToShow = true;
                    }
                    addTripsBetweenZone();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
            // }
        }

        function viewLayerTripsBetweenZone() {
            adminLayers.viewLayer(vm.tripLayer);
        }

        function addTripsBetweenZone() {
            srvViewTrip.addTrips(vm.tripsJson, vm.tripLayer);
            // vm.journiesLayer.setVisible(false);
        }

        function resetLayerBetweenZone() {
            vm.tripLayer.getSource().clear();
            if(srvModelZone.getZonesLayer() != null){
                srvModelZone.getZonesLayer().getSource().clear();
            }
            vm.selectedOrigin = undefined;
            vm.selectedDestination = undefined;
            vm.existTripsToShow = false;
        }

        function selectZoneOrigin() {
            selectZone(vm.selectedOrigin, vm.selectedDestination, srvModelZone.getZonesLayer(), 'green','red');
        }

        function selectZoneDestination() {
            selectZone(vm.selectedDestination, vm.selectedOrigin, srvModelZone.getZonesLayer(), 'red','green');
        }


        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuTripFinder', function(isOpen) {
            if (isOpen) {
                console.log('El menu de TRIPS BETWEEN esta abierto');
                enableEventClick();
            } else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                // vm.tripLayer.getSource().clear();
                resetLayerBetweenZone();
                console.log('El menu de TRIPS BETWEEN esta cerrado');
            }
        });

        // ****************************** FUNCIONES PRIVADAS ****************************
        // crea la capa donde se reflejan los datos
        function generateLayer() {
            console.log("Tomo los cambios 8.\n");
            vm.tripLayer = srvLayers.getLayer(null);
            vm.map.addLayer(vm.tripLayer);
        }

        // permite la visualizacion de las zona seleccionadas
        function selectZone(selectedZone, otherZone, layer, color,otherColor) {
            console.log(selectedZone);
            vm.tripLayer.getSource().clear();
            srvModelZone.getZonesLayer().getSource().clear();
            if (otherZone != null) {
                console.log(otherZone);
                srvViewZone.addZone(otherZone, layer, otherColor);
            }
            srvViewZone.addZone(selectedZone, layer, color);
        }

        // funcion que habilita el uso de los eventos de este menu
        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveTripsBetweenZones(true);
        }

        // ************************ Inicializacion de datos *****************************
        generateLayer();

    } // fin Constructor

})()
