// Responsabilidad :Controlar el modulo de recorridos, permite solo visualizar las recorridos
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripBetweenZoneController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'dataServer',
            'srvModelZone',
            'srvViewZone',
            'adminLayers',
            'srvViewTrip',
            MapTripBetweenZoneController
        ]);

    function MapTripBetweenZoneController(vm, creatorMap, srvLayers, dataServer, srvModelZone, srvViewZone, adminLayers, srvViewTrip) {
        // ********************************** VARIABLES PUBLICAS ************************
        // Mapa
        vm.map = creatorMap.getMap();
        // Lista de recorridos obtenidas del servidor
        vm.tripsJson = [];
        // capa de recorridos
        vm.tripLayer;

        // ********************************** FLAGS PUBLICAS ****************************
        // determina si se quieren ver todos los recorridos o no
        vm.selectedLayer = false;


        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        // permite la visualizacion o no de un recorrido
        vm.selectTrip = selectTrip;

        vm.getZones = getZones;

        vm.findTripsBetweenZones = findTripsBetweenZones;

        function selectTrip(trip) {
            console.log("entro a la seleccion de VST recorridos");
            srvViewTrip.viewTrip(trip, vm.tripLayer);
        }

        // ****************************** FUNCIONES PRIVADAS ****************************
        function findTripsBetweenZones() {
            dataServer.getTripsBetweenZones(vm.selectedOrigin.id, vm.selectedDestination.id)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsJson = data;
                    vm.selectedLayer = true;
                    addTripsBetweenZone();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
        }

        function generateLayer() {
            vm.tripLayer = srvLayers.getLayer(null);
            vm.map.addLayer(vm.tripLayer);
        }

        // ************************ Inicializacion de datos *****************************
        generateLayer();
        // findTripsBetweenZones();


        vm.viewLayerTripsBetweenZone = viewLayerTripsBetweenZone;

        // muestra la capa de recorridos
        function viewLayerTripsBetweenZone() {
            adminLayers.viewLayer(vm.tripLayer);
        }

        vm.addTripsBetweenZone = addTripsBetweenZone;

        // agrega recorridos a la capa de recorridos
        function addTripsBetweenZone() {
            srvViewTrip.addTrips(vm.tripsJson, vm.tripLayer);
            // vm.journiesLayer.setVisible(false);
        }


        vm.resetLayerBetweenZone = resetLayerBetweenZone;

        // reinicia para realizar otra consulta
        function resetLayerBetweenZone() {
            vm.tripLayer.getSource().clear();
            srvModelZone.getZonesLayer().getSource().clear();
            vm.selectedOrigin = undefined;
            vm.selectedDestination = undefined;
        }

        // selecciona las zonas
        vm.selectZoneOrigin = selectZoneOrigin;
        vm.selectZoneDestination = selectZoneDestination;

        var oldOrigin = null;
        var oldDestination = null;

        function selectZoneOrigin() {
            selectZone(vm.selectedOrigin, vm.selectedDestination, srvModelZone.getZonesLayer(), 'green','red');
        }

        function selectZoneDestination() {
            selectZone(vm.selectedDestination, vm.selectedOrigin, srvModelZone.getZonesLayer(), 'red','green');
        }

        function selectZone(selectedZone, otherZone, layer, color,otherColor) {
            console.log(selectedZone);
            vm.tripLayer.getSource().clear();
            srvModelZone.getZonesLayer().getSource().clear();
            if (otherZone != null) {
                console.log(otherZone);
                srvViewZone.addZone(otherZone, layer, otherColor);
            }
            srvViewZone.addZone(selectedZone, layer, color);
            // otherZone = JSON.parse(JSON.stringify(selectedZone));
        }


        function getZones() {
            return srvModelZone.getZones();
        }



    } // fin Constructor

})()
