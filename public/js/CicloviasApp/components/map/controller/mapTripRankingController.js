// Responsabilidad : Permitir ver la ponderacion de los recorridos
// TODO sin funcionalidad debido a que no se creo el servicio en el backend
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('tripsRankingController', [
            '$scope',
            'creatorMap',
            'srvLayers',
            'dataServer',
            'adminLayers',
            'adminMenu',
            'creatorStyle',
            TripsRankingController
        ]);

    function TripsRankingController(vm, creatorMap, srvLayers, dataServer, adminLayers, adminMenu,creatorStyle) {

        // ********************************** VARIABLES PUBLICAS ************************
        // Mapa
        vm.map = creatorMap.getMap();
        // datos del servidor
        vm.tripsRankingJson
        // capa de recorridos
        vm.layerTripsRanking

        // ********************************** FLAGS PUBLICAS ****************************
        // indica si el menu se encuentra abierto o cerrado
        vm.openMenuRankingTrip = false;

        // ************************DECLARACION DE FUNCIONES PUBLICAS ********************
        // permite la visualizacion de la capa de tramos ponderados (segun el estado del checkbox)
        vm.viewLayerTripsRanking = viewLayerTripsRanking;

        vm.findTripsRanking = findTripsRanking;

        // ********************************** VARIABLES PRIVADAS ************************
        // variable para visualizar un solo popup en el mapa
        var popup = null;

        // *************************** DECLARACION FUNCIONES PRIVADAS ********************
        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        var enableEventClick;
        // recupera los datos del servidor y los guarda en una variable
        var findTripsRanking;

        // ****************************** FUNCIONES PUBLICAS ****************************
        function viewLayerTripsRanking() {
            adminLayers.viewLayer(vm.layerTripsRanking);
        }

        // ****************************** FUNCIONES PRIVADAS ****************************
        // Busca todas los recorridos ponderados de la BD ************** terminar
        function findTripsRanking() {

            if (document.getElementById("rangeSuccess") != null) {
                // alert("Min ponderación " + document.getElementById("rangeSuccess").value + "\nMañana:" + vm.list[0].selected + "\nTarde: " + vm.list[1].selected + "\nNoche: " + vm.list[2].selected);
            }
            // vm.map.removeLayer(vm.layerTripsRanking);

            vm.tripsRankingJson = dataServer.getTripsRanking();

            // vm.layerTripsRanking = srvLayers.getLayerTripsRanking(vm.tripsRankingJson);
            vm.layerTripsRanking = srvLayers.getLayer(null);
            vm.layerTripsRanking.setStyle(creatorStyle.getStyleTrip('blue', 2));


            vm.map.addLayer(vm.layerTripsRanking);
            vm.viewLayerTripsRanking();
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
                    popup.show(evt.coordinate, featureFound.get('ranking'));
                }
            }
        });
        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuRankingTrip', function(isOpen) {
            if (isOpen) {
                console.log('El menu de TRIPS RANKING esta abierto');
                enableEventClick();
            } else {
                console.log('Se cerro el menu de TRIPS RANKING.');
            }
        });

        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        function enableEventClick() {
            adminMenu.disableAll();
            adminMenu.setActiveTripsRanking(true);
        }

        // ************************ Inicializacion de datos *****************************
        // al crear el controlador ejecutamos esta funcion
        findTripsRanking();
        vm.viewLayerTripsRanking();

    } // fin Constructor

})()
