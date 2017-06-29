// Responsabilidad : Permitir ver la ponderacion de los recorridos
// TODO sin funcionalidad debido a que no se creo el servicio en el backend
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapTripsRankingController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'dataServer',
            'adminLayers',
            'adminMenu',
            'creatorStyle',
            'srvViewTrip',
            MapTripsRankingController
        ]);

    function MapTripsRankingController(vm, creatorMap, srvLayers, dataServer, adminLayers, adminMenu, creatorStyle, srvViewTrip) {

        // ********************************** VARIABLES PUBLICAS ************************
        // Mapa
        vm.map = creatorMap.getMap();
        // datos del servidor
        vm.tripsRankingJson=[];
        // capa de recorridos
        vm.tripsLayerRanking;

        // ********************************** FLAGS PUBLICAS ****************************
        // indica si el menu se encuentra abierto o cerrado
        vm.openMenuRankingTrip = false;
        // habilita o deshabilita el checbox
        vm.enableChecbox = false;
        // tilda o destilda el checkbox
        vm.toogleViewTripsRanking = false;

        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        vm.viewLayerTripsRanking = viewLayerTripsRanking;
        // permite la visualizacion de la capa de tramos ponderados (segun el estado del checkbox)

        vm.findTripsRanking = findTripsRanking;

        vm.viewTripsRanking = viewTripsRanking;

        // borra los datos de la capa
        vm.resetlayer = resetlayer;

        // ********************************** VARIABLES PRIVADAS ************************
        // variable para visualizar un solo popup en el mapa
        var popup = null;

        // *************************** DECLARACION FUNCIONES PRIVADAS ********************
        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        var enableEventClick;

        // ****************************** FUNCIONES PUBLICAS ****************************
        function viewLayerTripsRanking() {
            adminLayers.viewLayer(vm.tripsLayerRanking);
        }


        function viewTripsRanking() {
            // Se hace visible la capa.

            if (vm.tripsRankingJson == null) {
                return;
            }
            srvViewTrip.addTrips(vm.tripsRankingJson, vm.tripsLayerRanking);
        }

        function resetlayer() {
            vm.tripsLayerRanking.getSource().clear();
            vm.enableChecbox = false;
            vm.pondMin = 0;
            vm.pondMax = 0;
        }

        // ****************************** FUNCIONES PRIVADAS ****************************
        // Busca todas los recorridos ponderados de la BD ************** terminar
        function findTripsRanking() {
            console.log("min : " + vm.pondMin + " max : " + vm.pondMax);
            dataServer.getTripsRanking(vm.pondMin, vm.pondMax)
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.tripsRankingJson = data;
                    if (data.length > 0) {
                        vm.enableChecbox = true;
                    }
                    else{
                        alert("No se encontraron recorridos.");
                    }
                    console.log("Tramos Ranking recuperados prom con EXITO! = " + data);
                    viewTripsRanking();
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRAMOS");
                })

        }

        function generateLayer() {
            // Se crea una nueva capa de recorridos con los datos obtenidos.
            vm.tripsLayerRanking = srvLayers.getLayer(null);
            vm.map.addLayer(vm.tripsLayerRanking);
        }
        // ************************ EVENTOS ****************************************
        // Se captura el evento dentro del mapa.
        vm.map.on('pointermove', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if (adminMenu.activeTripsRanking()) {
                // buscamos si se clickeo en un marcador
                var featureFound = vm.map.forEachFeatureAtPixel(evt.pixel,
                    function(feature) {
                        return feature;
                    });

                // si se clickea en un marcador, se crea y muestra el popup cn el dato
                if (featureFound) {
                    var coordinates = featureFound.getGeometry().getCoordinates();
                    // se borra el popup anterior
                    if (popup != null) {
                        popup.container.style.display = 'none';
                    }
                    popup = new ol.Overlay.Popup({
                        positioning: 'center-center',
                        stopEvent: false,
                        offset: [0, -5],
                        autoPan: false
                        // idFeature: 2
                    });
                    vm.map.addOverlay(popup);
                    for (var i = 0; i < vm.tripsRankingJson.length; i++) {
                        if (vm.tripsRankingJson[i].id == featureFound.getId()) {
                            var ranking = vm.tripsRankingJson[i].ranking;
                            popup.show(evt.coordinate, "Ponderación: " + ranking);
                        }
                    }

                    //TODO modificar cuand lea desde el servidor
                }
            }
        });


        function getTrip(id) {

            return null;
        }


        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuRankingTrip', function(isOpen) {
            if (isOpen) {
                console.log('El menu de TRIPS RANKING esta abierto');
                enableEventClick();
            } else {
                console.log('Se cerro el menu de TRIPS RANKING.');
                adminMenu.setActiveTripsRanking(false);
                resetlayer();
            }
        });

        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveTripsRanking(true);
        }

        // ************************ Inicializacion de datos *****************************
        // al crear el controlador ejecutamos esta funcion
        generateLayer();

    } // fin Constructor

})()
