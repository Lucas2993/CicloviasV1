(function() {
    'use strict';
    angular.module('mapModule')
        .factory('MapSrv', ['$http', function($http) {

            return {

                findAllCentralities: function(callback) {
                    $http.get('api/centrality')
                        .then(
                            function(res) {
                                return callback(false, res.data)
                            },
                            function(err) {
                                return callback(err.data)
                            }
                        )
                },

                findAllZones: function(callback) {
                    $http.get('api/zone')
                        .then(
                            function(res) {
                                return callback(false, res.data)
                            },
                            function(err) {
                                return callback(err.data)
                            }
                        )
                }

            }
        }])
})()
