/* Modulo del mapa que permite la representacion del mismo en la pagina y que cuenta con los datos
   necesarios para esto */
(function () {
	'use strict';

  	angular.module('mapModule', [])
  		 .controller('MapController', ['$scope', MapController]);
     function MapController(vm){
         /* vm.map = {
           	   center: {
           			latitude: -42.77000141404137,
           			longitude: -65.0339126586914
           		},
           		zoom: 13,
           		options : {
           			scrollwheel: false
           		},
           		control: {}
          }; */
          vm.latitude = '-42.77000141404137';
          vm.longitude = '-65.0339126586914';
          vm.zoom = 13;

					vm.markers = [
						{
							lat : -42.7672777,
							lon : -65.036735,
							mensaje : "Plaza"
						},
						{
							lat : -42.7653271,
							lon : -65.0410575,
							mensaje : "Terminal"
						},
						{
							lat : -42.7859094,
							lon : -65.0057736,
							mensaje : "UNPSJB"
						}
					];
     }
})()
