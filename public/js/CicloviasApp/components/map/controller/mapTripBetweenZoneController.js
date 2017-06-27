// Responsabilidad :Controlar el modulo de recorridos, permite solo visualizar las recorridos
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripBetweenZoneController', [
            '$scope',
            'creatorMap',
            'adminMenu',
            'srvLayers',
            'dataServer',
            'srvModelZone',
            'srvViewZone',
            'adminLayers',
            'srvViewTrip',
            MapTripBetweenZoneController
        ]);

    function MapTripBetweenZoneController(vm, creatorMap, adminMenu, srvLayers, dataServer, srvModelZone, srvViewZone, adminLayers, srvViewTrip) {
        // ********************************** VARIABLES PUBLICAS ************************
        // Mapa
        vm.map = creatorMap.getMap();
        // Lista de recorridos obtenidas del servidor
        vm.tripsJson = [];
        // capa de recorridos
        vm.tripLayer;


        // capa de recorridos
        vm.zonesLayer;
        //Zona seleccionada desde el mapa :  -1 para origen ... 1 para destino
        vm.zoneSelected = 0;

        vm.selectedOrigin = "";
        vm.selectedDestination = "";

        // ********************************** FLAGS PUBLICAS ****************************
        // determina si se quieren ver todos los recorridos o no
        vm.selectedLayer = false;
        // determna el estado de visualizacion del menu
        vm.openMenuTripFinder = false;
        vm.existTripsToShow = false;

        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        // recupera todas las zonas del sistema
        vm.getZones = getZones;
        // recupera los recorridos correspondientes a las zonas seleccionadas
        vm.findTripsBetweenZones = findTripsBetweenZones;
        // permite la visualizacion de los recorridos obtenidos
        vm.viewLayerTripsBetweenZone = viewLayerTripsBetweenZone;
        // agrega los recorridos(features) a la zona
        vm.addTripsBetweenZone = addTripsBetweenZone;
        // limpia la capa que muestra los resultados obtenidos
        vm.resetLayerBetweenZone = resetLayerBetweenZone;
        // muestran las zonas seleccionadas en el mapa
        vm.selectZoneOrigin = selectZoneOrigin;
        vm.selectZoneDestination = selectZoneDestination;
        // Permite seleccionar las zonas desde el mapa
        vm.selectZoneOriginView = selectZoneOriginView ;
        vm.selectZoneDestinationView = selectZoneDestinationView ;


        // metodo utilizado por el typeahead
        function getZones() {
            return srvModelZone.getZones();
        }
        // :Publico
        function findTripsBetweenZones() {
            // if(){
            dataServer.getTripsBetweenZones(vm.selectedOrigin.id, vm.selectedDestination.id)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsJson = data;
                    if (data.length > 0) {
                        vm.existTripsToShow = true;
                    }
                    addTripsBetweenZone();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS");
                })
            // }
        }

        function viewLayerTripsBetweenZone() {
            adminLayers.viewLayer(vm.tripLayer);
        }

        function addTripsBetweenZone() {
            srvViewTrip.addTrips(vm.tripsJson, vm.tripLayer);
        }

        // reinicia el formulario de recorridos entre zonas :Publico
        function resetLayerBetweenZone() {
            console.log("Entro en resetLayerBetweenZone");
            vm.tripLayer.getSource().clear();
            vm.zoneslayer.getSource().clear();
            vm.selectedOrigin = undefined;
            vm.selectedDestination = undefined;
            vm.existTripsToShow = false;
            //  borra todas las zonas obligadamente.
            if(srvModelZone.getZonesLayer() != null ){
              srvViewZone.toogleAllZones(true, srvModelZone.getZones(), srvModelZone.getZonesLayer());
            }

        }

        // Muesta la zona de origen en el mapa :Publico
        function selectZoneOrigin() {
            selectZone(vm.selectedOrigin, vm.selectedDestination, 'green', 'red');
        }
        // Muesta la zona de destino en el mapa :Publico
        function selectZoneDestination() {
            selectZone(vm.selectedDestination, vm.selectedOrigin, 'red', 'green');
        }

        // Permite seleccionar zona de origen desde la grafica :Publico
        function selectZoneOriginView(){
          vm.zoneSelected = -1;
          activeZonesLayer();
        }
        // Permite seleccionar zona de destino desde la grafica :Publico
        function selectZoneDestinationView(){
          vm.zoneSelected = 1;
          activeZonesLayer();
        }

        // ****************************** FUNCIONES PRIVADAS ****************************
        // Toogle de capa de zonas, en realidad solo las muestras a tener el FALSE
        function activeZonesLayer() {
            vm.selectedAllZones = srvViewZone.toogleAllZones(false, srvModelZone.getZones(), srvModelZone.getZonesLayer());
        }

        // crea las capas donde se reflejan los datos (capa de zonas, capa de recorridos)
        function generateLayer() {
            console.log("Tomo los cambios 8.\n");
            vm.tripLayer = srvLayers.getLayer(null);
            vm.zoneslayer = srvLayers.getLayer(null);
            vm.map.addLayer(vm.tripLayer);
            vm.map.addLayer(vm.zoneslayer);
        }

        // permite la visualizacion de las zona seleccionadas
        function selectZone(selectedZone, otherZone, color, otherColor) {
            // console.log(selectedZone);
            vm.tripLayer.getSource().clear();
            vm.zoneslayer.getSource().clear();
            if (otherZone != null) {
                srvViewZone.addZone(otherZone, vm.zoneslayer, otherColor);
            }
            srvViewZone.addZone(selectedZone, vm.zoneslayer, color);
        }

        // ************************ EVENTOS ****************************************

        // Se captura el evento dentro del mapa.
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if (adminMenu.activeTripsBetweenZones()) {
                console.log("Se hizo click en el mapa.");
                // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
                callbackZonesOnClick(evt.pixel);
            }
        });

        // Modificacion y borrado de una centralidad.
        function callbackZonesOnClick (pixel) {
            // Determina que elemento se clickeo (indicador de centralidad).
            vm.map.forEachFeatureAtPixel(pixel, function(feature, layer) {
                // Se obtienen los datos de coordenadas del indicador y se busca si corresponde a una centralidad.
                console.log("zoneSelected callbackZonesOnClick : "+ vm.zoneSelected);
                console.log("feature : "+srvModelZone.getZone(feature.getId()));
                srvViewZone.toogleAllZones(true, srvModelZone.getZones(), srvModelZone.getZonesLayer());

                if(vm.zoneSelected == -1){
                    vm.selectedOrigin = srvModelZone.getZone(feature.getId());
                    vm.$apply();
                    vm.selectZoneOrigin();
                }
                if(vm.zoneSelected == 1){
                    vm.selectedDestination = srvModelZone.getZone(feature.getId());
                    vm.$apply();
                    vm.selectZoneDestination();
                }
            })
        }

        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuTripFinder', function(isOpen) {
            if (isOpen) {
                console.log('El menu de TRIPS BETWEEN esta abierto');
                enableEventClick();
            } else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                // vm.tripLayer.getSource().clear();
                resetLayerBetweenZone();
                console.log('El menu de TRIPS BETWEEN esta cerrado');

            }
        });

        // funcion que habilita el uso de los eventos de este menu
        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveTripsBetweenZones(true);
        }
        // ************************ Inicializacion de datos *****************************
        generateLayer();

    } // fin Constructor

})()
