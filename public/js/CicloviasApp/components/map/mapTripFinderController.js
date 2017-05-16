/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripFinderController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality', 'dataServer','adminLayers', 'serviceTrip', 'adminTrip', MapTripFinderController]);

    function MapTripFinderController(vm, creatorMap, srvLayers, srvLayersCentrality, dataServer,adminLayers,  serviceTrip, adminTrip) {

        // ********************* declaracion de variables y metodos *********************

        vm.map = creatorMap.getMap();

        // ******************************************************************************************
        // ****************************** capa de trayectos *****************************************
        vm.getTripsCloseToSelectedPoint = getTripsCloseToSelectedPoint;
        vm.viewTripsCloseToPoint = viewTripsCloseToPoint;
        vm.resetLayerCloseToPoint = resetLayerCloseToPoint;

        // function viewLayerTrips(){
        //     adminLayers.viewLayerTrips(vm.layerTrips);
        // }

        vm.selectedPoint = {
            latitude: '0',
            longitude: '0'
        };

        // Cuando el usuario quiere crear una nueva centralidad de ajustan las banderas y se inicializa la centralidad.

        // ******************************************************************************************
        // ****************************** Recorridos cerca de un punto ******************************

        // Se construye un modelo para capturar todos los puntos


        // Este metodo se encarga de obtener todos los recorridos cercanos a un
        // punto seleccionado y agregarlos en una capa.
        function getTripsCloseToSelectedPoint() {
            console.log("select to point: " + vm.selectedPoint);
            console.log(vm.selectedPoint);
            dataServer.getTripsCloseToPoint(vm.selectedPoint)
                .then(function(data) {
                    vm.tripsclosetopointJson = data;
                    console.log("Datos recuperados prom TRIPS cercanos a un punto con EXITO! = " + data);
                    // Se establece que la capa de recorridos cercanos a un punto no se mostrara (valor del checkbox).
                    vm.selectTripCloseToPoint.checkbox = false;
                    // Si la capa ya fue creada anteriormente se la elimina para poder crear una nueva actualizada.
                    if (vm.isLayerCloseToPointCreated) {
                        vm.map.removeLayer(vm.layerTripsCloseToPoint);
                        vm.isLayerCloseToPointCreated = false;
                    }
                    // Se crea una nueva capa de recorridos con los datos obtenidos.
                    // vm.layerTripsCloseToPoint = srvLayers.getLayerTrips(vm.tripsclosetopointJson);
                    vm.layerTripsCloseToPoint = srvLayers.getLayerTripsOld(vm.tripsclosetopointJson);
                    // Se indica que una nueva capa de recorridos cercanos a un punto se ha creado.
                    vm.isLayerCloseToPointCreated = true;
                    // Se agrega la capa nueva al mapa.
                    vm.map.addLayer(vm.layerTripsCloseToPoint);
                    // Se establce que la capa de recorridos cercanos a un punto se mostrara (valor del checkbox).
                    vm.selectTripCloseToPoint.checkbox = true;
                    // Se muestra la nueva capa.
                    vm.viewTripsCloseToPoint();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS cercanos a un punto");
                })
        }

        // Este metodo se encarga de mostrar la capa de recorridos cercanos a un punto (si existe).
        function viewTripsCloseToPoint() {
            // Se comprueba que la capa existe.
            if (vm.isLayerCloseToPointCreated) {
                // Se hace visible la capa.
                adminLayers.viewLayer(vm.layerTripsCloseToPoint);
                // console.log(" capa de punto visible: "+vm.layerTripsCloseToPoint.getVisible());
                vm.layerTripsCloseToPoint.setVisible(vm.selectTripCloseToPoint.checkbox);
                // console.log(" capa de punto visible: "+vm.layerTripsCloseToPoint.getVisible());
            }
        }

        // Modelo para usar con el checkbox (es necesario declararlo asi).
        vm.selectTripCloseToPoint = {
            checkbox: false
        }

        // Bandera que indica si la capa de recorridos cercanos a un punto esta creada.
        vm.isLayerCloseToPointCreated = false;

        // Este metodo resetea todo lo relacionado con los recorridos cercanos a un punto.
        function resetLayerCloseToPoint() {
            // Si la capa esta creada, es removida.
            if (vm.isLayerCloseToPointCreated) {
                // Se remueve la capa del mapa.
                vm.map.removeLayer(vm.layerTripsCloseToPoint);
            }
            // Se indica que la capa ya no existe.
            vm.isLayerCloseToPointCreated = false;
            // Se desmarca el checkbox.
            vm.selectTripCloseToPoint.checkbox = false;
            // Se reinicia el punto seleccionado.
            vm.selectedPoint = {
                latitude: '0',
                longitude: '0'
            };
        }

        // Se captura el evento de click dentro del mapa.
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            vm.callbackMarkersOnClick(evt.pixel);

            var coordinate = evt.coordinate;

            vm.selectedPoint.longitude = coordinate[0];
            vm.selectedPoint.latitude = coordinate[1];

            // Si estoy creando o editando una centralidad se obtienen las coordenadas donde se efectuo el click.
            var coordinate = evt.coordinate;
            if (vm.isSelecting || vm.isEditing) {
                vm.newCentrality.longitude = coordinate[0];
                vm.newCentrality.latitude = coordinate[1];
                console.log('Selected point: ' + coordinate);
            }
            vm.$apply();

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
            // vm.centralityEdit();
            vm.newCentrality = point.get('object');
            vm.$apply();
        }


    } // fin Constructor

  })()
