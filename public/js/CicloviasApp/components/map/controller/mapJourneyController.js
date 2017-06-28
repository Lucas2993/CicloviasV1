// Responsabilidad : Mostrar los trayectos
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapJourneyController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'srvViewJourney',
            'dataServer',
            'adminLayers',
            'srvModelJourney',
            'adminMenu',
            MapJourneyController
        ]);

    function MapJourneyController(vm, creatorMap, srvLayers, srvViewJourney, dataServer, adminLayers, srvModelJourney,adminMenu) {

        // ********************************** VARIABLES PUBLICAS ************************
        vm.map = creatorMap.getMap();

        vm.selectJourney = false;

        vm.selectAllJourney = false;

        vm.journeyJson = [];

        vm.journeyLayer;

        vm.pageSize = 5,
            vm.currentPage = 1;
        vm.totalItems = vm.journeyJson.length;


        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************

        // muestra o no todos los recorridos (segun el estado del checkbox)
        vm.checkAllJourneys = checkAllJourneys;
        // permite la visualizacion o no de un recorrido
        vm.selectJourney = selectJourney;
        // Permite borrar capa de trayectos
        vm.resetLayer = resetLayer;

        // ****************************** FUNCIONES PUBLICAS ****************************


        function checkAllJourneys() {
            if(srvModelJourney.getJourneysLayer() != null ){
                vm.selectAllJourney = srvViewJourney.toogleAll(vm.selectAllJourney, srvModelJourney.getJourneys(), srvModelJourney.getJourneysLayer());
            }


        }

        function selectJourney(journey) {
            srvViewJourney.viewJourney(journey, vm.journeyLayer);
        }

        function resetLayer() {
            if(srvModelJourney.getJourneysLayer() != null ){
                vm.selectAllJourney = srvViewJourney.toogleAll(true, srvModelJourney.getJourneys(), srvModelJourney.getJourneysLayer());
                vm.selectAllJourney = false;
            }
        }


        // ****************************** FUNCIONES PRIVADAS ****************************
        // Busca todas los trayectos de la BD
        function findAllJourney() {
            if (!srvModelJourney.isJourneysWanted()) {
                dataServer.getJourneys()
                    .then(function(data) {
                        // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                        vm.journeyJson = data;
                        vm.totalItems = vm.journeyJson.length;
                        srvModelJourney.setJourneys(vm.journeyJson);
                        srvModelJourney.setJourneysWanted(true);
                        console.log("Datos recuperados prom JOURNEY con EXITO! = " + data.length);
                    })
                    .catch(function(err) {
                        console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                    })
            }
        }

        function generateLayer() {
            vm.journeyLayer = srvLayers.getLayer(null);
            srvModelJourney.setJourneysLayer(vm.journeyLayer);
            vm.map.addLayer(vm.journeyLayer);
        }

        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuJourney', function(isOpen) {
            if (isOpen) {
                console.log('El menu de ROADS esta abierto');
                enableEventClick();
            } else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                // vm.tripLayer.getSource().clear();
                console.log('El menu de ROADS esta cerrado');
                vm.resetLayer();

            }
        });

        // funcion que habilita el uso de los eventos de este menu
        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveJourneys(true);
        }



        // ************************ inicializacion de datos del mapa ************************
        generateLayer();
        findAllJourney();



    } // fin Constructor

})()
