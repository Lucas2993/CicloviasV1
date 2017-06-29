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
            getTripsRankingByZone: getTripsRankingByZone,
            // Journey
            getJourneys: getJourneys,
            // roads
            getRoads: getRoads,


            // Centralidades
            getCentralities: getCentralities,
            saveCentrality: saveCentrality,
            updateCentrality: updateCentrality,
            deleteCentrality: deleteCentrality,
            getDataDashboard: getDataDashboard,
            saveTrip : saveTrip,
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

        function saveTrip(listPoint) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'POST',
                url: path.TRIP,
                data: listPoint
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

        function getRoads() {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.ROAD
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

        function getTripsRankingByZone(idZone){
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.TRIP + '/getTripsByZone/' + idZone
            }).then(function successCallback(res) {
                    defered.resolve(res.data);
                    console.log('datos de promise de Trips_ByZone: ' + res.data);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        }

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

        function getDataDashboard(servRest){
          var defered = $q.defer();
          var promise = defered.promise;

          $http({
            method: 'GET',
            url: path.DASHBOARD + servRest
          }).then( function successCallback(res){
              defered.resolve(res.data);
            },
            function errorCallback(err){
              defered.reject(err);
            }
          );
          return promise;
        }
    }
})()
