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
                getFeatureGeom: getFeatureGeom,
                getFeatureGeomId: getFeatureGeomId,
                getFeatureTripJson: getFeatureTripJson
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

            // crea un feature a partir de cualquier objeto del tipo ol.geom
            function getFeatureGeomId(geom, id){
                var feature = new ol.Feature({
                    geometry: geom
                });
                // le asignamos un ID
                feature.setId(id);
                console.log("id del feature creado: "+feature.getId());
                return feature;
            }

            // crea un feature de trip a partir de los datos en formato json de los recorridos
            function getFeatureTripJson(tripsJson){
                var arrayLontLat = [];

                var pointsTripJson = tripsJson.points;

                var longLat;
                var geomTrip;

                // rescatams solo los long y lat de cada punto
                for (var i = 0; i < pointsTripJson.length; i++) {
                    longLat = [(pointsTripJson[i]).longitude, (pointsTripJson[i]).latitude];
                    arrayLontLat.push(longLat);
                }

                geomTrip = new ol.geom.LineString(arrayLontLat);

                var feature = new ol.Feature({
                    geometry: geomTrip
                });
                // le asignamos un ID
                feature.setId(tripsJson.id);
                console.log("id del trayecto del JSON creado: "+feature.getId());
                return feature;
            }
        }

})()
