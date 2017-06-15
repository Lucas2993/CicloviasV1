// Responsabilidad: Controlar el modulo de zonas, permite solo visualizar las zonas
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapZoneController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'dataServer',
            'adminLayers',
            'srvViewZone',
            'srvModelZone',
            MapZoneController
        ]);

    function MapZoneController(vm, creatorMap, srvLayers, dataServer, adminLayers,srvViewZone,srvModelZone) {

        // ********************* declaracion de variables y metodos *********************
        vm.map = creatorMap.getMap();

        vm.findAllZones = findAllZones;
        vm.selectZone = selectZone;
        vm.toogleZonesLayer = toogleZonesLayer;


        // **********************************************************************************
        // ************************ Descripcion de las funciones ************************

        // Busca todas las zonas de la BD
        function findAllZones() {
            dataServer.getZones()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.zonesJson = data;
                    console.log("Datos recuperados prom ZONES con EXITO! = " + data);
                    srvModelZone.setZones(vm.zonesJson);
                    srvModelZone.setZonesLayer(vm.zonesLayer);
                    console.log("srv.getZone : "+ srvModelZone.getZones());
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las ZONES");
                })
        }

        //      Generacion de Capa de Zonas a partir del json recibido desde el service
        function createLayerZone(infoZoneJson) {

            // vm.zonesLayer = srvLayers.getGroupLayerZones(infoZoneJson);
            // vm.map.addLayer(vm.zonesLayer);
            // vm.zonesLayer.setVisible(false);
            vm.zonesLayer = srvLayers.getLayer(null); //TODO a refactorizar
            vm.map.addLayer(vm.zonesLayer);

        }


        vm.selectedAllZones = false;
        // Toogle de capa de zonas
        function toogleZonesLayer() {
            console.log("toogle zones");
            if (vm.selectedAllZones) {
                vm.selectedAllZones = false;
                vm.zonesLayer.getSource().clear();
            } else {
                vm.selectedAllZones = true;
                srvViewZone.addZones(vm.zonesJson, vm.zonesLayer);
            }

            angular.forEach(vm.zonesJson, function(zone) {
                zone.selected = vm.selectedAllZones;
            });

        }

        // permite la visualizacion o no de una zona
        function selectZone(nameZone, zone) {
            srvViewZone.viewZone(zone, vm.zonesLayer);
        }


        // ************************ inicializacion de datos del mapa ************************
        // **********************************************************************************
        createLayerZone(vm.zonesJson);
        vm.findAllZones();

    } // fin Constructor

})()
