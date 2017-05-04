// Servicio encargado de devolver un vector con la info necesarias de las zonas para su visualizacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('serviceTrip', ['creatorFeature', serviceTrip]);

        function serviceTrip(creatorFeature){
            var service = {
                getSource: getSource
            };

            return service;

            // devuelve un vector con los features correspondientes a los trayectos
            function getSource(arrayCoordenates) {
                var geomTrip;
                var featureTrip;
                var vectorFeaturesTrip = [];
                // recuperamos un feature a partir de las corrdeandas de cada recorrido
                for (var i = 0; i < arrayCoordenates.length; i++) {
                  geomTrip = new ol.geom.LineString(arrayCoordenates[i]);
                  featureTrip = creatorFeature.getFeatureGeom(geomTrip);
                  vectorFeaturesTrip.push(featureTrip);
                }

                var vectorSource = new ol.source.Vector({
                    features: vectorFeaturesTrip
                });

                return vectorSource;
            };

        }

})()
