// Servicio encargado de devolver un vector con los puntos de las centralidades
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('creatorPoints', ['creatorStyle', 'creatorFeature', creatorPoints]);

        function creatorPoints(creatorStyle, creatorFeature){
            var service = {
                getVectorPointCentralities: getVectorPointCentralities
            };
            return service;

            // crea y devuelve un vector de puntos
            function getVectorPointCentralities(pointsJson) {
                var vectorCentralities = [];
                var stylePoint = creatorStyle.getStylePoint();
                var point;
                // Recorre el json, mientras va generando puntos y los agrega a un vector
                for (var i = 0; i < pointsJson.length; i++) {
                    point = creatorFeature.getPoint(pointsJson[i].point.longitude, pointsJson[i].point.latitude,pointsJson[i]);
                    point.setStyle(stylePoint);
                    vectorCentralities.push(point);
                }
                return vectorCentralities;
            };

        }

})()
