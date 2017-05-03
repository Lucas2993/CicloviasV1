/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('MapController', ['$scope', 'creatorMap','srvLayers','dataServer', MapController]);
        function MapController(vm, creatorMap, srvLayers, dataServer) {

         // ********************* declaracion de variables y metodos *********************
         vm.map = creatorMap.getMap();

         vm.centralitiesJson = [];
         vm.checkboxModel;

        vm.findAllCentralities = findAllCentralities;
        vm.findAllZones = findAllZones;

        vm.toogleCentralitiesLayer = toogleCentralitiesLayer;
        vm.toogleZonesLayer = toogleZonesLayer;

        vm.checkboxModel = {
            centralitiesValue: false,
            zonesValue : false
        };

        var generateCentralitiesPoints;
        var createLayerZone;

        // ************************ inicializacion de datos del mapa ************************
        // **********************************************************************************
        vm.findAllCentralities();
        vm.findAllZones();

        // **********************************************************************************

        // ************************ Descripcion de las funciones ************************

         // Busca todas las centralidades de la BD
        function findAllCentralities() {
                dataServer.getCentralities()
                    .then(function(data) {
                        // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                        vm.centralitiesJson = data;
                        console.log("Datos recuperados con EXITO! = "+data);
                        generateCentralitiesPoints(vm.centralitiesJson);
                    })
                    .catch(function(err) {
                        console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las CENTRALIDADES");
                    })
         }
         // Busca todas las zonas de la BD
        function findAllZones() {
            dataServer.getZones()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.zonesJson = data;
                    console.log("Datos recuperados prom ZONES con EXITO! = "+data);
                    createLayerZone(vm.zonesJson);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las ZONES");
                })
         }

 //      Generacion de Capa de Centralidades a partir del json recibido desde el service
        function generateCentralitiesPoints(centralitiesJson) {
            // Se crea y agrega la capa de Centralidades al mapa
            vm.centralitiesLayer = srvLayers.getLayerMarker(centralitiesJson);
             vm.map.addLayer(vm.centralitiesLayer);
             vm.centralitiesLayer.setVisible(false);
         }

//      Generacion de Capa de Zonas a partir del json recibido desde el service
        function createLayerZone(infoZoneJson) {
            // vm.zonesLayer = srvLayers.getLayerZones(infoZoneJson);
            vm.zonesLayer = srvLayers.getGroupLayerZones(infoZoneJson);
            vm.map.addLayer(vm.zonesLayer);
            vm.zonesLayer.setVisible(false);
          }


        // Toogle de capa de centralidades
        function toogleCentralitiesLayer() {
              if (vm.centralitiesLayer.getVisible()) {
                  vm.centralitiesLayer.setVisible(false);
              } else {
                  vm.centralitiesLayer.setVisible(true);
              }
        }

        // Toogle de capa de zonas
        function toogleZonesLayer() {
            if (vm.zonesLayer.getVisible()) {
                vm.zonesLayer.setVisible(false);
            } else {
                vm.zonesLayer.setVisible(true);
            }
        }

    } // fin Constructor
})()
