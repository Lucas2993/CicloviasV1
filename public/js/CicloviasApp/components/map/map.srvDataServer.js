// factory que se encarga de recuperar los datos del servidor demandados por la aplicacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')

        .factory('MapSrv', ['$http','path', MapSrv]);

        function MapSrv($http, path){
            var service = {
                findAllCentralities: findAllCentralities,
                findAllZones: findAllZones
            };
            return service;

            function findAllCentralities (callback) {
                        $http.get(path.CENTRALITY)
                            .then(
                                function(res) {
                                    return callback(false, res.data)
                                },
                                function(err) {
                                    return callback(err.data)
                                }
                            )
            };

            function findAllZones (callback) {
                        $http.get(path.ZONE)
                            .then(
                                function(res) {
                                    return callback(false, res.data)
                                },
                                function(err) {
                                    return callback(err.data)
                                }
                            )
            };
        }

})()
