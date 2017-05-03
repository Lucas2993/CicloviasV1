// Servicio encargado de devolver un vector con la info necesarias de las zonas para su visualizacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('srvZone', [srvZone]);

        function srvZone(){
            var service = {
                getDataZones: getDataZones
            };

            var getVectorPointZone;

            return service;

            // crea y devuelve un vector con los datos de las zonas
            function getDataZones(dateZonesJson) {
                var vectorInfoZone = [];
                var vectorPointsZone = [];
                for (var i = 0; i < dateZonesJson.length; i++) {
                   vectorPointsZone = getVectorPointZone(dateZonesJson[i].points);
                   var infoZone = new Object();
                   infoZone.name = dateZonesJson[i].name;
                   infoZone.points = vectorPointsZone;
                   vectorInfoZone.push(infoZone);
                }
                return vectorInfoZone;
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
