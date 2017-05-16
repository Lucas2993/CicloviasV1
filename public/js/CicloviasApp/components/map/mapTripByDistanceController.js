/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripByDistanceController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality', 'dataServer','adminLayers', 'serviceTrip', 'adminTrip', MapTripByDistanceController]);

    function MapTripByDistanceController(vm, creatorMap, srvLayers, srvLayersCentrality, dataServer,adminLayers,  serviceTrip, adminTrip) {

        // ********************* declaracion de variables y metodos *********************

        vm.map = creatorMap.getMap();

        // ******************************************************************************************
        // ****************************** capa de Recorridos *****************************************

        vm.getTripsToSelectedDistance = getTripsToSelectedDistance;
        vm.viewTripsToSelectedDistance = viewTripsToSelectedDistance;
        vm.resetLayerToSelectedDistance = resetLayerToSelectedDistance;

        // Cuando el usuario quiere crear una nueva centralidad de ajustan las banderas y se inicializa la centralidad.

        // ******************************************************************************************
        // ****************************** Recorridos por Distancia ******************************

        // Se construye un modelo para capturar todos los puntos


        // Este metodo se encarga de obtener todos los recorridos cercanos a un
        // punto seleccionado y agregarlos en una capa.
        function getTripsToSelectedDistance() {
            dataServer.getTripsToDistance(vm.distance)
                .then(function(data) {
                    vm.tripstodistanceJson = data;
                    console.log("Datos recuperados prom TRIPS de determinada distancia con EXITO! = " + data);
                    // Se establece que la capa de recorridos de una Distancia se mostrara (valor del checkbox).
                    vm.selectTripByDistance.checkbox = false;
                    // Si la capa ya fue creada anteriormente se la elimina para poder crear una nueva actualizada.
                    if (vm.isLayerByDistanceCreated) {
                        vm.map.removeLayer(vm.layerTripsByDistance);
                        vm.isLayerByDistanceCreated = false;
                    }
                    // Se crea una nueva capa de recorridos con los datos obtenidos.
                    vm.layerTripsByDistance = srvLayers.getLayerTrips(vm.tripstodistanceJson);
                    vm.layerTripsByDistance = srvLayers.getLayerTripsOld(vm.tripstodistanceJson);
                    // Se indica que una nueva capa de recorridos por distancia se ha creado.
                    vm.isLayerByDistanceCreated = true;
                    // Se agrega la capa nueva al mapa.
                    vm.map.addLayer(vm.layerTripsByDistance);
                    // Se establce que la capa de recorridos de una determinada distancia se mostrara (valor del checkbox).
                    vm.selectTripByDistance.checkbox = true;
                    // Se muestra la nueva capa.
                    vm.viewTripsToSelectedDistance();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS de una determinada distancia");
                })
        }

        // Este metodo se encarga de mostrar la capa de recorridos de una determinada distancia (si existe).
        function viewTripsToSelectedDistance() {
            // Se comprueba que la capa existe.
            if (vm.isLayerByDistanceCreated) {
                // Se hace visible la capa.
                adminLayers.viewLayer(vm.layerTripsByDistance);
                vm.layerTripsByDistance.setVisible(vm.selectTripByDistance.checkbox);
                //vm.layerTripsByDistance.setVisible(true);
            }
        }

        // Modelo para usar con el checkbox (es necesario declararlo asi).
        vm.selectTripByDistance = {
            checkbox: false
        }

        // Bandera que indica si la capa de recorridos de una determinada distancia esta creada.
        vm.isLayerByDistanceCreated = false;

        // Este metodo resetea todo lo relacionado con los recorridos de una determinada distancia.
        function resetLayerToSelectedDistance() {
            // Si la capa esta creada, es removida.
            if (vm.isLayerByDistanceCreated) {
                // Se remueve la capa del mapa.
                vm.map.removeLayer(vm.layerTripsByDistance);
            }
            // Se indica que la capa ya no existe.
            vm.isLayerByDistanceCreated = false;
            // Se desmarca el checkbox.
            vm.selectTripByDistance.checkbox = false;
            //Se setea a 0 km la distancia.

        }

    } // fin Constructor

})()
