// Creacion de los dibujos de las zonas
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('dataServer', ['$http', '$q', 'path' ,dataServer]);

        function dataServer($http, $q, path){
            var service = {
                getCentralities: getCentralities,
                getZones: getZones
            };
            return service;


            function getCentralities() {
                var defered = $q.defer();
                var promise = defered.promise;

                $http({
                    method: 'GET',
                    url: path.CENTRALITY
                }).then(function successCallback(res) {
                            defered.resolve(res.data);
                            console.log('datos de promise CENTRALITY: '+res.data);
                        },
                        function errorCallback(err) {
                            defered.reject(err)
                        }
                    );

                return promise;
            };

            // dado los puntos de una zona, devuelve un vector con esos puntos
            function getZones() {
                var defered = $q.defer();
                var promise = defered.promise;

                $http({
                    method: 'GET',
                    url: path.ZONE
                }).then(function successCallback(res) {
                            defered.resolve(res.data);
                            console.log('datos de promise ZONES: '+res.data);
                        },
                        function errorCallback(err) {
                            defered.reject(err)
                        }
                    );

                return promise;
            };
        }

})()
