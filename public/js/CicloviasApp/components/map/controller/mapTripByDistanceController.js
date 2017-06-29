// Responsabilidad : controlador que permite buscar los recorridos de una determinada distancia
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripByDistanceController', [
                                                    '$scope',
                                                    'creatorMap',
                                                    'adminMenu',
                                                    'srvLayers',
                                                    'dataServer',
                                                    'adminLayers',
                                                    'creatorStyle',
                                                    'srvViewTrip',
                                                    MapTripByDistanceController]);

    function MapTripByDistanceController(vm, creatorMap, adminMenu, srvLayers, dataServer, adminLayers,creatorStyle,srvViewTrip) {

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
        // Modelo para usar con el checkbox (es necesario declararlo asi).
        vm.selectTripByDistance = {
            checkbox: false
        };
        vm.openMenuTripDistance = false;
        vm.existTripsToShow = false;

        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        // Se obtienen todos los recorridos con la distancia seleccionada y se agregan en una capa.
        vm.getTripsToSelectedDistance = getTripsToSelectedDistance;
        // Permite la visualizacion de la capa de recorridos de una determinada distancia (si existe).
        vm.viewTripsToSelectedDistance = viewTripsToSelectedDistance;
        // limpia todos los datos y campos mostrados en el mapa
        vm.resetLayer = resetLayer;

        vm.toogleViewTrips = toogleViewTrips;
        // ****************************** FUNCIONES PUBLICAS ****************************

        function getTripsToSelectedDistance() {
            // if((vm.longMin > 0)&&(vm.longMax > 0)){
                dataServer.getTripsToDistance(vm.longMin,vm.longMax)
                    .then(function(data) {
                        vm.tripstodistanceJson = data;
                        if(data.length > 0){
                            vm.existTripsToShow = true;
                        }
                        console.log("Datos recuperados prom TRIPS de determinada distancia con EXITO! = " + data);
                        // Se muestra la nueva capa.
                        resetLayer();
                        vm.viewTripsToSelectedDistance();
                    })
                    .catch(function(err) {
                        console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS de una determinada distancia");
                    })
            // }
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
            // vm.selectTripByDistance.checkbox = true;
            srvViewTrip.addTrips(vm.tripstodistanceJson, vm.layerTripsByDistance);
        }


        function resetLayer(){
            console.log("Entro a limpiar DISTANCE\n");
            vm.layerTripsByDistance.getSource().clear();
            // Se indica que la capa ya no existe.
            vm.existTripsToShow = false;
            vm.distance = 0;
            vm.tolerance = 0;
            vm.longMin = 100;
            vm.longMax = 500;
        }

        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuTripDistance', function(isOpen) {
            if (isOpen) {
                console.log('El menu de TRIPS DISTANCE esta abierto');
                enableEventClick();
            } else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                // vm.tripLayer.getSource().clear();
                // resetLayerToSelectedDistance();
                console.log('El menu de TRIPS DISTANCE esta cerrado');
                resetLayer();
            }
        });

        // *******************************FUNCIONES PRIVADAS ****************************
        // Este metodo genera una capa
        function generateLayer() {
            // Se crea una nueva capa de recorridos con los datos obtenidos.
            vm.layerTripsByDistance = srvLayers.getLayer(null);
            // Se agrega la capa nueva al mapa.
            vm.layerTripsByDistance.setStyle(creatorStyle.getStyleTrip('green', 2));
            vm.map.addLayer(vm.layerTripsByDistance);
        }

        // funcion que habilita el uso de los eventos de este menu
        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveTripsToDistance(true);
        }


        // ************************ Inicializacion de datos *****************************
        generateLayer();

    } // fin Constructor

})()
