// Este service se ocupa de crear los puntos que pertenecen a un lineString
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvViewPointsOfLineString', [
            'srvViewFeature',
            'creatorStyle',
            'creatorColor',
            'creatorFeature',
            SrvViewPointsOfLineString
        ]);

    function SrvViewPointsOfLineString(srvViewFeature, creatorStyle, creatorColor, creatorFeature) {

        var service = {
            addAll: addAll,
            add: add,
            toogleAll: toogleAll,

        };

        return service;

        // agrega recorridos a partir de los datos recuperados del servidor a la capa recibida
        function addAll(listCoordinates, layer) {
            var point;
            for (var i = 0; i < listCoordinates.length; i++) {
                point = getPoint(100000+i,listCoordinates[i][0], listCoordinates[i][1]);
                srvViewFeature.addFeature(point, layer, creatorStyle.getStylePoint(5,'white','blue'));
            }
        }

        function getPoint(id , lng , lat ) {
            var pointJson={} ;
            pointJson.id = id;
            pointJson.geom = {};
            pointJson.geom.type = "Point";
            pointJson.geom.coordinates = [lng , lat];
            return pointJson;
        }

        function add(pointJson, layer) {
            srvViewFeature.addFeature(pointJson, layer, creatorStyle.getStyleTrip(creatorColor.getRandomColor(), 3));
        }

        function toogleAll(isSelectedAllFeatures, featuresJson, layer) {
            return srvViewFeature.toogleAllFeatures(isSelectedAllFeatures, featuresJson, layer, this);
        }


    } // Fin SrvViewPointOfLineString

})()
