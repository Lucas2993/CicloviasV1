/* Ruteo general de la aplicacion */
(function () {
	'use strict';
            angular.module('routes')
                        // a diferencia de los services, factories y controllers para hacer referencia a la funcion
                        // encargada de hacer la configuracion no se exponene las '' al inicio (el primer Routing)

                        .config(Routing, ['$routeProvider', '$locationProvider', '$windowProvider', 'path', Routing]);

                         function Routing($routeProvider, $locationProvider, $windowProvider, path) {
			var $window = $windowProvider.$get(); // Se obtiene $window para poder usar location.
			// Se obtiene la ruta base (siempre descartando index.php si estuviera debido a que no es una carpeta valida).
			var base_route = $window.location.pathname.split('index.php')[0];

                                    ruteo();

                                    function ruteo(){
                                                $routeProvider
                                                .when('/login', {
                                                    templateUrl: base_route + path.LOGIN_VIEW
                                                })
                                                .when('/register', {
                                                    templateUrl: base_route + path.REGISTER_VIEW
                                                })
                                                .when('/map', {
                                                    templateUrl: base_route + path.MAP_VIEW ,
                                                    controller: 'MapController'
                                                })
                                                .when('/home', {
                                                    templateUrl: base_route + path.HOME_VIEW
                                                })
                                                .otherwise({
                                                    redirectTo: '/home'
                                                });
                                    }
                        }

})()
