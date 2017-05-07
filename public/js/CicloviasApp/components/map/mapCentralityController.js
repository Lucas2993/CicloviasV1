/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapCentralityController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality', 'dataServer', 'adminLayers', MapCentralityController]);

    function MapCentralityController(vm, creatorMap, srvLayers, srvLayersCentrality, dataServer, adminLayers) {

        // ********************* declaracion de variables ***********************************
        // Mapa
        vm.map = creatorMap.getMap();

        // Lista de centralidades
        vm.centralitiesJson = [];
        // Indica si todas las centralidades han si selecionadas
        vm.selectedAllCentralities = false;

        // ********************* declaracion de metodos *************************************

        vm.findAllCentralities = findAllCentralities;
        vm.selectCentrality = selectCentrality;
        vm.checkAllCentralities = checkAllCentralities;
        vm.getCentralities = getCentralities;

        // ************************ inicializacion de centralidades *************************
        // **********************************************************************************

        vm.findAllCentralities();

        // **********************************************************************************
        // ************************ Descripcion de las funciones ****************************

        // Busca todas las centralidades en la BD
        function findAllCentralities() {
            dataServer.getCentralities()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.centralitiesJson = data;
                    console.log("Datos recuperados con EXITO! = CENTRALIDADES");
                    // Setea las centralidades
                    srvLayersCentrality.setCentralities(vm.centralitiesJson);
                    generateCentralitiesPoints(vm.centralitiesJson);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las CENTRALIDADES");
                })
        } // fin findAllCentralities

        function getCentralities() {
            return srvLayersCentrality.getCentralities();
        }

        // Generacion de Capa de Centralidades a partir del json recibido desde el service
        function generateCentralitiesPoints(centralitiesJson) {
            // Se crea y agrega la capa de Centralidades al mapa
            vm.centralitiesLayer = srvLayers.getLayerMarker(centralitiesJson);
            srvLayersCentrality.setCentralitiesLayer(vm.centralitiesLayer);
            vm.map.addLayer(vm.centralitiesLayer);
        }

        // permite la visualizacion o no de una centralidad
        function selectCentrality(centrality) {
            adminLayers.viewCentrality(centrality, vm.centralitiesLayer);
        }

        // Agrega o Borra TODAS las centralidades al mapa, Al hacer click en Ver todo
        function checkAllCentralities() {
            if (vm.selectedAllCentralities) {
                vm.selectedAllCentralities = false;
                vm.centralitiesLayer.getSource().clear();
            } else {
                vm.selectedAllCentralities = true;
                adminLayers.addCentralities(vm.centralitiesJson, vm.centralitiesLayer);
            }

            angular.forEach(vm.centralitiesJson, function(centrality) {
                centrality.selected = vm.selectedAllCentralities;
            });
        } //fin checkAllCentralities


        var popup = null;
        vm.map.on('click', function(evt) {
            var feature = vm.map.forEachFeatureAtPixel(evt.pixel,
                function(feature) {
                    if (popup != null) {
                        console.log("entra");
                        // popup.closer.blur();
                        popup.container.style.display = 'none';
                    }
                    var coordinates = feature.getGeometry().getCoordinates();
                    popup = new ol.Overlay.Popup({
                        // insertFirst: false
                    });
                    vm.map.addOverlay(popup);
                    popup.show(evt.coordinate, feature.get('object').name);


                    // console.log( feature.get('object').name);

                    setTimeout(function() {
                        popup.container.style.display = 'none';
                        popup = null;
                    }, 3000);

                    return feature;
                });
            // console.log( feature.get('object').name);
            // console.log(id);
            // newCentrality.name = feature.get('object').name;
        });


    } // fin Constructor




})()
