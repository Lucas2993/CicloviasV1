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
          vm.latitude = -42.77000141404137;
          vm.longitude = -65.0339126586914;
          vm.zoom = 13;
     }
})()
