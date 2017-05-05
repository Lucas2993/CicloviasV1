/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        // .controller('MapController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer', 'adminLayers', MapController]);
    // .controller('MapController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer', 'adminLayers', MapController]);
    //
    // function MapController(vm, creatorMap, srvLayers, dataServer, adminLayers) {
    .controller('MapController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer', 'adminLayers', 'serviceTrip', 'adminTrip', MapController]);

    function MapController(vm, creatorMap, srvLayers, dataServer, adminLayers, serviceTrip, adminTrip) {

        // ********************* declaracion de variables y metodos *********************
        vm.map = creatorMap.getMap();

        vm.centralitiesJson = [];
        vm.checkboxModel;

        vm.findAllCentralities = findAllCentralities;
        vm.findAllZones = findAllZones;
        vm.findAllTrips = findAllTrips;
        vm.findAllJourney = findAllJourney;

        vm.toogleCentralitiesLayer = toogleCentralitiesLayer;
        vm.toogleZonesLayer = toogleZonesLayer;

        // ********************************** NUEVO *******************************
        vm.selectZone = selectZone;
        vm.selectCentrality = selectCentrality;

        vm.checkAll = checkAll;

        vm.checkboxModel = {
            value: false,

        };

        var generateCentralitiesPoints;
        var createLayerZone;
        var createLayerTrip;

        // ************************ inicializacion de datos del mapa ************************
        // **********************************************************************************
        vm.findAllCentralities();
        vm.findAllZones();
        vm.findAllTrips();
        vm.findAllJourney();

        // **********************************************************************************
        // ************************ Descripcion de las funciones ************************

        // Busca todas las centralidades de la BD
        function findAllCentralities() {
            dataServer.getCentralities()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.centralitiesJson = data;
                    console.log("Datos recuperados con EXITO! = " + data);
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
                    console.log("Datos recuperados prom ZONES con EXITO! = " + data);
                    createLayerZone(vm.zonesJson);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las ZONES");
                })
        }

        // Busca todas los recorridos de la BD
        function findAllTrips() {
            dataServer.getTrips()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsJson = data;
                    console.log("Datos recuperados prom TRIPS con EXITO! = " + data);
                    // proceso y genracion de capa de recorridos
                    vm.layerTrips = srvLayers.getLayerTrips(vm.tripsJson);
                    vm.map.addLayer(vm.layerTrips);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
        }

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

        //      Generacion de Capa de Centralidades a partir del json recibido desde el service
        function generateCentralitiesPoints(centralitiesJson) {
            // Se crea y agrega la capa de Centralidades al mapa
            vm.centralitiesLayer = srvLayers.getLayerMarker(centralitiesJson);
            vm.centralitiesLayerTest = srvLayers.getLayerMarker(centralitiesJson);

            vm.map.addLayer(vm.centralitiesLayer);
            vm.map.addLayer(vm.centralitiesLayerTest);

            vm.centralitiesLayer.setVisible(true);
        }

        //      Generacion de Capa de Zonas a partir del json recibido desde el service
        function createLayerZone(infoZoneJson) {
            vm.zonesLayer = srvLayers.getGroupLayerZones(infoZoneJson);
            vm.map.addLayer(vm.zonesLayer);
            // vm.zonesLayer.setVisible(false);
        }

        // Toogle de capa de centralidades
        function toogleCentralitiesLayer() {
            adminLayers.viewLayer(vm.centralitiesLayer);
        }

        vm.selectedAllZones = false;
        // Toogle de capa de zonas
        function toogleZonesLayer() {
            // adminLayers.viewLayer(vm.zonesLayer);
            // for (var i = 0; i < array.length; i++) {
            //     array[i]
            // }
            if(vm.selectedAllZones){
                adminLayers.disableAllZone(vm.zonesLayer);
                vm.selectedAllZones = false;
            }
            else{
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

            console.log("MODEL selected: "+seleccion);
            zoneSelected.setVisible(seleccion);
        }

        // permite la visualizacion o no de una centralidad
        function selectCentrality(centrality) {
            var centralitySelected = adminLayers.viewCentrality(centrality, vm.centralitiesLayer);
            if (centralitySelected == null) {
                console.log("ERROR: la centralidad " + centrality + " no se encuentra disponible.");
            }

        }
        vm.selectedAll = false;

        function checkAll() {
            if (vm.selectedAll) {
                vm.selectedAll = false;
                vm.centralitiesLayer.getSource().clear();
            } else {
                vm.selectedAll = true;
                adminLayers.addCentralities(vm.centralitiesJson, vm.centralitiesLayer);
            }

            angular.forEach(vm.centralitiesJson, function(centrality) {
                centrality.selected = vm.selectedAll;
            });
        }

        // ****************************** Lucas y ema ***************************************
        // **********************************************************************************
        // display popup on click
        vm.map.on('click', function(evt) {
            var feature = vm.map.forEachFeatureAtPixel(evt.pixel,
                function(feature) {
                    var coordinates = feature.getGeometry().getCoordinates();
                    var popup = new ol.Overlay.Popup({
                        // insertFirst: false
                    });
                    vm.map.addOverlay(popup);

                    popup.show(evt.coordinate, feature.get('object').name);
                    return feature;
                });
        });

        // Lucas
        // Aca empieza lo que agregue para el ABM de centralidades.
        // Incorporacion de agregar centralidad
        // Esta bandera se usa para saber si el usuario se encuentra seleccionando un punto para una nueva centralidad.
        vm.isSelecting = false;

        // Modelo de una nueva centralidad (inicializacion).
        vm.newCentrality = {
            name: '',
            location: '',
            latitude: '',
            longitude: ''
        }

        // Cuando el usuario quiere crear una nueva centralidad de ajustan las banderas y se inicializa la centralidad.
        vm.centralitySelection = function() {
            vm.isSelecting = true;
            vm.isEditing = false;
            vm.centralityReset();
        }

        // Cuando se cancela se resetea la centralidad y sus correspondientes banderas.
        vm.centralityCancel = function() {
            vm.isSelecting = false;
            vm.isEditing = false;
            vm.centralityReset();
        }

        // Se inicializa nuevamente la centralidad.
        vm.centralityReset = function() {
            vm.newCentrality = {
                name: '',
                location: '',
                latitude: '',
                longitude: ''
            }
        }


        // Busca todas las zonas de la BD
        vm.centralitySave = function() {
            dataServer.saveCentrality(vm.newCentrality)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    console.log(data);
                    alert('Se guardó correctamente la centralidad: ' + data.id)
                    vm.centralitiesJson.push(data);
                    adminLayers.viewCentrality(data, vm.centralitiesLayer);
                    // vm.$apply();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al guardar centrality");
                });
            vm.centralityCancel();
        }


        // Se captura el evento de click dentro del mapa.
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            vm.callbackMarkersOnClick(evt.pixel);

            // Si estoy creando o editando una centralidad se obtienen las coordenadas donde se efectuo el click.
            if (vm.isSelecting || vm.isEditing) {
                var coordinate = evt.coordinate;
                vm.newCentrality.longitude = coordinate[0];
                vm.newCentrality.latitude = coordinate[1];
                console.log('Selected point: ' + coordinate);
                // Se fuerza la aplicacion de los cambios dentro de angular para refrescar la vista.
                vm.$apply();
            }
            if(vm.isSelecting){

            }
        });

        // Modificacion y borrado de una centralidad.
        vm.callbackMarkersOnClick = function(pixel) {
            // Determina que elemento se clickeo (indicador de centralidad).
            vm.map.forEachFeatureAtPixel(pixel, function(feature, layer) {
                // Se obtienen los datos de coordenadas del indicador y se busca si corresponde a una centralidad.
                vm.searchCentrality(feature);
            })
        }

        //nooooooooooooooooooo

        // Se realiza la busqueda de la centralidad a la que pertenece el punto dado.
        vm.searchCentrality = function(point) {
            vm.centralityEdit();
            vm.newCentrality = point.get('object');
            vm.$apply();
        }

        // Cuando se edita se resetea la centralidad y se establece la bandera de edicion.
        vm.centralityEdit = function() {
            vm.isSelecting = false;
            vm.isEditing = true;
            vm.centralityReset();
        }

        // Bandera para indicar que se esta editando una centralidad.
        vm.isEditing = false;


        vm.centralityDelete = function() {
            dataServer.deleteCentrality(vm.newCentrality.id)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    console.log(data);
                    alert('Se elimino correctamente la centralidad: ' + data);
                    adminLayers.viewCentrality(data, vm.centralitiesLayer);
                    vm.centralitiesJson = vm.centralitiesJson.filter((item) => item.id !== data.id);

                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al guardar centrality");
                });
            vm.centralityCancel();
        }


        function findById(item) {
            return item.id == vm.newCentrality.id;
        }

        vm.centralityUpdate = function() {
            dataServer.updateCentrality(vm.newCentrality)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    console.log(data);
                    alert('Se modifico correctamente la centralidad: ' + data.id);
                    // var cent = vm.centralitiesJson.find(findById);
                    // adminLayers.viewCentrality(cent, vm.centralitiesLayer);
                    vm.centralitiesJson.push(data);
                    adminLayers.viewCentrality(data, vm.centralitiesLayer);
                    adminLayers.viewCentrality(data, vm.centralitiesLayer);
                    // vm.centralitiesJson = vm.centralitiesJson.filter((item) => item.id !== data.id);

                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al guardar centrality");
                });
            vm.centralityCancel();
        }

        // ******************************************************************************************
        // ****************************** capa de trayectos *****************************************
        vm.layerTrips;
        vm.viewLayerTrips = viewLayerTrips;
        vm.selectAllTrips = false;

        function viewLayerTrips(){
            // adminLayers.viewLayer(vm.layerTrips);
            if (vm.selectAllTrips) {
                vm.selectAllTrips = false;
                vm.layerTrips.getSource().clear();
            } else {
                vm.selectAllTrips = true;
                adminLayers.addTrips(vm.tripsJson, vm.layerTrips);
            }

            angular.forEach(vm.tripsJson, function(trip) {
                trip.selected = vm.selectAllTrips;
            });
        }

        vm.selectTrip = selectTrip;

        function selectTrip(trip){
            console.log("entro a la seleccion de recorridos");
            adminTrip.viewTrip(trip, vm.layerTrips);
        }

        vm.viewLayerJournies = viewLayerJournies;
        function viewLayerJournies(){
            adminLayers.viewLayer(vm.layerJournies);
        }

    } // fin Constructor

})()
