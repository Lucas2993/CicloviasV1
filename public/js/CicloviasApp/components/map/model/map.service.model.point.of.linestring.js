// Este service se ocupa de crear el modelo de los puntos de que corresponden a los recorridos
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvModelPointsOfLineString', [SrvModelPointsOfLineString]);

    function SrvModelPointsOfLineString() {

        var service = {
            getCoordinatesPointsOfLayer: getCoordinatesPointsOfLayer,
            getCoordinatesPointsOfLineString: getCoordinatesPointsOfLineString,

        };

        return service;

        // Este metodo retorna las coordenas de cada linestring de una capa
        function getCoordinatesPointsOfLayer(layer) {
            var features = layer.getSource().getFeatures();
            var geometry;
            var coordinates = [];
            for (var i = 0; i < features.length; i++) {
                geometry = features[i].getGeometry();
                getCoordinatesPointsOfLineString(geometry, coordinates);
            }
            return coordinates;
        }

        // Este metodo recolecta las coordenas de un linestring
        function getCoordinatesPointsOfLineString(geometry, listCoordinates) {
            var coordinates = geometry.getCoordinates();
            for (var i = 0; i < coordinates.length; i++) {
                listCoordinates.push(coordinates[i]);
            }
        }


    } // Fin SrvViewRoad

})()
