// Creacion de mapa
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvLayersCentrality', ['srvLayers', SrvLayersCentrality]);

    function SrvLayersCentrality(srvLayers) {

        var centralitiesJson = [];
        var centralitiesLayer = null;

        var service = {
            getCentralities: getCentralities,
            setCentralities: setCentralities,
            getCentralitiesLayer: getCentralitiesLayer,
            setCentralitiesLayer: setCentralitiesLayer,
            filterCentrality: filterCentrality,
        };

        return service;

        function getCentralities() {
            return centralitiesJson;
        }

        function setCentralities(centralities) {
            centralitiesJson = centralities;
        }

        function getCentralitiesLayer() {
            return centralitiesLayer;
        }

        function setCentralitiesLayer(layer) {
            centralitiesLayer = layer;
        }

        function filterCentrality(data) {
            centralitiesJson = centralitiesJson.filter((item) => item.id !== data.id);
            console.log(centralitiesJson);
        }

    }

})()
