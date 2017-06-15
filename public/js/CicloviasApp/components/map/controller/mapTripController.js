// Responsabilidad :Controlar el modulo de recorridos, permite solo visualizar las recorridos
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'dataServer',
            'srvViewTrip',
            MapTripController
        ]);
 
    function MapTripController(vm, creatorMap, srvLayers, dataServer, srvViewTrip) {
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
        // muestra o no todos los recorridos (segun el estado del checkbox)
        vm.checkAllTrips = checkAllTrips;
        // permite la visualizacion o no de un recorrido
        vm.selectTrip = selectTrip;

        // ****************************** FUNCIONES PUBLICAS ****************************

        function checkAllTrips() {
            if (vm.selectAllTrips) {
                vm.selectAllTrips = false;
                vm.tripLayer.getSource().clear();
            } else {
                vm.selectAllTrips = true;
                srvViewTrip.addTrips(vm.tripsJson, vm.tripLayer);
            }

            angular.forEach(vm.tripsJson, function(trip) {
                trip.selected = vm.selectAllTrips;
            });
            console.log("Ver todos los recorridos: " + vm.selectAllTrips);
        }

        function selectTrip(trip) {
            console.log("entro a la seleccion de VST recorridos");
            srvViewTrip.viewTrip(trip, vm.tripLayer);
        }

        // ****************************** FUNCIONES PRIVADAS ****************************
        function findAllTrips() {
            dataServer.getTrips()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsJson = data;
                    console.log("Datos recuperados TRIPS(privado) con EXITO! = " + data);
                    // proceso y generacion de capa de recorridos
                    generateTrips();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
        }

        function generateTrips() {
            vm.tripLayer = srvLayers.getLayer(null);
            vm.map.addLayer(vm.tripLayer);
        }

        // ************************ Inicializacion de datos *****************************
        findAllTrips();

    } // fin Constructor

})()
