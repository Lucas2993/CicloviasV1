
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
              // gales ruperto gim
                {"id":1,"name":"Trayeco 1","ranking":"700", "pointIni":{"latitude":-42.78310326285499,"longitude":-65.07063663717577}, "pointFinal":{"latitude":-42.78169277769997,"longitude":-65.0664094757683}},
                // gales periodista
                {"id":2,"name":"Trayeco 2","ranking":"1000", "pointIni":{"latitude":-42.78169277769997,"longitude":-65.0664094757683}, "pointFinal":{"latitude":-42.787645535040284,"longitude":-65.06263292547533}},
                // periodista alem
                {"id":3,"name":"Trayeco 3","ranking":"1200", "pointIni":{"latitude":-42.787645535040284,"longitude":-65.06263292547533}, "pointFinal":{"latitude":-42.78406292559168,"longitude":-65.05197919126817}}
                //alem buenos aires
            ];
            return respuestaServidor;
        };

        function getTripsToDistance(longMin,longMax) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http({
                method: 'GET',
                url: path.TRIP + '/toDistance/'+ longMin + '/' + longMax
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
