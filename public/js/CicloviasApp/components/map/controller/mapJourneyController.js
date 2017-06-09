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

        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************

        vm.viewLayerJournies = viewLayerJournies;

        // ****************************** FUNCIONES PUBLICAS ****************************
        function viewLayerJournies() {
            adminLayers.viewLayer(vm.journiesLayer);
        }

        // ****************************** FUNCIONES PRIVADAS ****************************
        // Busca todas los trayectos de la BD
        function findAllJourney() {
            dataServer.getJourneys()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.journiesJson = data;
                    console.log("Datos recuperados prom JOURNEY con EXITO! = " + data);
                    // proceso y genracion de capa de recorridos
                    // vm.journiesLayer = srvLayers.getLayerJourney(vm.journiesJson);
                    // vm.map.addLayer(vm.journiesLayer);
                    generateLayer();

                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
        }

        function generateLayer() {
            vm.journiesLayer = srvLayers.getLayer(null);
            vm.map.addLayer(vm.journiesLayer);
            srvViewJourney.addJourneys(vm.journiesJson, vm.journiesLayer);

            vm.journiesLayer.setVisible(false);
        }

        // ************************ inicializacion de datos del mapa ************************
        findAllJourney();

    } // fin Constructor

})()
