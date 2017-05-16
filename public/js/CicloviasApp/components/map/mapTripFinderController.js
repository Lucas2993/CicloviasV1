/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripFinderController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality', 'dataServer','adminLayers', 'serviceTrip', 'adminTrip', 'adminMenu', MapTripFinderController]);

    function MapTripFinderController(vm, creatorMap, srvLayers, srvLayersCentrality, dataServer,adminLayers,  serviceTrip, adminTrip, adminMenu) {

        // ********************* declaracion de variables y metodos *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************

        vm.map = creatorMap.getMap();

        // ******************************************************************************************
        // ****************************** capa de trayectos *****************************************
        vm.getTripsCloseToSelectedPoint = getTripsCloseToSelectedPoint;
        vm.viewTripsCloseToPoint = viewTripsCloseToPoint;
        vm.resetLayerCloseToPoint = resetLayerCloseToPoint;

        // ===============>>>>>> FLAGS <<<<<===============
        // bandera que indica si el menu se encuentra abierto o cerrado
        vm.openMenuTripFinder = false;

        vm.selectedPoint = {
            latitude: '0',
            longitude: '0'
        };

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PRIVADO ***********************************
        // funcion que habilita el uso de los eventos de este menu
        var enableEventClick;

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
                    vm.layerTripsCloseToPoint = srvLayers.getLayerTripsFinder(vm.tripsclosetopointJson);
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
            // borra el punto de seleccion, si es q lo hay
            temporalLayer.getSource().clear();
        }

        // **************************** Entrando al menu *********************************

          var temporalLayer = srvLayers.getTemporalLayer();
          temporalLayer.setMap(vm.map);
          temporalLayer.getSource().on( 'addfeature', function (ft) {
              // ft - feature being added
              console.log("## Se mostro el punto en el mapa ##");
          });

        // *******************************************************************************

        // Se captura el evento de click dentro del mapa.
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if(adminMenu.activeTripFinder()){
                vm.selectedPoint.longitude = evt.coordinate[0];
                vm.selectedPoint.latitude = evt.coordinate[1];
                // actualiza los valores de los componentes de la vista
                vm.$apply();

                // ********************* muestra el punto en el mapa *************************
                var point = new ol.Feature({
                          geometry: new ol.geom.Point([vm.selectedPoint.longitude, vm.selectedPoint.latitude])
                      });
                temporalLayer.getSource().clear();
                temporalLayer.getSource().addFeature(point);
            }
        });

        // *******************************************************************************
        // **************************** Entrando al menu *********************************

        function enableEventClick(){
            adminMenu.disableAll();
            adminMenu.setActiveTripFinder(true);
            console.log('Entro a actualizacion de eventos TRIPS_FINDER');
        }

        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuTripFinder', function(isOpen){
            if (isOpen) {
                console.log('El menu de FINDER TRIPS esta abierto');
                enableEventClick();
            }
            else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                temporalLayer.getSource().clear();
            }
        });

    } // fin Constructor

})()
