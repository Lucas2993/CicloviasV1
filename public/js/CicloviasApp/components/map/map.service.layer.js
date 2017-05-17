// Creacion de distintos tipos de capas
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
    
        .factory('srvLayers', ['creatorStyle','srvZone','serviceTrip', srvLayers]);

        function srvLayers(creatorStyle, srvZone, serviceTrip){

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // *************************** FUNCIONES PUBLICAS *******************************
            var service = {
                getLayerTile: getLayerTile,
                getLayerMarker: getLayerMarker,
                getGroupLayerZones: getGroupLayerZones,
                getLayerTrips: getLayerTrips,
                getLayerTripsFinder: getLayerTripsFinder,
                getLayerTripsRanking: getLayerTripsRanking,
                getLayerJourney: getLayerJourney,
                getTemporalLayer: getTemporalLayer
            };

            return service;

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // *************************** FUNCIONES PRIVADAS *******************************
            var generateZone;

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // *************************** FUNCIONES PUBLICAS *******************************
            // crea y devuelve una capa del tipo Tile
            function getLayerTile () {
              var layer = new ol.layer.Tile({
                        // determina el render de la capa
                      source: new ol.source.OSM()
                  });
              return layer;
            };

            // crea y devuelve la capa vacia
            function getLayerMarker () {
                var vectorPointsCentralities;

                var centralitiesPoints = new ol.source.Vector({
                    features: vectorPointsCentralities
                });

                var layerMarker = new ol.layer.Vector({
                    source: centralitiesPoints
                });

                return layerMarker;
            };

            // recibe los datos de las zonas obtenidos del servidor y devuelve una capa que
            // con subcapas con las zonas
            function getGroupLayerZones(infoZoneJson) {
                console.log("entro a la nueva funcion layer Group!!");
                var groupLayerZones;
                // creamos un vector que va a contener las capas
                var vectorLayers= [];

                // obtenemos de los datos crudos, solo los datos neceasarios para visualizar las zonas
                var infoZones = srvZone.getDataZones(infoZoneJson);

                // por cada zona generamos una capa
                for (var i = 0; i < infoZones.length; i++) {
                    var newLayer = generateZone(infoZones[i]);
                    console.log('capa '+i+' : '+newLayer.getVisible());
                    vectorLayers.push(newLayer);
                 }
                 // creo un groupLayer que contendra todas las zonas
                 groupLayerZones = new ol.layer.Group({
                     layers: vectorLayers
                  });

                return groupLayerZones;
            }

            // crea y devuelve una capa que contiene los recorridos recuperados del servidor
            function getLayerTrips(dataJsonTrips){
                // recuperamos los datos q nos competen
                  var vectorSourceNew = serviceTrip.getSourceTripId(dataJsonTrips);
                  var styleLayer = creatorStyle.getStyleTrip();

                  var vectorSourceVacio = new ol.source.Vector({
                  });

                  var layerTrips = new ol.layer.Vector({
                    source: vectorSourceVacio,
                    style: styleLayer
                  });

                  return layerTrips;
              }

              // crea y devuelve una capa que contiene los recorridos recuperados del servidor #2
              function getLayerTripsFinder(dataJsonTrips){
                  // recuperamos los datos q nos competen
                    var vectorSourceNew = serviceTrip.getSourceTripFinder(dataJsonTrips);
                    var styleLayer = creatorStyle.getStyleTripCloseToPoint();

                    var layerTrips = new ol.layer.Vector({
                      source: vectorSourceNew,
                      style: styleLayer,
                      visible: false
                    });

                    console.log("Capa de trayectos NUEVA visible: "+layerTrips.getVisible());

                    return layerTrips;
                }

                // crea la capa de tramos con su ponderacion
                function getLayerTripsRanking(dataJsonTripsRanking){
                    // recuperamos los datos q nos competen
                      var vectorSourceTripsRanking = serviceTrip.getSourceTripsRanking(dataJsonTripsRanking);
                      var styleLayer = creatorStyle.getStyleTripsRanking();

                      var layerTripsRanking = new ol.layer.Vector({
                        source: vectorSourceTripsRanking,
                        style: styleLayer,
                        visible: false
                      });

                      return layerTripsRanking;
                }

              // crea y devuelve una capa con los trayectos del servidor
              function getLayerJourney(dataJsonJourney){
                      // recuperamos los datos q nos competen
                      var vectorSourceJourney = serviceTrip.getSourceJourney(dataJsonJourney);
                        var styleLayer = creatorStyle.getStyleJourney();

                        var layerJournies = new ol.layer.Vector({
                          source: vectorSourceJourney,
                          style: styleLayer,
                          visible: false
                        });

                        return layerJournies;
              }

              function getTemporalLayer(){
                  var features = new ol.Collection();
                  var temporalLayer = new ol.layer.Vector({
                      source: new ol.source.Vector({features: features}),
                      style: creatorStyle.getStyleTemporalEditCentrality()
                    });

                    return temporalLayer;
              }

              // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
              // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

              // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
              // *************************** FUNCIONES PRIVADAS *******************************
              // crea la capa de una zona a partir de los datos recibidos
              function generateZone(infoZone) {
                   // crea el dibujo con los puntos
                   var draw = new ol.Feature({
                       geometry: new ol.geom.Polygon([
                               infoZone.points
                       ])
                   });
                   // crea el stylo del dibujo
                  var styleDraw = creatorStyle.getStylePolygon(infoZone.color, creatorStyle.getStyleText(infoZone.name));

                   console.log('Nombre de las zonas: '+infoZone.name+' Cantidad de puntos: '+infoZone.points.length);
                   // crea la capa
                   var vectorDraw = [];
                   vectorDraw.push(draw);

                   return new ol.layer.Vector({
                      source: new ol.source.Vector({
                      features: vectorDraw
                      }),
                      style: styleDraw,
                      visible: false
                   });
                }

                // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        }

})()
