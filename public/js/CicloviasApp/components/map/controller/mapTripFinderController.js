/* Controlador que permite ver los recorridos cercanos a un punto
   Historia de Usuario : Recorridos cercanos a un punto
   Creado : Sprint 2
   Modificado : Sprint 5 ( Refactor de servicios angular )
*/
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripFinderController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'dataServer',
            'adminMenu',
            'creatorStyle',
            'srvViewTrip',
            'adminLayers',  // solo usado para el toogle Layer
            'creatorFeature',
            MapTripFinderController
        ]);

    function MapTripFinderController(vm, creatorMap, srvLayers, dataServer, adminMenu, creatorStyle, srvViewTrip, adminLayers,creatorFeature) {

        // ********************************** VARIABLES PUBLICAS ************************
        //Mapa
        vm.map = creatorMap.getMap();
        // usada para almacenar los datos recuperados del servidor, para no volver a pedir los datos
        vm.tripsclosetopointJson = null;
        // capa que muestra los recorridos cercanos a un punto
        vm.layerTripsCloseToPoint;
        // donde se almacenan los datos del punto seleccionado en el mapa
        vm.selectedPoint = {
            latitude: '0',
            longitude: '0'
        };

        // ********************************** FLAGS PUBLICOS ****************************
        // indica si el menu se encuentra abierto o cerrado
        vm.openMenuTripFinder = false;
        // Modelo para usar con el checkbox (es necesario declararlo asi).
        vm.selectTripCloseToPoint = {
            checkbox: true
        }
        // Indica si la capa de recorridos cercanos a un punto esta creada.
        vm.isPointCreated = false;

        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        // Este metodo se encarga de obtener todos los recorridos cercanos a un
        // punto seleccionado y agregarlos en una capa.
        vm.getTripsCloseToSelectedPoint = getTripsCloseToSelectedPoint;
        // Este metodo se encarga de mostrar la capa de recorridos cercanos a un punto (si existe).
        vm.viewTripsCloseToPoint = viewTripsCloseToPoint;
        // Este metodo resetea todo lo relacionado con los recorridos cercanos a un punto.
        vm.resetLayerCloseToPoint = resetLayerCloseToPoint;
        // Este metodo hace un toogle de la capa de recorridos
        vm.toogleViewTrips = toogleViewTrips;

        // ********************************** VARIABLES PRIVADAS ************************
        // capa temporal para mostrar el punto selecciondao en el mapa
        var temporalLayer =srvLayers.getLayer(null);
        temporalLayer.setStyle(creatorStyle.getStyleTemporalEditCentrality());

        // agregamos la capa al mapa
        temporalLayer.setMap(vm.map);

        // *******************************FUNCIONES PUBLICAS ****************************

        // Evento que se ejecuta al precionar "ver recorridos cercanos", si se ha elegido un punto en el
        // mapa, realiza una consulta por los recorridos mas cercanos al punto.
        function getTripsCloseToSelectedPoint() {
            console.log("isPointCreated : " + vm.isPointCreated);
            console.log("vm.selectTripCloseToPoint.checkbox : " + vm.selectTripCloseToPoint.checkbox);
            // Si la capa ya fue creada anteriormente se la elimina para poder crear una nueva actualizada.
            if (vm.isPointCreated) {
                // vm.map.removeLayer(vm.layerTripsCloseToPoint);
                vm.layerTripsCloseToPoint.getSource().clear();
                findTripsCloseToSelectedPoint();
            }
        }

        // Evento que se ejecuta al checkear ver capa de recorridos, hace un toogle de la capa de recorridos
        function toogleViewTrips() {
            console.log("entro a la seleccion de VST recorridos");
            if (vm.tripsclosetopointJson == null) {
                return;
            }
            adminLayers.viewLayer(vm.layerTripsCloseToPoint);
        }

        // Muestra en el mapa los recorridos cercanos a un punto
        function viewTripsCloseToPoint() {
            // Se hace visible la capa.
            if (vm.tripsclosetopointJson == null) {
                return;
            }
            srvViewTrip.addTrips(vm.tripsclosetopointJson, vm.layerTripsCloseToPoint);
        }

        // Elimina todos los recorridos de la capa de recorridos cercanos.
        function resetLayerCloseToPoint() {
            vm.layerTripsCloseToPoint.getSource().clear();
        }

        // *******************************FUNCIONES PRIVADAS ****************************
        // Este metodo se ocupa de realizar una peticion HTTP, solicitando los recorridos mas cercanos a un punto
        function findTripsCloseToSelectedPoint() {
            console.log("select to point: " + vm.selectedPoint);
            // vm.tripsclosetopointJson = null;
            dataServer.getTripsCloseToPoint(vm.selectedPoint)
                .then(function(data) {
                    vm.tripsclosetopointJson = data;
                    console.log("Datos recuperados prom TRIPS cercanos a un punto con EXITO! = " + data);
                    viewTripsCloseToPoint();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS cercanos a un punto");
                })
        }

        // Este metodo genera una capa
        function generateLayer() {
            // Se crea una nueva capa de recorridos con los datos obtenidos.
            vm.layerTripsCloseToPoint = srvLayers.getLayer(null);
            // Se agrega la capa nueva al mapa.
            vm.layerTripsCloseToPoint.setStyle(creatorStyle.getStyleTrip('green', 2));
            vm.map.addLayer(vm.layerTripsCloseToPoint);
        }

        // ************************ EVENTOS ****************************************
        // Se captura el evento de click dentro del mapa.
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if (adminMenu.activeTripFinder()) {
                vm.selectedPoint.longitude = evt.coordinate[0];
                vm.selectedPoint.latitude = evt.coordinate[1];
                vm.isPointCreated = true;
                // actualiza los valores de los componentes de la vista
                vm.$apply();

                // ********************* muestra el punto en el mapa *************************
                var point = creatorFeature.getPoint(vm.selectedPoint.longitude, vm.selectedPoint.latitude);
                temporalLayer.getSource().clear();
                temporalLayer.getSource().addFeature(point);
            }
        });

        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuTripFinder', function(isOpen) {
            if (isOpen) {
                console.log('El menu de FINDER TRIPS esta abierto');
                enableEventClick();
            } else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                temporalLayer.getSource().clear();
            }
        });

        // funcion que habilita el uso de los eventos de este menu
        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveTripFinder(true);
            console.log('Entro a actualizacion de eventos TRIPS_FINDER');
        }
        // ************************ Inicializacion de datos *****************************
        generateLayer();

    } // fin Constructor

})()
