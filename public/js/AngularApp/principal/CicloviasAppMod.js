// modulo principal con sus respectivas dependencias
(function () {
	'use strict';
	angular.module('cicloviasApp', [
		//'ngAnimate',
		'ngSanitize',
		'ngRoute',
		'openlayers-directive',
		'ui.bootstrap',
		// 'MyRoutes',
		'Encabezado',
		'ruteoPrincipal',
		'mapModule',
		'UIBootstrapModule',
		// 'mapModule',
		// 'moduleAppServices',
		// 'adminModule',
		// 'puntosinterest'
	],function($interpolateProvider) {
			$interpolateProvider.startSymbol('[%');
			$interpolateProvider.endSymbol('%]');
		}).run(['$rootScope',
		function($rootScope){
			$rootScope.title = "-@- Ciclovias_OSM -@-";
		}])
})();
