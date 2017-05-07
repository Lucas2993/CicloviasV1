/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality', 'dataServer', 'adminLayers','adminTrip', MapTripController]);

    function MapTripController(vm, creatorMap, srvLayers, srvLayersCentrality, dataServer, adminLayers,adminTrip) {

        // ********************* declaracion de variables y metodos *********************

        vm.map = creatorMap.getMap();

        vm.findAllTrips = findAllTrips;


        // ************************ inicializacion de datos del mapa ************************
        // **********************************************************************************
        vm.findAllTrips();


        // **********************************************************************************
        // ************************ Descripcion de las funciones ************************

        // Busca todas los recorridos de la BD
        function findAllTrips() {
            dataServer.getTrips()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsJson = data;
                    console.log("Datos recuperados prom TRIPS con EXITO! = " + data);
                    // proceso y genracion de capa de recorridos
                    vm.layerTrips = srvLayers.getLayerTrips(vm.tripsJson);
                    vm.map.addLayer(vm.layerTrips);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
        }

        vm.layerTrips;
        vm.viewLayerTrips = viewLayerTrips;
        vm.selectAllTrips = false;

        function viewLayerTrips() {
            // adminLayers.viewLayer(vm.layerTrips);
            if (vm.selectAllTrips) {
                vm.selectAllTrips = false;
                vm.layerTrips.getSource().clear();
            } else {
                vm.selectAllTrips = true;
                adminLayers.addTrips(vm.tripsJson, vm.layerTrips);
            }

            angular.forEach(vm.tripsJson, function(trip) {
                trip.selected = vm.selectAllTrips;
            });
        }

        vm.selectTrip = selectTrip;

        function selectTrip(trip) {
            console.log("entro a la seleccion de recorridos");
            adminTrip.viewTrip(trip, vm.layerTrips);
        }


    } // fin Constructor

})()
