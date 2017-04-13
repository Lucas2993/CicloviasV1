/* componente que representa el encabezado(llamado desde la vista por la directiva con su mismo nombre) con
    partial correspondiente */

(function () {
	'use strict';
	angular.module('navigationbar', [])
	.component('navigation', {
		templateUrl: '/CicloviasV1/public/js/CicloviasApp/shared/navigationbar/navigationbarView.html'
	})
})()
