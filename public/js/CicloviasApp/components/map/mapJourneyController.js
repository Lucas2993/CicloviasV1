/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapJourneyController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality', 'dataServer', 'adminLayers', MapJourneyController]);

    function MapJourneyController(vm, creatorMap, srvLayers, srvLayersCentrality, dataServer, adminLayers) {

        // ********************* declaracion de variables y metodos *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************

        vm.map = creatorMap.getMap();

        vm.findAllJourney = findAllJourney;


        // ************************ inicializacion de datos del mapa ************************
        // **********************************************************************************
        vm.findAllJourney();

        // **********************************************************************************
        // ************************ Descripcion de las funciones ************************

        // Busca todas los trayectos de la BD
        function findAllJourney() {
            dataServer.getJourneys()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.journiesJson = data;
                    console.log("Datos recuperados prom JOURNEY con EXITO! = " + data);
                    // proceso y genracion de capa de recorridos
                    vm.layerJournies = srvLayers.getLayerJourney(vm.journiesJson);
                    vm.map.addLayer(vm.layerJournies);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
        }

        vm.viewLayerJournies = viewLayerJournies;

        function viewLayerJournies() {
            adminLayers.viewLayer(vm.layerJournies);
        }




    } // fin Constructor

})()
