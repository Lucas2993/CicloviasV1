// modulo principal con sus respectivas dependencias
// (function() {
'use strict';
var App= angular.module('cicloviasApp', [
    // Externos
    'ngSanitize',
    'ngRoute',
    'openlayers-directive',
    'ui.bootstrap',

    // Propios
    'navigationbar',
    'pagefooter',
    'routes',
    'mapModule'
]).config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}]).run(['$rootScope',
    function($rootScope) {
        $rootScope.title = "Ciclovias";
    }
])
// })();
