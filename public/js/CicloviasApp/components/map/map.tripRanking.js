/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('tripsRankingController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer','adminLayers', 'adminMenu', TripsRankingController]);

    function TripsRankingController(vm, creatorMap, srvLayers, dataServer,adminLayers, adminMenu) {

        // ********************* declaracion de variables y metodos *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************
        vm.map = creatorMap.getMap();
        // datos del servidor
        vm.tripsRankingJson
        // capa de recorridos
        vm.layerTripsRanking

        // ===============>>>>>> FLAGS <<<<<===============
        // indica si el menu se encuentra abierto o cerrado
        vm.openMenuRankingTrip = false;

        // **************************** FUNCIONES ****************************
        // permite la visualizacion de la capa de tramos ponderados (segun el estado del checkbox)
        vm.viewLayerTripsRanking = viewLayerTripsRanking;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PRIVADO ***********************************
        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        var enableEventClick;
        // recupera los datos del servidor y los guarda en una variable
        var findTripsRanking;
        // variable para visualizar un solo popup en el mapa
        var popup = null;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Descripcion de las funciones ************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // ********************** PUBLICAS **********************
        function viewLayerTripsRanking() {
            adminLayers.viewLayer(vm.layerTripsRanking);
        }
        // ################## OBSERVADORAS ##################
        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuRankingTrip', function(isOpen){
            if (isOpen) {
                console.log('El menu de TRIPS RANKING esta abierto');
                enableEventClick();
            }
            else{
                console.log('Se cerro el menu de TRIPS RANKING.');
            }
        });

        // Se captura el evento dentro del mapa.
        vm.map.on('pointermove', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if(adminMenu.activeTripsRanking()){

                // var feature = vm.map.forEachFeatureAtPixel(evt.pixel,
                //     function(feature) {
                //         if (popup != null) {
                //             console.log("entra TRIPS_RANKING");
                //             popup.container.style.display = 'none';
                //         }
                //         var coordinates = feature.getGeometry().getCoordinates();
                //         popup = new ol.Overlay.Popup({
                //             positioning: 'center-center',
                //             stopEvent: false,
                //             offset: [0, -5],
                //             autoPan: false
                //         });
                //         vm.map.addOverlay(popup);
                //         popup.show(evt.coordinate, feature.get('ranking'));
                //
                //         // setTimeout(function() {
                //         //     popup.container.style.display = 'none';
                //         //     popup = null;
                //         // }, 3000);
                //
                //         return feature;
                //     });

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
                        // setTimeout(function() {
                        //     popup.container.style.display = 'none';
                        //     popup = null;
                        // }, 1000);
                    }
            }
        });

        // ********************** PRIVADAS **********************
        // Busca todas los recorridos de la BD ************** terminar
        function findTripsRanking() {
            // dataServer.getTripsRanking()
            //     .then(function(data) {
            //         // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
            //         vm.tripsRankingJson = data;
            //         console.log("Datos recuperados TRIPS_RANKING(privado) con EXITO! = " + data);
            //         // proceso y genracion de capa de recorridos
            //         vm.layerTripsRanking = srvLayers.getLayerTripsRanking(vm.tripsRankingJson);
            //         vm.map.addLayer(vm.layerTripsRanking);
            //     })
            //     .catch(function(err) {
            //         console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS_RANKING");
            //     })
            vm.tripsRankingJson = dataServer.getTripsRanking();
            vm.layerTripsRanking = srvLayers.getLayerTripsRanking(vm.tripsRankingJson);
            vm.map.addLayer(vm.layerTripsRanking);
        }

        function enableEventClick(){
            adminMenu.disableAll();
            adminMenu.setActiveTripsRanking(true);
        }

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Inicializacion de datos *****************************
        // ******************************************************************************
        // al crear el controlador ejecutamos esta funcion
        findTripsRanking();

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    } // fin Constructor

})()
