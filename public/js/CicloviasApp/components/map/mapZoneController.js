/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapZoneController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer','adminLayers', MapZoneController]);

    function MapZoneController(vm, creatorMap, srvLayers, dataServer,adminLayers) {

        // ********************* declaracion de variables y metodos *********************
        vm.map = creatorMap.getMap();

        vm.findAllZones = findAllZones;
        vm.selectZone = selectZone;
        vm.toogleZonesLayer = toogleZonesLayer;

        // ************************ inicializacion de datos del mapa ************************
        // **********************************************************************************
        vm.findAllZones();


        // **********************************************************************************
        // ************************ Descripcion de las funciones ************************

        // Busca todas las zonas de la BD
        function findAllZones() {
            dataServer.getZones()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.zonesJson = data;
                    console.log("Datos recuperados prom ZONES con EXITO! = " + data);
                    createLayerZone(vm.zonesJson);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las ZONES");
                })
        }

        //      Generacion de Capa de Zonas a partir del json recibido desde el service
        function createLayerZone(infoZoneJson) {
            vm.zonesLayer = srvLayers.getGroupLayerZones(infoZoneJson);
            vm.map.addLayer(vm.zonesLayer);
            // vm.zonesLayer.setVisible(false);
        }


        vm.selectedAllZones = false;
        // Toogle de capa de zonas
        function toogleZonesLayer() {
          console.log("toogle zones");
            if (vm.selectedAllZones) {
                adminLayers.disableAllZone(vm.zonesLayer);
                vm.selectedAllZones = false;
            } else {
                adminLayers.enableAllZone(vm.zonesLayer);
                vm.selectedAllZones = true;
            }
            angular.forEach(vm.zonesJson, function(zone) {
                zone.selected = vm.selectedAllZones;
            });
        }

        // permite la visualizacion o no de una zona
        function selectZone(nameZone, seleccion) {
            var zoneSelected = adminLayers.findLayerZone(nameZone, vm.zonesLayer);
            if (zoneSelected == null) {
                console.log("ERROR: la zona " + nameZone + " no se encuentra disponible.");
            }
            console.log("Zona seleccionada: " + nameZone);

            console.log("MODEL selected: " + seleccion);
            zoneSelected.setVisible(seleccion);
        }

    } // fin Constructor

})()
