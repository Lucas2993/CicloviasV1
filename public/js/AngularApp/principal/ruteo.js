/* Modulo principal de la aplicacion con el ruteo general de la aplicacion */
(function () {
	'use strict';
	angular.module('ruteoPrincipal', [])
		.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
								var ruta = '/CicloviasV1/public/js/AngularApp/';
                $routeProvider
                        .when('/inicioSesion', {
                            templateUrl: ruta + 'templates/inicioSesion.html'
                        })
                        .when('/registro', {
                            templateUrl: ruta + 'templates/registro.html'
                        })
                        .when('/inicio', {
                            templateUrl: ruta + 'templates/home.html',
                            controller: 'MapController'
                        })
                        .otherwise({
                            redirectTo: '/inicio'
                        });
            }]);
})()
