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
            MapJourneyController
        ]);

    function MapJourneyController(vm, creatorMap, srvLayers, srvViewJourney, dataServer, adminLayers) {

        // ********************************** VARIABLES PUBLICAS ************************
        vm.map = creatorMap.getMap();

        vm.selectJourney = false;

        vm.selectAllJourney = false;

        vm.journeyJson = [];

        vm.journeyLayer;


        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************

        // muestra o no todos los recorridos (segun el estado del checkbox)
        vm.checkAllJourneys = checkAllJourneys;
        // permite la visualizacion o no de un recorrido
        vm.selectJourney = selectJourney;



        // ****************************** FUNCIONES PUBLICAS ****************************


        function checkAllJourneys() {
            if (vm.selectAllJourney) {
                vm.selectAllJourney = false;
                vm.journeyLayer.getSource().clear();
            } else {
                vm.selectAllJourney = true;
                srvViewJourney.addJourneys(vm.journeyJson, vm.journeyLayer);
            }

            angular.forEach(vm.journeyJson, function(journey) {
                journey.selected = vm.selectAllJourney;
            });
            console.log("Ver todos los trayectos: " + vm.selectAllJourney);
        }

        function selectJourney(journey) {
            srvViewJourney.viewJourney(journey, vm.journeyLayer);
        }


        // ****************************** FUNCIONES PRIVADAS ****************************
        // Busca todas los trayectos de la BD
        function findAllJourney() {
            dataServer.getJourneys()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.journeyJson = data;
                    console.log("Datos recuperados prom JOURNEY con EXITO! = " + data);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
        }

        generateLayer();

        function generateLayer() {
            vm.journeyLayer = srvLayers.getLayer(null);
            vm.map.addLayer(vm.journeyLayer);
        }

        // ************************ inicializacion de datos del mapa ************************
        findAllJourney();

    } // fin Constructor

})()
