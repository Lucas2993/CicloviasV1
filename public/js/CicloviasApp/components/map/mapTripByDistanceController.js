/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripByDistanceController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer','adminLayers', MapTripByDistanceController]);

    function MapTripByDistanceController(vm, creatorMap, srvLayers, dataServer, adminLayers) {

        // ******************* DECLARACION DE VARIABLES Y FUNCIONES *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************
        vm.map = creatorMap.getMap();
        // usada para almacenar los datos recuperados del servidor, para no volver a pedir los datos
        vm.tripstodistanceJson;
        // capa que refleja los recorridos encontrados
        vm.layerTripsByDistance;
        // almacena la distancia especificada en la grafica
        vm.distance;

        // #################### FLAGS ####################
        // Bandera que indica si la capa de recorridos de una determinada distancia esta creada.
        vm.isLayerByDistanceCreated = false;
        // Modelo para usar con el checkbox (es necesario declararlo asi).
        vm.selectTripByDistance = {
            checkbox: false
        };

        // *********************** FUNCIONES ***********************
        // Se obtienen todos los recorridos con la distancia seleccionada y se agregan en una capa.
        vm.getTripsToSelectedDistance = getTripsToSelectedDistance;
        // Permite la visualizacion de la capa de recorridos de una determinada distancia (si existe).
        vm.viewTripsToSelectedDistance = viewTripsToSelectedDistance;
        // Se setean todo lo relacionado con los recorridos de una determinada distancia.
        vm.resetLayerToSelectedDistance = resetLayerToSelectedDistance;

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


        // **************************************************************************************
        // *************************** Descripcion de las funciones *****************************

        // *********************** PUBLICAS ***********************
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
                    vm.layerTripsByDistance = srvLayers.getLayerTripsFinder(vm.tripstodistanceJson);
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

        function viewTripsToSelectedDistance() {
            // Se comprueba que la capa existe.
            if (vm.isLayerByDistanceCreated) {
                // Se hace visible la capa.
                adminLayers.viewLayer(vm.layerTripsByDistance);
                vm.layerTripsByDistance.setVisible(vm.selectTripByDistance.checkbox);
            }
        }

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
            // setea la distancia
            vm.distance = 0;
        }

    } // fin Constructor

})()
