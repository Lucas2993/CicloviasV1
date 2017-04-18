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
            centralitiesValue: false,
            zonesValue : false
        };

        // Capa basica del mapa brindado por OSM
        var OSMLayer = new ol.layer.Tile({
            source: new ol.source.OSM()
        });

        // Cronstructor de mapa base
        vm.map = new ol.Map({
            layers: [OSMLayer],
            target: 'map',
            view: new ol.View({
                projection: 'EPSG:4326',
                center: [-65.0339126586914, -42.77000141404137],
                zoom: vm.zoom
            })
        });


        // Busca todas las centralidades de la BD
        vm.findAllCentralities = function() {
            service.findAllCentralities(function(err, res) {
                if (err) {
                    return alert('Ocurrió un error buscando las centralidades: ' + err)
                }
                console.log(res);
                vm.centralitiesJson = res;
                vm.generateCentralitiesPoints(vm.centralitiesJson);
            });
        }

        vm.findAllZones = function() {
            service.findAllZones(function(err, res) {
                if (err) {
                    return alert('Ocurrió un error buscando las zonas: ' + err)
                }
                console.log(res);
                // vm.centralitiesJson = res;
                // vm.generateCentralitiesPoints(vm.centralitiesJson);
            });
        }

        vm.findAllCentralities();
        vm.findAllZones();


        // Estilo de los iconos de una centralidad
        var iconStyle = new ol.style.Style({
            //   image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
            image: new ol.style.Icon(({
                anchor: [0.5, 46],
                anchorXUnits: 'fraction',
                anchorYUnits: 'pixels',
                src: 'https://openlayers.org/en/v4.1.0/examples/data/icon.png'
            }))
        });

        // Contructor de punto perteneciente a un mapa de OSM
        vm.generatePoint = function(lon, lat) {
            return new ol.Feature({
                geometry: new ol.geom.Point([lon, lat])
            });
        }

//      Generacion de Capa de Centralidades a partir del json recibido desde el service
        vm.generateCentralitiesPoints = function(centralitiesJson) {
            var vector = [];
            var point;
            // Recorre el json, mientras va generando puntos y los agrega a un vector
            for (var i = 0; i < centralitiesJson.length; i++) {
                point = vm.generatePoint(centralitiesJson[i].point.longitude, centralitiesJson[i].point.latitude);
                point.setStyle(iconStyle);
                vector.push(point);
            }
            var centralitiesPoints = new ol.source.Vector({
                features: vector
            });
            vm.centralitiesLayer = new ol.layer.Vector({
                source: centralitiesPoints
            });
            // Se agrega la capa de Centralidades al mapa
            vm.map.addLayer(vm.centralitiesLayer);
            vm.centralitiesLayer.setVisible(false);
        }

        // Toogle de capa de centralidades
        vm.toogleCentralitiesLayer = function() {
            if (vm.centralitiesLayer.getVisible()) {
                vm.centralitiesLayer.setVisible(false);
            } else {
                vm.centralitiesLayer.setVisible(true);
            }
        }
        // Toogle de capa de zonas
        vm.toogleZonesLayer = function() {
            console.log("zones");
        }

    } // fin Constructor
})()
