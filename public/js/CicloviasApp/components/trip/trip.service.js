// Servicio encargado de devolver un vector con la info necesarias de las zonas para su visualizacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('serviceTrip', ['creatorFeature', 'creatorStyle', serviceTrip]);

        function serviceTrip(creatorFeature, creatorStyle){
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // *************************** FUNCIONES PUBLICAS *******************************
            var service = {
                getSourceTripFinder: getSourceTripFinder,
                getSourceTripId: getSourceTripId,
                getVectorFeatures: getVectorFeatures,
                getSourceJourney: getSourceJourney,
                getSourceTripsRanking: getSourceTripsRanking
            };

            return service;

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // *************************** FUNCIONES PRIVADAS *******************************
            var getInfoTripsId;
            var getInfoTripsFinder;
            var getFeatures;

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // *************************** FUNCIONES PUBLICAS *******************************

            // devuelve un vector FUENTE con los features correspondientes a los trayectos
            function getSourceTripFinder(dataJsonTrips) {
                // var arrayCoordenates = getInfoTripsFinder(dataJsonTrips);

                var geomTrip;
                var featureTrip;
                var vectorFeaturesTrip = [];
                // recuperamos un feature a partir de las corrdeandas de cada recorrido
                for (var i = 0; i < dataJsonTrips.length; i++) {
                    // geomTrip = new ol.geom.LineString(arrayCoordenates[i]);
                    geomTrip = (new ol.format.GeoJSON()).readGeometry(dataJsonTrips[i].geom);

                    featureTrip = creatorFeature.getFeatureGeom(geomTrip);
                    vectorFeaturesTrip.push(featureTrip);
                }

                var vectorSource = new ol.source.Vector({
                    features: vectorFeaturesTrip
                });

                return vectorSource;
            };

            // devuelve un vector FUENTE con los features correspondientes a los recorridos
            function getSourceTripId(tripsJson) {
                // var arrayCoordenatesId = getInfoTrips2(tripsJson);
                //var arrayCoordenatesId = getInfoTripsId(tripsJson);
                var geomTrip;
                var featureTrip;
                var vectorFeaturesTrip = [];
                //console.log("Tamaño del vector recuperado: "+arrayCoordenatesId.length);
                // recuperamos un feature a partir de las corrdeandas de cada recorrido
                for (var i = 0; i < tripsJson.length; i++) {
                    //geomTrip = new ol.geom.LineString(arrayCoordenatesId[i].points);
                    geomTrip = (new ol.format.GeoJSON()).readGeometry(tripsJson[i].geom);
                    featureTrip = creatorFeature.getFeatureGeomId(geomTrip, i + 1);
                    vectorFeaturesTrip.push(featureTrip);
                    //console.log("Source2 --> id guardado: "+arrayCoordenatesId[i].id+" cant de puntos: //"+(arrayCoordenatesId[i].points).length);
                }

                var vectorSource = new ol.source.Vector({
                    features: vectorFeaturesTrip
                });

              return vectorSource;
            };

            // devuelve un vector FUENTE de features de recorridos a partir de los datos recibidos del servidor
            // Modificado por JLDEVIA el 28/05/2017. S.U: Adaptación visual a spatial-data.
            function getVectorFeatures(dataJsonTrips){
                // recuperamos los datos q nos competen
                // var arrayCoord = getInfoTrips2(dataJsonTrips);
                //var arrayCoord = getInfoTripsId(dataJsonTrips);
                var vectorFeaturesTrip = getFeatures(dataJsonTrips);

                return vectorFeaturesTrip;
            }

            // devuelve el vector FUENTE con los features a partir de los datos recibidos del servidor
            function getSourceJourney(lineStringJson){
                var feature;
                var vectorFeatures = [];
                // recorremos el json con los datos
                for (var i = 0; i < lineStringJson.length; i++) {
                    console.log("Paso el color random i: "+i);
                    feature = creatorFeature.getFeatureTripJson(lineStringJson[i]);
                    feature.setStyle(creatorStyle.getStyleJourneyDistinctColor());
                    vectorFeatures.push(feature);
                    console.log(" Se agrego el nro: "+i);
                }

                var vectorSource = new ol.source.Vector({
                    features: vectorFeatures
                });

                return vectorSource;
            }

            // devuelve un vector FUENTE con los features correspondientes a los tramos y su ponderacion
            function getSourceTripsRanking(tripsRankingJson) {
                var feature;
                var vectorFeatures = [];
                // recorremos el json con los datos
                for (var i = 0; i < tripsRankingJson.length; i++) {
                    feature = creatorFeature.getFeatureTripRanking(tripsRankingJson[i]);
                    vectorFeatures.push(feature);
                }

                var vectorSource = new ol.source.Vector({
                    features: vectorFeatures
                });

                return vectorSource;
            };

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // *************************** FUNCIONES PRIVADAS *******************************

            // Devuelve un vector con los features de los recorridos
            // Modificado por JLDEVIA el 28/05/2017. S.U: Adaptación visual a spatial-data.
            function getFeatures(dataJSon){
                var geomTrip;
                var featureTrip;
                var vectorFeaturesTrip = [];
                //console.log("Tamaño del vector recuperado: "+arrayCoordenatesId.length);
                // recuperamos un feature a partir de las corrdeandas de cada recorrido
                for (var i = 0; i < dataJSon.length; i++) {
                    geomTrip = (new ol.format.GeoJSON()).readGeometry(dataJSon[i].geom);
                    featureTrip = creatorFeature.getFeatureGeomId(geomTrip, i + 1);
                    vectorFeaturesTrip.push(featureTrip);
                    //console.log("getFeatures PRIVADO --> id guardado: "+arrayCoordenatesId[i].id+" cant de puntos: //"+(arrayCoordenatesId[i].points).length);
                }

                return vectorFeaturesTrip;
            }

            // devuelve un array con los datos de los recorridos(recuperados del servidor)
            // necesarios para mostrarse en el mapa
            function getInfoTripsId(dataJsonTrips) {
                    var arrayPointsTrips = [];
                    var arrayLontLat = [];
                    var arrayInfoTrips = [];

                    // obtenemos nada mas q los puntos de las zonas con sus datos
                    for (var i = 0; i < dataJsonTrips.length; i++) {
                        arrayPointsTrips.push((dataJsonTrips[i]).geom);
                    }

                    var setPoints;
                    var longLat;
                    var idAux;

                    // rescatams solo los long y lat de cada punto de cada cjto de puntos
                    for (var i = 0; i < arrayPointsTrips.length; i++) {
                        setPoints = arrayPointsTrips[i];
                        // por cada conjunto de puntos rescatams sus long y lat de cada punto
                        for (var j = 0; j < setPoints.length; j++) {
                            // longLat = [(setPoints[j]).longitude, (setPoints[j]).latitude];
                            longLat = [setPoints[j][0], setPoints[j][1]];
                            arrayLontLat.push(longLat);
                        }
                        // creamos un objeto con los datos del recorridos
                        // agregamos el cjo de puntos de cada recorrido al cjto de recorridos
                        var dataTrip = new Object();
                        idAux = i+1;
                        dataTrip.id = idAux;
                        dataTrip.points = arrayLontLat;

                        arrayInfoTrips.push(dataTrip);
                        console.log("id guardado: "+i+" cant de puntos: "+(dataTrip.points).length);
                        // reseteamos la variable auxiliar
                        arrayLontLat = [];
                  }
                  return arrayInfoTrips;
            };


            // crea y devuelve un vector con los datos de los recorridos
            function getInfoTripsFinder(dataJsonTrips) {
                    var arrayPointsTrips = [];
                    var arrayLontLat = [];
                    var arrayInfoTrips = [];

                    // obtenemos nada mas q los puntos de las zonas con sus datos
                    for (var i = 0; i < dataJsonTrips.length; i++) {
                        arrayPointsTrips.push((dataJsonTrips[i]).geom);
                    }

                    var setPoints;
                    var longLat;

                    // rescatams solo los long y lat de cada punto de cada cjto de puntos
                    for (var i = 0; i < arrayPointsTrips.length; i++) {
                        setPoints = arrayPointsTrips[i].coordinates;
                        // por cada conjunto de puntos rescatams sus long y lat de cada punto
                        for (var j = 0; j < setPoints.length; j++) {
                            longLat = [(setPoints[j][1]), (setPoints[j][0])];
                            arrayLontLat.push(longLat);
                        }
                        // agregamos el cjot de puntos de cada recorrido al cjto de recorridos
                        arrayInfoTrips.push(arrayLontLat);
                        // reseteamos la variable auxiliar
                        arrayLontLat = [];
                    }
                    return arrayInfoTrips;
            };

            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        }
})()
