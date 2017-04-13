/* Modulo principal de la aplicacion con el ruteo general de la aplicacion */
(function () {
	'use strict';
	angular.module('routes', [])
		.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
								var base_route = '/CicloviasV1/public/js/CicloviasApp/';
                $routeProvider
                        .when('/login', {
                            templateUrl: base_route + 'components/login_register/loginView.html'
                        })
                        .when('/register', {
                            templateUrl: base_route + 'components/login_register/registerView.html'
                        })
                        .when('/map', {
                            templateUrl: base_route + 'components/map/mapView.html',
                            controller: 'MapController'
                        })
												.when('/home', {
                            templateUrl: base_route + 'components/home/homeView.html'
                        })
                        .otherwise({
                            redirectTo: '/home'
                        });
            }]);
})()
