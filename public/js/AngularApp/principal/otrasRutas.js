// declare a module
(function () {
	'use strict';
	angular.module('MyRoutes', [])
        .config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
                $routeProvider
                        .otherwise({
                            redirectTo: '/inicio'
                        });
            }]);
})();
