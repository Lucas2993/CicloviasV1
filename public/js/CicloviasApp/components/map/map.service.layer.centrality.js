// Creacion de mapa
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvLayersCentrality', [srvLayersCentrality]);

    function srvLayersCentrality() {

        var centralitiesJson;

        var service = {
          getCentralities: getCentralities,
          setCentralities: setCentralities
        };

        return service;

        function getCentralities(){
          return centralitiesJson;
        }

        function setCentralities(centralities){
          centralitiesJson = centralities;
        }

    }

})()
