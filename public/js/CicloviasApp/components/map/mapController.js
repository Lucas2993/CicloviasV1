/* Modulo del mapa que permite la representacion del mismo en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';

    angular.module('mapModule', []).controller('MapController', ['$scope', 'MapSrv', MapController]);

    function MapController(vm, service) {
        vm.latitude = '-42.77000141404137';
        vm.longitude = '-65.0339126586914';
        vm.zoom = 13;
        vm.markers = [];

        vm.centrality = {
            id: null,
            location: '',
            name: '',
            geo_point: ''
        }

        vm.findAll = function() {
            service.findAll(function(err, res) {
                if (err) {
                    return alert('Ocurrió un error buscando un usuario: ' + err)
                }
                console.log(res);
                vm.markers = res;
            });
        }

        vm.findAll();

    } // fin Constructor
})()
