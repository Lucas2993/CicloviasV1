// Responsabilidad : Mostrar los trayectos
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapRoadController', [
            '$scope',
            'creatorMap',
            'adminMenu',
            'srvLayers',
            'srvViewRoad',
            'dataServer',
            'adminLayers',
            'srvModelRoad',
            'creatorFeature',
            'creatorStyle',
            'srvModelPointsOfLineString',
            'srvViewPointsOfLineString',
            MapRoadController
        ]);

    function MapRoadController(vm, creatorMap, adminMenu, srvLayers, srvViewRoad, dataServer, adminLayers, srvModelRoad, creatorFeature, creatorStyle, srvModelPointsOfLineString, srvViewPointsOfLineString) {

        // ********************************** VARIABLES PUBLICAS ************************
        vm.map = creatorMap.getMap();

        vm.selectRoad = false;

        vm.selectAllRoad = false;

        vm.roadJson = [];

        vm.roadLayer;

        vm.pageSize = 10,
            vm.currentPage = 1;
        vm.totalItems = vm.roadJson.length;

        // puntos que conforman el recorrido a crear.
        vm.pointList = [];
        // lista de coordenadas de las calles que estan en la visual
        vm.coordinatesList;
        // layer de puntos de las calles visibles
        vm.pointsLayer;
        // indica si se puede tener en cuenta los eventos en el mapa
        vm.isPointSelecteds = false;
        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************

        // muestra o no todos los recorridos (segun el estado del checkbox)
        vm.checkAllRoads = checkAllRoads;
        // permite la visualizacion o no de un recorrido
        vm.selectRoad = selectRoad;

        // reinicia los datos del menu
        vm.resetLayerRoad = resetLayerRoad;

        // Envia los puntos que conforman un recorrido al servidor.
        vm.sendTrip = sendTrip;
        // ************************FLAGS PUBLICAS ***************************************

        // Permite ver los puntos de las calles seleccionados
        vm.viewRoadData = viewRoadData;

        // ****************************** FUNCIONES PUBLICAS ****************************

        function checkAllRoads() {
            if (srvModelRoad.getRoadsLayer() != null) {
                vm.selectAllRoad = srvViewRoad.toogleAll(vm.selectAllRoad, srvModelRoad.getRoads(), srvModelRoad.getRoadsLayer());
            }

        }

        function selectRoad(road) {
            srvViewRoad.viewRoad(road, vm.roadLayer);
        }

        function resetLayerRoad() {
            // vm.searchText.clear();
            vm.isPointSelecteds = false;
            vm.pointList
            vm.pointsLayer.getSource().clear();
            if (srvModelRoad.getRoadsLayer() != null) {
                vm.selectAllRoad = srvViewRoad.toogleAll(true, srvModelRoad.getRoads(), srvModelRoad.getRoadsLayer());
            }
        }

        // Permite ver los puntos de las calles seleccionados
        function viewRoadData() {
            vm.pointsLayer.getSource().clear();
            vm.coordinatesList = srvModelPointsOfLineString.getCoordinatesPointsOfLayer(vm.roadLayer);
            srvViewPointsOfLineString.addAll(vm.coordinatesList, vm.pointsLayer);
            vm.isPointSelecteds = true;
        }

        // ****************************** FUNCIONES PRIVADAS ****************************
        // Busca todas los trayectos de la BD
        function findAllRoad() {
            if (!srvModelRoad.isRoadsWanted()) {
                dataServer.getRoads()
                    .then(function(data) {
                        // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                        vm.roadJson = data;
                        vm.totalItems = vm.roadJson.length;
                        srvModelRoad.setRoads(vm.roadJson);
                        srvModelRoad.setRoadsWanted(true);
                        console.log("Datos recuperados prom JOURNEY con EXITO! = " + data.length);
                    })
                    .catch(function(err) {
                        console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                    })
            }
        }

        function generateLayer() {
            vm.roadLayer = srvLayers.getLayer(null);
            srvModelRoad.setRoadsLayer(vm.roadLayer);
            vm.map.addLayer(vm.roadLayer);

            vm.pointsLayer = srvLayers.getLayer(null);
            vm.map.addLayer(vm.pointsLayer);

        }

        // ************************ inicializacion de datos del mapa ************************
        generateLayer();
        findAllRoad();




        // Se captura el evento dentro del mapa.
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if (adminMenu.activeRoads() && vm.isPointSelecteds) {
                console.log("Se hizo click en el mapa.");
                // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
                callbackZonesOnClick(evt.pixel);
            }
        });

        // Modificacion y borrado de una centralidad.
        function callbackZonesOnClick(pixel) {
            // Determina que elemento se clickeo (indicador de centralidad).
            vm.map.forEachFeatureAtPixel(pixel, function(feature, layer) {
                // Se obtienen los datos de coordenadas del indicador y se busca si corresponde a una centralidad.
                // Si es un punto lo agrega a la lista de puntos de un recorrido
                if (feature.getId() > 100000) {
                    feature.setStyle(creatorStyle.getStylePoint(5, 'red', 'blue'));
                    console.log(feature.getGeometry().getCoordinates());
                    vm.pointList.push(feature.getGeometry().getCoordinates());
                }
            })
        }


        // Guarda una centralidad en la BD
        function sendTrip() {
            var resultado = {};
            resultado.points = vm.pointList;
            console.log(resultado);

            dataServer.saveTrip(resultado)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    alert('Se guardó correctamente el recorrido: ' + data.id)
                    console.log(data);
                    // srvModelCentrality.getCentralities().push(data);
                    // data.selected = true;
                    // srvViewCentrality.viewCentrality(data, srvModelCentrality.getCentralitiesLayer());
                    // vm.$apply();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al guardar centrality");
                });
            // vm.centralityCancel();
        }






        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuRoad', function(isOpen) {
            if (isOpen) {
                console.log('El menu de ROADS esta abierto');
                enableEventClick();
            } else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                // vm.tripLayer.getSource().clear();
                console.log('El menu de ROADS esta cerrado');
                vm.resetLayerRoad();

            }
        });

        // funcion que habilita el uso de los eventos de este menu
        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveRoads(true);
        }



    } // fin Constructor

})()
