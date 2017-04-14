/* Modulo principal de la aplicacion con el ruteo general de la aplicacion */
(function () {
	'use strict';
	angular.module('routes', [])
		.config(['$routeProvider', '$locationProvider', '$windowProvider', function ($routeProvider, $locationProvider, $windowProvider) {
								var $window = $windowProvider.$get(); // Se obtiene $window para poder usar location.
								// Se obtiene la ruta base (siempre descartando index.php si estuviera debido a que
								// no es una carpeta valida).
								var base_route = $window.location.pathname.split('index.php')[0];

								$routeProvider
                        .when('/login', {
                            templateUrl: base_route + 'js/CicloviasApp/components/login_register/loginView.html'
                        })
                        .when('/register', {
                            templateUrl: base_route + 'js/CicloviasApp/components/login_register/registerView.html'
                        })
                        .when('/map', {
                            templateUrl: base_route + 'js/CicloviasApp/components/map/mapView.html',
                            controller: 'MapController'
                        })
												.when('/home', {
                            templateUrl: base_route + 'js/CicloviasApp/components/home/homeView.html'
                        })
                        .otherwise({
                            redirectTo: '/home'
                        });
            }]);
})()
