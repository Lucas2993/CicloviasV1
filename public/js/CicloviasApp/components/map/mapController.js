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
        // Busca todas las zonas de la BD
        vm.findAllZones = function() {
            service.findAllZones(function(err, res) {
                if (err) {
                    return alert('Ocurrió un error buscando las zonas: ' + err)
                }
                console.log(res);
                vm.zonesJson = res;
                vm.createLayerZone(res);
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
          if (vm.zonesLayer.getVisible()) {
              vm.zonesLayer.setVisible(false);
          } else {
              vm.zonesLayer.setVisible(true);
          }
            console.log("zones");
        }

        //*************************** AGREGAR *****************************************
        vm.getStyleText = function(nameZone){
           return new ol.style.Text({
              text: nameZone});
        }

        vm.getPolygonLayer = function(style){
           return new ol.style.Style({
            stroke: new ol.style.Stroke({
              color: 'blue',
              width: 1
            }),
            fill: new ol.style.Fill({
              color: 'rgba(0, 0, 255, 0.1)'
            }),
            text: style
          });
        }

        vm.getLayerZones = function(vectorZone, styleZone){
           return new ol.layer.Vector({
               source: new ol.source.Vector({
                   features: vectorZone
               }),
               style: styleZone
           });
        }

        vm.getPointZone = function(lon, lat) {
           var point = [lon, lat];
             return point;
         }

         console.log(vm.getPointZone(-65.057715, -42.7814254));

         // recupera solo la long y lat de los puntos recibidos
         vm.getVectorPointZone = function(pointsZone){
            var vectorPointsZone = [];
            for (var i = 0; i < pointsZone.length; i++) {
               vectorPointsZone.push(vm.getPointZone(pointsZone[i].longitude,pointsZone[i].latitude));
            }
            vectorPointsZone.push(vm.getPointZone(pointsZone[0].longitude,pointsZone[0].latitude));
            return vectorPointsZone;
         }

          // Recupera los datos necesarios recibidos del servidor para contruir el dibujo de la zona
         vm.getInfoZone = function(dateZonesJson) {
            var vectorInfoZone = [];
            var vectorPointsZone = [];
            for (var i = 0; i < dateZonesJson.length; i++) {
               vectorPointsZone = vm.getVectorPointZone(dateZonesJson[i].points);
                var infoZone = new Object();
                infoZone.name = dateZonesJson[i].name;
                infoZone.points = vectorPointsZone;
               vectorInfoZone.push(infoZone);
            }
             return vectorInfoZone;
         }

          //  trae los dibujos(polygon) necesarios para mostrar las zonas
         vm.getDrawsZone = function(infoZone) {
             var vectorDrawsZone = [];
             for (var i = 0; i < infoZone.length; i++) {
                var draw = new ol.Feature({
                   geometry: new ol.geom.Polygon([
                           infoZone[i].points
                   ])
               });
               vectorDrawsZone.push(draw);
             }
             return vectorDrawsZone;
         }

         // se recibe solo la info necesaria de cada zona para realizar el grafico
         vm.createLayerZone = function(infoServer) {
            // recuperams solo los datos que nos interesan
            var infoZones = vm.getInfoZone(infoServer);
            // console.log(infoZones[0].points);
            // 1ro determinamos el estilo del texto, con su info de cada zona(por ahora va ser el mismo para todos)
            var styleText = vm.getStyleText('ZONA');
            // una vez creado el estilo de texto vamos a creaer el estilo del polygono de cada zona
            var stylePolygon = vm.getPolygonLayer(styleText);
            // creamos los dibujos de cada zona (polygon)
            var vectorDrawsZone = vm.getDrawsZone(infoZones);
            // console.log('cant de polygonos: '+vectorDrawsZone.length);
            vm.zonesLayer = vm.getLayerZones(vectorDrawsZone, stylePolygon);
            // console.log(vm.zonesLayer);
            vm.map.addLayer(vm.zonesLayer);
            vm.zonesLayer.setVisible(false);
         }





    } // fin Constructor
})()
