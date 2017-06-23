// Responsabilidad : Realizar las peticiones HTTP al servidor y brindar los resultados a los controladores
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('dataServer', ['$http', '$q', 'path', dataServer]);

    function dataServer($http, $q, path) {
        var service = {
            // Zonas
            getZones: getZones,

            // Trips
            getTrips: getTrips,
            getTripsCloseToPoint: getTripsCloseToPoint,
            getTripsRanking: getTripsRanking,
            getTripsToDistance: getTripsToDistance,
            getTripsToCentrality: getTripsToCentrality,
            getTripsBetweenZones: getTripsBetweenZones,
            // Journey
            getJourneys: getJourneys,

            // Centralidades
            getCentralities: getCentralities,
            saveCentrality: saveCentrality,
            updateCentrality: updateCentrality,
            deleteCentrality: deleteCentrality
        };
        return service;

        // dado los puntos de una zona, devuelve un vector con esos puntos
        function getZones() {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.ZONE
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise ZONES: ' + res.data.length);
                    console.log('datos de promise ZONES color: ' + ((res.data)[0]).color);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );

            return promise;
        };

        function getCentralities() {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.CENTRALITY
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise CENTRALITY: '+ res.data.length);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        };

        function saveCentrality(newCentrality) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'POST',
                url: path.CENTRALITY,
                data: newCentrality
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    // console.log('datos de promise CENTRALITY: '+res.data);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );

            return promise;
        };

        function updateCentrality(centrality) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'PUT',
                url: path.CENTRALITY + '/' + centrality.id,
                data: centrality
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    // console.log('datos de promise CENTRALITY: '+res.data);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );

            return promise;
        };

        function deleteCentrality(centralityId) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'DELETE',
                url: path.CENTRALITY + '/' + centralityId,
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    // console.log('datos de promise CENTRALITY: '+res.data);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );

            return promise;
        };

        function getTrips() {
            var defered = $q.defer();
            var promise = defered.promise;
            $http({
                method: 'GET',
                url: path.TRIP
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise TRIP: ' + res.data.length);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        };

        function getJourneys() {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.JOURNEY
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise JOURNEY: ' + res.data.length);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        };

        function getTripsCloseToPoint(point) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.TRIP + '/closeToPoint/' + point.latitude + '/' + point.longitude
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise TRIP-Close-TO_Point: ' + res.data.length);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        };

        function getTripsRanking() {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.TRIPS_RANKING
            }).then(function successCallback(res) {
                defered.resolve(res.data);
                console.log('datos de promise TRIPS_RANKINGED: ' + res.data.length);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
            // var respuestaServidor = [
            //     // gales ruperto gim
            //     {
            //         "id": 1,
            //         "name": "Trayeco 1",
            //         "ranking": "700",
            //         "pointIni": {
            //             "latitude": -42.78310326285499,
            //             "longitude": -65.07063663717577
            //         },
            //         "pointFinal": {
            //             "latitude": -42.78169277769997,
            //             "longitude": -65.0664094757683
            //         }
            //     },
            //     // gales periodista
            //     {
            //         "id": 2,
            //         "name": "Trayeco 2",
            //         "ranking": "1000",
            //         "pointIni": {
            //             "latitude": -42.78169277769997,
            //             "longitude": -65.0664094757683
            //         },
            //         "pointFinal": {
            //             "latitude": -42.787645535040284,
            //             "longitude": -65.06263292547533
            //         }
            //     },
            //     // periodista alem
            //     {
            //         "id": 3,
            //         "name": "Trayeco 3",
            //         "ranking": "1200",
            //         "pointIni": {
            //             "latitude": -42.787645535040284,
            //             "longitude": -65.06263292547533
            //         },
            //         "pointFinal": {
            //             "latitude": -42.78406292559168,
            //             "longitude": -65.05197919126817
            //         }
            //     }
            //     //alem buenos aires
            // ];
            //
            // var res2 = [{
            //         "id": 0,
            //         "name": "Trayecto 1",
            //         "description": "El trayecto 1",
            //         "ponderacion": 5,
            //         "geom": {
            //             "type": "LineString",
            //             "coordinates": [
            //                 [-65.07063663717577, -42.78310326285499],
            //                 [-65.0664094757683, -42.78169277769997]
            //             ]
            //         },
            //         "created_at": "2017-05-26 23:21:42",
            //         "updated_at": "2017-05-26 23:21:42"
            //     },
            //     {
            //         "id": 1,
            //         "name": "Trayecto 2",
            //         "description": "El trayecto 2",
            //         "ponderacion": 7,
            //         "geom": {
            //             "type": "LineString",
            //             "coordinates": [
            //                 [-65.0664094757683, -42.78169277769997],
            //                 [-65.06263292547533, -42.787645535040284]
            //             ]
            //         },
            //         "created_at": "2017-05-26 23:21:42",
            //         "updated_at": "2017-05-26 23:21:42"
            //     },
            //     {
            //         "id": 2,
            //         "name": "Trayecto 3",
            //         "description": "El trayecto 3",
            //         "ponderacion": 1,
            //         "geom": {
            //             "type": "LineString",
            //             "coordinates": [
            //                 [-65.06263292547533, -42.787645535040284],
            //                 [-65.05197919126817, -42.78406292559168],
            //             ]
            //         },
            //         "created_at": "2017-05-26 23:21:42",
            //         "updated_at": "2017-05-26 23:21:42"
            //     }
            // ] // fin res2
            // return res2;
        };

        function getTripsToDistance(longMin, longMax) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.TRIP + '/toDistance/' + longMin + '/' + longMax
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise de DISTANCE TRIP: ' + res.data.length);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        };

        function getTripsBetweenZones(idOrigin, idDestination) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.TRIP + '/getTripsByOriginDestinationZone/' + idOrigin + '/' + idDestination
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise de Trips_BetweentZones: ' + res.data.length);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        };


        function getTripsToCentrality(latitude, longitude) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.TRIP + '/closeToCentrality/' + latitude + '/' + longitude
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise de CENTRALITY : ' + res.data.length);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        };
    }
})()
