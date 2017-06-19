/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('tripsCicloviasController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer','adminLayers', 'adminMenu', TripsCicloviasController]);

    function TripsCicloviasController(vm, creatorMap, srvLayers, dataServer,adminLayers, adminMenu) {

        // ********************* declaracion de variables y metodos *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************
        vm.map = creatorMap.getMap();
        // datos del servidor
        vm.tripsCiclovias = [];
        // capa de recorridos
        vm.layerTripsCiclovias;


        // ===============>>>>>> FLAGS <<<<<===============
        // indica si el menu se encuentra abierto o cerrado
        vm.openMenuTripsCiclovia = false;

        // **************************** FUNCIONES ****************************
        // permite la visualizacion de la capa de tramos ponderados (segun el estado del checkbox)
        vm.viewLayerTripsCiclovia = viewLayerTripsCiclovia;

        // vm.findTripsRanking = findTripsRanking;
        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PRIVADO ***********************************
        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        var enableEventClick;
        // recupera los datos del servidor y los guarda en una variable
        var findTripsCiclovias;
        // variable para visualizar un solo popup en el mapa
        var popup = null;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Descripcion de las funciones ************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // ********************** PUBLICAS **********************
        function viewLayerTripsCiclovia() {
            adminLayers.viewLayer(vm.layerTripsCiclovias);
        }
        // // ################## OBSERVADORAS ##################
        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuTripsCiclovia', function(isOpen){
            if (isOpen) {
              console.log('El menu de POSIBLES_CICLOVIAS esta abierto');
              enableEventClick();
            }
            else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                // temporalLayer.getSource().clear();
            }
        });

        // Se captura el evento dentro del mapa.
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            if(adminMenu.activeTripsCiclovias()){
                console.log("Se hizo click en el mapa.");

                // buscamos si se clickeo en un marcador
                    var featureFound = vm.map.forEachFeatureAtPixel(evt.pixel,
                        function(feature) {
                          return feature;
                    });

                    // si se clickea en un feature(zona en este caso), se crea y muestra el popup cn el dato
                    if (featureFound) {
                        console.log("Se clickeo sobre un fesature");
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
                        popup.show(evt.coordinate, featureFound.get('id'));
                        // setTimeout(function() {
                        //     popup.container.style.display = 'none';
                        //     popup = null;
                        // }, 1000);
                    }
            }
        });

        // ********************** PRIVADAS **********************
        // Busca todas los recorridos de la BD ************** terminar

        // Modificado por JLDEVIA el 28/05/2017. S.U: Adaptación visual a spatial-data.
        function findTripsCiclovias() {
            dataServer.getTrips()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    // for (var i = 0; i < data.length; i++) {
                    //     if(i > 2){
                    //         vm.tripsCiclovias.push(data[i]);
                    //     }
                    // }
                    vm.tripsCiclovias = data;
                    console.log("Trips recuperados POSIBLES_CICLOVIAS:");
                    console.log(data);
                    // proceso y genracion de capa de recorridos
                    vm.layerTripsCiclovias = srvLayers.getLayerTrips(vm.tripsCiclovias);
                    vm.map.addLayer(vm.layerTripsCiclovias);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS CICLOVIAS");
                })
        }

        // function findTripsRanking() {
        //     // dataServer.getTripsRanking()
        //     //     .then(function(data) {
        //     //         // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
        //     //         vm.tripsRankingJson = data;
        //     //         console.log("Datos recuperados TRIPS_RANKING(privado) con EXITO! = " + data);
        //     //         // proceso y genracion de capa de recorridos
        //     //         vm.layerTripsRanking = srvLayers.getLayerTripsRanking(vm.tripsRankingJson);
        //     //         vm.map.addLayer(vm.layerTripsRanking);
        //     //     })
        //     //     .catch(function(err) {
        //     //         console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar los TRIPS_RANKING");
        //     //     })
        //
        //     if(document.getElementById("rangeSuccess") != null){
        //       alert("Min ponderación " +   document.getElementById("rangeSuccess").value +"\nMañana:"+vm.list[0].selected+ "\nTarde: "+vm.list[1].selected+"\nNoche: "+vm.list[2].selected );
        //     }
        //     // vm.map.removeLayer(vm.layerTripsRanking);
        //
        //     vm.tripsRankingJson = dataServer.getTripsRanking();
        //     vm.layerTripsRanking = srvLayers.getLayerTripsRanking(vm.tripsRankingJson);
        //     vm.map.addLayer(vm.layerTripsRanking);
        //     vm.viewLayerTripsRanking();
        //
        // }

        function enableEventClick(){
            adminMenu.disableAll();
            adminMenu.setActiveTripsCiclovias(true);
        }

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Inicializacion de datos *****************************
        // ******************************************************************************
        // al crear el controlador ejecutamos esta funcion
        findTripsCiclovias();
        vm.viewLayerTripsCiclovia();
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    } // fin Constructor

})()
