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
                getLayerZones: getLayerZones
            };
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
        }

})()
