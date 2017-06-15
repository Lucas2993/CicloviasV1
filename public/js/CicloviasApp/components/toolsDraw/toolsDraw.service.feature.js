// Responsabilidad : Creacion de features segun parametros de entrada.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('creatorFeature', [creatorFeature]);

    function creatorFeature() {
        var service = {
            getPoint: getPoint,
            getPolygon: getPolygon,
            getFeatureGeomId: getFeatureGeomId,
            getFeature: getFeature,
        };
        return service;

        // crea y devuelve un punto con long y lat
        function getPoint(lon, lat) {
            var point = new ol.Feature({
                geometry: new ol.geom.Point([lon, lat]),

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

        // Este
        function getFeature(geometry, id, style) {
            var geom = (new ol.format.GeoJSON()).readGeometry(geometry);
            var feature = getFeatureGeomId(geom, id);
            feature.setStyle(style);
            return feature;
        }

        // crea un feature a partir de cualquier objeto del tipo ol.geom
        function getFeatureGeomId(geom, id) {
            var feature = new ol.Feature({
                geometry: geom
            });
            // le asignamos un ID
            feature.setId(id);
            return feature;
        }
    }//Fin creatorFeature
})()
