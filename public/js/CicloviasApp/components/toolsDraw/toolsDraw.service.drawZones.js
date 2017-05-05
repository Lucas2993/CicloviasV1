// Creacion de los dibujos de las zonas
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('serviceDrawZone', ['creatorFeature',serviceDrawZone]);

        function serviceDrawZone(creatorFeature){
            var service = {
                getVectorDraws: getVectorDraws,
                getVectorPointZone: getVectorPointZone
            };
            return service;

            // infoZone: vector con objetos que contienen contienen la informacion de cada zona
            // devuelve un vector con los draw necesarios para visualizar las zonas
            function getVectorDraws(infoZone) {
                var vectorDrawsZone = [];
                for (var i = 0; i < infoZone.length; i++) {
                  var draw = creatorFeature.getPolygon(infoZone[i].points);
                  vectorDrawsZone.push(draw);
                }
                return vectorDrawsZone;
            };

            // dado los puntos de una zona, devuelve un vector con esos puntos
            function getVectorPointZone(pointsZone) {
                var vectorPointsZone = [];
                var point;
                for (var i = 0; i < pointsZone.length; i++) {
                    point = [pointsZone[i].longitude, pointsZone[i].latitude];
                    vectorPointsZone.push(point);
                }
                point = [pointsZone[0].longitude, pointsZone[0].latitude];
                vectorPointsZone.push(point);
                return vectorPointsZone;
            };
        }

})()
