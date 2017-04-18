(function() {
    'use strict';
    angular.module('mapModule')
        .factory('MapSrv', ['$http', function($http) {

            return {

                findAll: function(callback) {
                    $http.get('http://localhost/CicloviasV1/public/api/centrality')
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
