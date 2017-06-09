// Responsabilidad : controlador que permite buscar los recorridos de una determinada distancia
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripByDistanceController', [
                                                    '$scope',
                                                    'creatorMap',
                                                    'srvLayers',
                                                    'dataServer',
                                                    'adminLayers',
                                                    'creatorStyle',
                                                    'srvViewTrip',
                                                    MapTripByDistanceController]);

    function MapTripByDistanceController(vm, creatorMap, srvLayers, dataServer, adminLayers,creatorStyle,srvViewTrip) {

        // ********************************** VARIABLES PUBLICAS ************************
        vm.map = creatorMap.getMap();
        // usada para almacenar los datos recuperados del servidor, para no volver a pedir los datos
        vm.tripstodistanceJson;
        // capa que refleja los recorridos encontrados
        vm.layerTripsByDistance;
        // almacena la distancia especificada en la grafica
        vm.distance;
        // almacena la tolerancia para los recorridos especificada en la grafica
        vm.tolerance;

        // ********************************** FLAGS PUBLICAS ****************************
        // Bandera que indica si la capa de recorridos de una determinada distancia esta creada.
        vm.isLayerByDistanceCreated = false;
        // Modelo para usar con el checkbox (es necesario declararlo asi).
        vm.selectTripByDistance = {
            checkbox: false
        };

        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        // Se obtienen todos los recorridos con la distancia seleccionada y se agregan en una capa.
        vm.getTripsToSelectedDistance = getTripsToSelectedDistance;
        // Permite la visualizacion de la capa de recorridos de una determinada distancia (si existe).
        vm.viewTripsToSelectedDistance = viewTripsToSelectedDistance;
        // Se setean todo lo relacionado con los recorridos de una determinada distancia.
        vm.resetLayerToSelectedDistance = resetLayerToSelectedDistance;

        vm.toogleViewTrips = toogleViewTrips;
        // ****************************** FUNCIONES PUBLICAS ****************************

        function getTripsToSelectedDistance() {
            dataServer.getTripsToDistance(vm.longMin,vm.longMax)
                .then(function(data) {
                    vm.tripstodistanceJson = data;
                    console.log("Datos recuperados prom TRIPS de determinada distancia con EXITO! = " + data);
                    // Se muestra la nueva capa.
                    resetLayerToSelectedDistance();
                    vm.viewTripsToSelectedDistance();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS de una determinada distancia");
                })
        }

        // Evento que se ejecuta al checkear ver capa de recorridos, hace un toogle de la capa de recorridos
        function toogleViewTrips() {
            console.log("entro a la seleccion de VST recorridos");
            if (vm.tripstodistanceJson == null) {
                return;
            }
            adminLayers.viewLayer(vm.layerTripsByDistance);
        }


        function viewTripsToSelectedDistance() {
            if (vm.tripstodistanceJson == null) {
                return;
            }
            vm.selectTripByDistance.checkbox = true;
            srvViewTrip.addTrips(vm.tripstodistanceJson, vm.layerTripsByDistance);
        }

        function resetLayerToSelectedDistance() {
            vm.layerTripsByDistance.getSource().clear();
            // Se indica que la capa ya no existe.
            vm.isLayerByDistanceCreated = false;
            // Se desmarca el checkbox.
            // vm.selectTripByDistance.checkbox = false;
            // setea la distancia
            vm.distance = 0;
            // setea la tolerancia
            vm.tolerance = 0;
        }

        // *******************************FUNCIONES PRIVADAS ****************************
        // Este metodo genera una capa
        function generateLayer() {
            // Se crea una nueva capa de recorridos con los datos obtenidos.
            vm.layerTripsByDistance = srvLayers.getLayer(null);
            // Se agrega la capa nueva al mapa.
            vm.layerTripsByDistance.setStyle(creatorStyle.getStyleTrip('green', 2));
            vm.map.addLayer(vm.layerTripsByDistance);
        }

        // ************************ Inicializacion de datos *****************************
        generateLayer();

    } // fin Constructor

})()
