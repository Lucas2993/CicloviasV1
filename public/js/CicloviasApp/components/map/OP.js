/* Modulo del mapa que permite la representacion del mismo en la pagina y que cuenta con los datos
   necesarios para esto - OpenLayers */
(function () {
	'use strict';

  	angular.module('mapModule', [])
  		 .controller('MapOpenLayerController', ['$scope', MapOpenLayerController]);

           function MapOpenLayerController(vm){

               vm.nombre = "Controlador OpenLayers Capas";

               var punto1 = new ol.Feature({
                 geometry: new ol.geom.Point([-65.0339126586914, -42.77000141404137])
               });

               var punto2 = new ol.Feature({
                 geometry: new ol.geom.Point([-65.0409124, -42.7593809])
               });

               var punto3 = new ol.Feature({
                 geometry: new ol.geom.Point([-65.0607623, -42.7804549])
               });

               var iconStyle = new ol.style.Style({
               //   image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                  image: new ol.style.Icon(({
                   anchor: [0.5, 46],
                   anchorXUnits: 'fraction',
                   anchorYUnits: 'pixels',
                   src: 'https://openlayers.org/en/v4.1.0/examples/data/icon.png'
                 }))
               });

               punto1.setStyle(iconStyle);
               punto2.setStyle(iconStyle);
               punto3.setStyle(iconStyle);

               var puntosCentralidades = new ol.source.Vector({
                 features: [punto1, punto2,punto3]
               });

               vm.capaCentralidades = new ol.layer.Vector({
                 source: puntosCentralidades
               });

               var capaMapaFondo = new ol.layer.Tile({
                  source: new ol.source.OSM()
               });

               var capas = [capaMapaFondo, vm.capaCentralidades];

             vm.map = new ol.Map({
               // layers: [
               //  new ol.layer.Tile({
               //     source: new ol.source.OSM()
               //  }),
               //  capa1,
               //  capa2
               // ],

               layers: capas,

               target: 'map',
               view: new ol.View({
                projection: 'EPSG:4326',
                center: [-65.0339126586914, -42.77000141404137],
                zoom: 13
               })
             });

             vm.verCapaCentralidades = function(){
                if(vm.capaCentralidades.getVisible()){
                   vm.capaCentralidades.setVisible(false);
                }
                else{
                   vm.capaCentralidades.setVisible(true);
                }
             };

            //  vm.layerSwitcher = new ol.control.LayerSwitcher({
            //     tipLabel: 'Capas'
   			//  });
            //  map.addControl(layerSwitcher);
   			//  layerSwitcher.showPanel();

           }

})()


vm.generatePoint = function(lon, lat) {
    var punto = new ol.Feature({
        geometry: new ol.geom.Point([lon, lat])
    });
    punto.setStyle(iconStyle);
    return punto;
}


        vm.generateCentralities = function() {
            var vector = [];
            for (var i = 0; i < vm.centralities.length; i++) {
                console.log(vm.centralities.length);
                vector.push(vm.generatePoint(vm.centralities[i].point.longitude, vm.centralities[i].point.longitude));
            }
            var pointsOSM = new ol.source.Vector({
                features: vector
            });

            vm.capaCentralidades = new ol.layer.Vector({
                source: pointsOSM
            });
            vm.capas = [capaMapaFondo, capaCentralidades];
        }
