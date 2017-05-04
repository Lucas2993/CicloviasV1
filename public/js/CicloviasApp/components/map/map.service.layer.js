// Creacion de distintos tipos de capas
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')

        .factory('srvLayers', ['creatorPoints','creatorStyle','serviceDrawZone','srvZone','serviceTrip', srvLayers]);

        function srvLayers(creatorPoints, creatorStyle, serviceDrawZone, srvZone, serviceTrip){
            var service = {
                getLayerTile: getLayerTile,
                getLayerMarker: getLayerMarker,
                getLayerZones: getLayerZones,
                getGroupLayerZones: getGroupLayerZones,
                getLayerTrips: getLayerTrips
            };

            var generateZone;
            var getInfoTrips;

            return service;

            // crea y devuelve una capa del tipo Tile
            function getLayerTile () {
              var layer = new ol.layer.Tile({
                        // determina el render de la capa
                      source: new ol.source.OSM()
                  });
              return layer;
            };


            // crea y devuelve la capa de los marcadoresr
            function getLayerMarker (centralitiesJson) {
                var vectorPointsCentralities ;
                // = creatorPoints.getVectorPointCentralities(centralitiesJson);

                var centralitiesPoints = new ol.source.Vector({
                    features: vectorPointsCentralities
                });

                var layerMarker = new ol.layer.Vector({
                    source: centralitiesPoints
                });

                return layerMarker;
            };

            function getLayerZones (infoZoneJson) {
                // recuperams solo los datos que nos interesan
                var infoZones = srvZone.getDataZones(infoZoneJson);
                // 1ro determinamos el estilo del texto, con su info de cada zona(por ahora va ser el mismo para todos)
                var styleText = creatorStyle.getStyleText('NEW_ZONA_R');
                // var styleText = creatorStyle.getStyleText(infoZones[0].name);
                // una vez creado el estilo de texto vamos a creaer el estilo del polygono de cada zona
                var stylePolygon = creatorStyle.getStylePolygon("blue",styleText);
                // creamos los dibujos de cada zona (polygon)
                var vectorDrawsZone = serviceDrawZone.getVectorDraws(infoZones);

                var layerZone = new ol.layer.Vector({
                    source: new ol.source.Vector({
                        features: vectorDrawsZone
                    }),
                    style: stylePolygon
                });

                return layerZone;
            }

            // recibe los datos obtenidos del servidor
            function getGroupLayerZones(infoZoneJson) {
                console.log("entro a la nueva funcion layer Group!!");
                var groupLayerZones;
                // creamos un vector que va a contener las capas
                var vectorLayers= [];

                // obtenemos de los datos crudos, solo los datos neceasarios para visualizar las zonas
                var infoZones = srvZone.getDataZones(infoZoneJson);

                // por cada zona generamos una capa
                for (var i = 0; i < infoZones.length; i++) {
                // for (var i = 0; i < 2; i++) {
                    var newLayer = generateZone(infoZones[i]);
                    console.log('capa '+i+' : '+newLayer.getVisible());
                    vectorLayers.push(newLayer);
                 }
                 console.log('paso generateZone()');
                 // creo un groupLayer que contendra todas las zonas
                 groupLayerZones = new ol.layer.Group({
                     layers: vectorLayers
                  });

                return groupLayerZones;
            }

            // crea la capa de una zona
            function generateZone(infoZone) {
                console.log('entro a genrateZone()');
                 // crea el dibujo con los puntos
                 var draw = new ol.Feature({
                     geometry: new ol.geom.Polygon([
                             infoZone.points
                     ])
                 });
                 // crea el stylo del dibujo
                var styleDraw = creatorStyle.getStylePolygon(infoZone.color, creatorStyle.getStyleText(infoZone.name));

                 console.log('Nombre de las zonas: '+infoZone.name);
                 console.log('Cantidad de puntos: '+infoZone.points.length);
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

                //  return vm.getLayerZone(draw, styleDraw);
              }

              // crea y devuelve la capa de recorridos
            function getLayerTrips(dataJsonTrips){
                // recuperamos los datos q nos competen
                  var arrayCoord = getInfoTrips(dataJsonTrips);

                  var vectorSourceNew = serviceTrip.getSource(arrayCoord);
                  var styleLayer = creatorStyle.getStyleTrip();

                  var layerTrips = new ol.layer.Vector({
                    source: vectorSourceNew,
                    style: styleLayer,
                    visible: false
                  });

                  console.log("Capa de trayectos NUEVA visible: "+layerTrips.getVisible());

                  return layerTrips;
              }

              // crea y devuelve un vector con los datos de las zonas
              function getInfoTrips(dataJsonTrips) {
                      var arrayPointsTrips = [];
                      var arrayLontLat = [];
                      var arrayInfoTrips = [];

                      // obtenemos nada mas q los puntos de las zonas con sus datos
                      for (var i = 0; i < dataJsonTrips.length; i++) {
                          arrayPointsTrips.push((dataJsonTrips[i]).points);
                      }

                      var setPoints;
                      var longLat;

                      // rescatams solo los long y lat de cada punto de cada cjto de puntos
                      for (var i = 0; i < arrayPointsTrips.length; i++) {
                          setPoints = arrayPointsTrips[i];
                          // por cada conjunto de puntos rescatams sus long y lat de cada punto
                          for (var j = 0; j < setPoints.length; j++) {
                              longLat = [(setPoints[j]).longitude, (setPoints[j]).latitude];
                              arrayLontLat.push(longLat);
                          }
                          // agregamos el cjot de puntos de cada recorrido al cjto de recorridos
                          arrayInfoTrips.push(arrayLontLat);
                          // reseteamos la variable auxiliar
                          arrayLontLat = [];
                      }
                      return arrayInfoTrips;
              };
        }

})()
