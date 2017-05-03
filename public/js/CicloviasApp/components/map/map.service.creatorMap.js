// Creacion de mapa
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('creatorMap', ['propiertiesMap', creatorMap]);

        function creatorMap(propiertiesMap){
            var service = {
                getMap: getMap
            };
            return service;

            // crea y devuelve una capa del tipo Tile
            function getMap () {
                  var OSMLayer = new ol.layer.Tile({
                          source: new ol.source.OSM()
                  });

                  var map = new ol.Map({
                          layers: [OSMLayer],
                          target: 'map',
                          view: new ol.View({
                              projection: propiertiesMap.PROJECTION,
                              center: [propiertiesMap.LONG_CENTER, propiertiesMap.LAT_CENTER],
                              zoom: propiertiesMap.ZOOM
                          })
                      });
                  return map;
            };
        }

})()
