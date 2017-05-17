
// Creacion de los dibujos de las zonas
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
    .factory('dataServer', ['$http', '$q', 'path', dataServer]);

    function dataServer($http, $q, path){
        var service = {
            // Zonas
            getZones: getZones,

            // Trips
            getTrips:getTrips,
            getTripsCloseToPoint:getTripsCloseToPoint,
            getTripsRanking: getTripsRanking,
            getTripsToDistance:getTripsToDistance,

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
                    console.log('datos de promise ZONES: ' + res.data);
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
                console.log('datos de promise CENTRALITY: ');
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
                url: path.CENTRALITY+'/'+centrality.id,
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
                url: path.CENTRALITY+'/'+centralityId,
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
                console.log('datos de promise TRIP: ' + res.data);
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
                console.log('datos de promise JOURNEY: ' + res.data);
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
                console.log('datos de promise TRIP: ' + res.data);
                },
                function errorCallback(err) {
                    defered.reject(err)
                }
            );
            return promise;
        };

        function getTripsRanking(){
            // var defered = $q.defer();
            // var promise = defered.promise;
            //
            // $http({
            //     method: 'GET',
            //     url: path.TRIPS_RANKING
            // }).then(function successCallback(res) {
            //     defered.resolve(res.data);
            //     console.log('datos de promise TRIPS_RANKING: ' + res.data);
            //     },
            //     function errorCallback(err) {
            //         defered.reject(err)
            //     }
            // );
            // return promise;
            var respuestaServidor = [
                {"id":1,"name":"Trayeco 1","ranking":"3", "pointIni":{"latitude":-42.79003768346739,"longitude":-65.02793149498143}, "pointFinal":{"latitude":-42.78993533003046,"longitude":-65.0268264248673}},
                {"id":2,"name":"Trayeco 2","ranking":"4", "pointIni":{"latitude":-42.78993533003046,"longitude":-65.0268264248673}, "pointFinal":{"latitude":-42.78983297642427,"longitude":-65.02563552406468}},
                {"id":3,"name":"Trayeco 3","ranking":"12", "pointIni":{"latitude":-42.78983297642427,"longitude":-65.02563552406468}, "pointFinal":{"latitude":-42.78975424276587,"longitude":-65.0245411827866}},
                {"id":4,"name":"Trayeco 4","ranking":"1", "pointIni":{"latitude":-42.78975424276587,"longitude":-65.0245411827866}, "pointFinal":{"latitude":-42.789675509007324,"longitude":-65.02331809547582}},
                {"id":5,"name":"Trayeco 5","ranking":"8", "pointIni":{"latitude":-42.789675509007324,"longitude":-65.02331809547582}, "pointFinal":{"latitude":-42.789533787989555,"longitude":-65.02181605842748}},
                {"id":6,"name":"Trayeco 6","ranking":"9", "pointIni":{"latitude":-42.789533787989555,"longitude":-65.02181605842748}, "pointFinal":{"latitude":-42.78940781347912,"longitude":-65.02029256370702}},
                {"id":7,"name":"Trayeco 7","ranking":"7", "pointIni":{"latitude":-42.78940781347912,"longitude":-65.02029256370702}, "pointFinal":{"latitude":-42.789281838712306,"longitude":-65.0187046959702}},
                {"id":8,"name":"Trayeco 8","ranking":"2", "pointIni":{"latitude":-42.789281838712306,"longitude":-65.0187046959702}, "pointFinal":{"latitude":-42.789155863689096,"longitude":-65.01740650680699}},
                {"id":9,"name":"Trayeco 9","ranking":"5", "pointIni":{"latitude":-42.789155863689096,"longitude":-65.01740650680699}, "pointFinal":{"latitude":-42.789045635333466,"longitude":-65.01615123298802}},
                {"id":10,"name":"Trayeco 10","ranking":"15", "pointIni":{"latitude":-42.789045635333466,"longitude":-65.01615123298802}, "pointFinal":{"latitude":-42.78891965982954,"longitude":-65.01485304382481}}
            ];
            return respuestaServidor;
        };

        function getTripsToDistance(long) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.TRIP + '/toDistance/'+ long
            }).then(function successCallback(res) {
                defered.resolve(res.data);
                console.log('datos de promise de DISTANCE TRIP: ' + res.data);
                },
                function errorCallback(err) {
                  defered.reject(err)
                }
            );
            return promise;
        };
    }
})()
