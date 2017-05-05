// Creacion de feature (puntos longLat y polygon)
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('creatorFeature', [creatorFeature]);

        function creatorFeature(){
            var service = {
                getPoint: getPoint,
                getPolygon: getPolygon,
                getFeatureGeom: getFeatureGeom
            };
            return service;

            // crea y devuelve un punto con long y lat
            function getPoint(lon, lat,object) {
                var point = new ol.Feature({
                          geometry: new ol.geom.Point([lon, lat]),
                                          object: object

                      });

                return point;
            };

            // crea y devuelve un polygon son los puntos especificados
            function getPolygon(points) {
                var polygon = new ol.Feature({
                           geometry: new ol.geom.Polygon([
                                   points
                           ])
                       });
                return polygon;
            };

            // crea un feature a partir de cualquier objeto del tipo ol.geom
            function getFeatureGeom(geom){
                var feature = new ol.Feature({
                    geometry: geom
                });
                return feature;
            }
        }

})()
