// Creacion de distintos tipos de capas
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')

        .factory('srvLayers', ['creatorPoints','creatorStyle','serviceDrawZone','srvZone', srvLayers]);

        function srvLayers(creatorPoints, creatorStyle, serviceDrawZone, srvZone){
            var service = {
                getLayerTile: getLayerTile,
                getLayerMarker: getLayerMarker,
                getLayerZones: getLayerZones,
                getGroupLayerZones: getGroupLayerZones
            };

            var generateZone;

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
                var vectorPointsCentralities = creatorPoints.getVectorPointCentralities(centralitiesJson);

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
                // for (var i = 0; i < infoZones.length; i++) {
                for (var i = 0; i < 2; i++) {
                    var newLayer = generateZone(infoZones[i]);
                    console.log('capa '+i+' : '+newLayer.getVisible());
                    vectorLayers.push(newLayer);
                 }
                //  vectorLayers.push(vm.capaCentralidades);
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
                 var styleDraw = creatorStyle.getStylePolygon('blue', creatorStyle.getStyleText(infoZone.name));

                //  getStylePolygon(vm.getStyleText(infoZone.name), 'green');

                 console.log('Nombre de las zonas: '+infoZone.name);
                 console.log('Cantidad de puntos: '+infoZone.points.length);
                 // crea la capa
                 var vectorDraw = [];
                 vectorDraw.push(draw);

                 return new ol.layer.Vector({
                    source: new ol.source.Vector({
                    features: vectorDraw
                    }),
                    style: styleDraw
                 });

                //  return vm.getLayerZone(draw, styleDraw);
              }
        }

})()
