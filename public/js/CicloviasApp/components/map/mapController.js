/* Modulo del mapa que permite la representacion del mismo en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';

    angular.module('mapModule', []).controller('MapController', ['$scope', 'MapSrv', MapController]);

    function MapController(vm, service) {

        vm.latitude = '-42.77000141404137';
        vm.longitude = '-65.0339126586914';
        vm.zoom = 13;
        // vector de centralidades recibido desde Service
        vm.centralitiesJson = [];

        // ngModel de checkbox
        vm.checkboxModel = {
            valueCentralities: false,
        };

        var capaMapaFondo = new ol.layer.Tile({
            source: new ol.source.OSM()
        });


        vm.map = new ol.Map({
            layers: [capaMapaFondo],
            target: 'map',
            view: new ol.View({
                projection: 'EPSG:4326',
                center: [-65.0339126586914, -42.77000141404137],
                zoom: vm.zoom
            })
        });


        // Busca todas las centralidades de la BD
        vm.findAll = function() {
            service.findAll(function(err, res) {
                if (err) {
                    return alert('Ocurrió un error buscando los puntos: ' + err)
                }
                console.log(res);
                vm.centralitiesJson = res;
                vm.generateCentralitiesPoints(vm.centralitiesJson);
            });
        }
        vm.findAll();

        var iconStyle = new ol.style.Style({
            //   image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
            image: new ol.style.Icon(({
                anchor: [0.5, 46],
                anchorXUnits: 'fraction',
                anchorYUnits: 'pixels',
                src: 'https://openlayers.org/en/v4.1.0/examples/data/icon.png'
            }))
        });


        vm.generatePoint = function(lon, lat) {
            return new ol.Feature({
                geometry: new ol.geom.Point([lon, lat])
            });
        }


        vm.generateCentralitiesPoints = function(centralitiesJson) {
            var vector = [];
            var punto;
            for (var i = 0; i < centralitiesJson.length; i++) {
                punto = vm.generatePoint(centralitiesJson[i].point.longitude, centralitiesJson[i].point.latitude);
                punto.setStyle(iconStyle);
                vector.push(punto);
            }
            var puntosCentralidades = new ol.source.Vector({
                features: vector
            });
            vm.capaCentralidades = new ol.layer.Vector({
                source: puntosCentralidades
            });
            vm.map.addLayer(vm.capaCentralidades);
            vm.capaCentralidades.setVisible(false);
        }

        // Toogle de capa de centralidades
        vm.verCapaCentralidades = function() {
            if (vm.capaCentralidades.getVisible()) {
                vm.capaCentralidades.setVisible(false);
            } else {
                vm.capaCentralidades.setVisible(true);
            }
        }

    } // fin Constructor
})()
