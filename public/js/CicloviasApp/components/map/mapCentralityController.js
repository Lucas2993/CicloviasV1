/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapCentralityController', ['$scope', 'creatorMap', 'srvLayers','srvLayersCentrality', 'dataServer', MapCentralityController]);

    function MapCentralityController(vm, creatorMap, srvLayers,srvLayersCentrality, dataServer) {

        // ********************* declaracion de variables y metodos *********************
        // vm.centralitiesJson = [];
        vm.checkboxModel;

        vm.findAllCentralities = findAllCentralities;

        vm.toogleCentralitiesLayer = toogleCentralitiesLayer;

        vm.checkboxModel = {
            centralitiesValue: false,
        };

        // var generateCentralitiesPoints;
        // var createLayerZone;

        // ************************ inicializacion de datos del mapa ************************
        // **********************************************************************************
        vm.findAllCentralities();

        // **********************************************************************************
        // ************************ Descripcion de las funciones ************************

        // Busca todas las centralidades de la BD
        function findAllCentralities() {
            dataServer.getCentralities()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    // vm.centralitiesJson = data;
                    srvLayersCentrality.setCentralities(data);
                    // console.log("Datos recuperados con EXITO! = " + data);
                    // generateCentralitiesPoints(vm.centralitiesJson);
                    generateCentralitiesPoints(srvLayersCentrality.getCentralities());
                    vm.centralitiesJson = srvLayersCentrality.getCentralities();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las CENTRALIDADES");
                })
        }

        //      Generacion de Capa de Centralidades a partir del json recibido desde el service
        function generateCentralitiesPoints(centralitiesJson) {
            // Se crea y agrega la capa de Centralidades al mapa
            creatorMap.getMap();
            // vm.centralitiesLayer = srvLayers.getLayerMarker(centralitiesJson);
            vm.centralitiesLayer = srvLayers.getLayerMarker(srvLayersCentrality.getCentralities());
            creatorMap.addLayer(vm.centralitiesLayer);
            // vm.map.addLayer(vm.centralitiesLayer);
            vm.centralitiesLayer.setVisible(false);
        }

        // Toogle de capa de centralidades
        function toogleCentralitiesLayer() {
            if (vm.centralitiesLayer.getVisible()) {
                vm.centralitiesLayer.setVisible(false);
            } else {
                vm.centralitiesLayer.setVisible(true);
            }
        }

        // display popup on click
        creatorMap.getMap().on('click', function(evt) {
            var feature = creatorMap.getMap().forEachFeatureAtPixel(evt.pixel,
                function(feature) {
                    var coordinates = feature.getGeometry().getCoordinates();
                    console.log(coordinates);
                    var popup = new ol.Overlay.Popup({
                        insertFirst: true
                    });
                    creatorMap.getMap().addOverlay(popup);

                    popup.show(evt.coordinate, feature.get('object').name);
                    return feature;
                });
        });

    } // fin Constructor

})()
