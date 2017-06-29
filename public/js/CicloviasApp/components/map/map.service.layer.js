// Responsabilidad : Creacion de las capas
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('srvLayers', [ srvLayers ]);

        function srvLayers(creatorStyle){

            // ********************** DECLARACION FUNCIONES PUBLICAS ************************
            var service = {
                getLayerTile: getLayerTile,
                getLayer : getLayer,
            };

            return service;

            // *************************** FUNCIONES PUBLICAS *******************************
            // crea y devuelve una capa del tipo Tile
            function getLayerTile () {
              var layer = new ol.layer.Tile({
                        // determina el render de la capa
                      source: new ol.source.OSM()
                  });
              return layer;
            };

            function getLayer ( geomList ) {
                var sourceVector = new ol.source.Vector({
                    features: geomList
                });
                var layerVector = new ol.layer.Vector({
                    source: sourceVector
                });
                return layerVector;
            };

        }// Fin srvLayers

})()
