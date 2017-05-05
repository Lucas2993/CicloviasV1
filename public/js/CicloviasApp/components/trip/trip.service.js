// Servicio encargado de devolver un vector con la info necesarias de las zonas para su visualizacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('serviceTrip', ['creatorFeature', serviceTrip]);

        function serviceTrip(creatorFeature){
            var service = {
                getSource: getSource,
                getSource2: getSource2,
                getFeatures: getFeatures,
                getSourceJourney: getSourceJourney
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
                //   featureTrip = creatorFeature.getFeatureGeom(geomTrip);
                featureTrip = creatorFeature.getFeatureGeom(geomTrip);
                  vectorFeaturesTrip.push(featureTrip);
                }

                var vectorSource = new ol.source.Vector({
                    features: vectorFeaturesTrip
                });

                return vectorSource;
            };

            // devuelve un vector con los features correspondientes a los trayectos
            function getSource2(arrayCoordenatesId) {
                var geomTrip;
                var featureTrip;
                var vectorFeaturesTrip = [];
                console.log("Tamaño del vector recuperado: "+arrayCoordenatesId.length);
                // recuperamos un feature a partir de las corrdeandas de cada recorrido
                for (var i = 0; i < arrayCoordenatesId.length; i++) {
                    geomTrip = new ol.geom.LineString(arrayCoordenatesId[i].points);
                    featureTrip = creatorFeature.getFeatureGeomId(geomTrip, arrayCoordenatesId[i].id);
                    vectorFeaturesTrip.push(featureTrip);
                    console.log("Source2 --> id guardado: "+arrayCoordenatesId[i].id+" cant de puntos: "+(arrayCoordenatesId[i].points).length);
                }

                var vectorSource = new ol.source.Vector({
                    features: vectorFeaturesTrip
                });

                return vectorSource;
            };

            function getFeatures(arrayCoordenatesId){
                var geomTrip;
                var featureTrip;
                var vectorFeaturesTrip = [];
                console.log("Tamaño del vector recuperado: "+arrayCoordenatesId.length);
                // recuperamos un feature a partir de las corrdeandas de cada recorrido
                for (var i = 0; i < arrayCoordenatesId.length; i++) {
                    geomTrip = new ol.geom.LineString(arrayCoordenatesId[i].points);
                    featureTrip = creatorFeature.getFeatureGeomId(geomTrip, arrayCoordenatesId[i].id);
                    vectorFeaturesTrip.push(featureTrip);
                    console.log("getFeatures --> id guardado: "+arrayCoordenatesId[i].id+" cant de puntos: "+(arrayCoordenatesId[i].points).length);
                }

                return vectorFeaturesTrip;
            }

            function getSourceJourney(lineStringJson){
                var feature;
                var vectorFeatures = [];
                // recorremos el json con los datos
                for (var i = 0; i < lineStringJson.length; i++) {
                    feature = creatorFeature.getFeatureTripJson(lineStringJson[i]);
                    vectorFeatures.push(feature);
                }

                var vectorSource = new ol.source.Vector({
                    features: vectorFeatures
                });

                return vectorSource;
            }

        }

})()
