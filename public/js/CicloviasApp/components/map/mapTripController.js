/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer', 'adminLayers','adminTrip', MapTripController]);

    function MapTripController(vm, creatorMap, srvLayers, dataServer, adminLayers,adminTrip) {

        // ******************* DECLARACION DE VARIABLES Y FUNCIONES *********************
        
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************
        vm.map = creatorMap.getMap();
        // usada para almacenar los datos recuperados del servidor, para no volver a pedir los datos
        vm.tripsJson;
        // capa de recorridos
        vm.layerTrips

        // #################### FLAGS ####################
        // determina si se quieren ver todos los recorridos o no
        vm.selectAllTrips = false;

        // **************************** FUNCIONES ****************************
        // muestra o no todos los recorridos (segun el estado del checkbox)
        vm.viewAllTrips = viewAllTrips;
        // permite la visualizacion o no de un recorrido
        vm.viewSelectedTrip = viewSelectedTrip;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PRIVADO ***********************************
        // recupera los datos del servidor y los guarda en un variables, para no volver a llamar al servicio
        var findAllTrips;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ inicializacion de datos del mapa ********************
        // ******************************************************************************
        // al crear el controlador ejecutamos esta funcion
        findAllTrips();

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Descripcion de las funciones ************************

        function findAllTrips() {
            dataServer.getTrips()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsJson = data;
                    console.log("Datos recuperados TRIPS(privado) con EXITO! = " + data);
                    // proceso y genracion de capa de recorridos
                    vm.layerTrips = srvLayers.getLayerTrips(vm.tripsJson);
                    vm.map.addLayer(vm.layerTrips);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
        }


        function viewAllTrips() {
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
            console.log("Ver todos los recorridos: "+vm.selectAllTrips);
        }


        function viewSelectedTrip(trip) {
            console.log("entro a la seleccion de VST recorridos");
            adminTrip.viewTrip(trip, vm.layerTrips);
        }

    } // fin Constructor

})()
