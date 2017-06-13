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
            MapTripBetweenZoneController
        ]);

    function MapTripBetweenZoneController(vm, creatorMap, srvLayers, dataServer, srvModelZone) {
        // ********************************** VARIABLES PUBLICAS ************************
        // Mapa
        vm.map = creatorMap.getMap();
        // Lista de recorridos obtenidas del servidor
        vm.tripsJson = [];
        // capa de recorridos
        vm.tripLayer;

        // ********************************** FLAGS PUBLICAS ****************************
        // determina si se quieren ver todos los recorridos o no
        vm.selectAllTrips = false;


        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        // permite la visualizacion o no de un recorrido
        vm.selectTrip = selectTrip;


        function selectTrip(trip) {
            console.log("entro a la seleccion de VST recorridos");
            srvViewTrip.viewTrip(trip, vm.tripLayer);
        }

        // ****************************** FUNCIONES PRIVADAS ****************************
        function findTripsBetweenZones() {
            dataServer.getTripsBetweenZones(16,24)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsJson = data;
                    // proceso y generacion de capa de recorridos

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
        findTripsBetweenZones();

    } // fin Constructor

})()
