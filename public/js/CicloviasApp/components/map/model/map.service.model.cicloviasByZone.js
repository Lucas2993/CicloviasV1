// Responsabilidad : Contiene la informacion de los tramos y la capa que las contiene, crea una sola
// instancia de capa
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvModelCicloviasByZone', [SrvModelCicloviasByZone]);

    function SrvModelCicloviasByZone() {

        var cicloviasByZoneJson = [];
        var cicloviasByZoneLayer = null;

        var service = {
            getCicloviasByZone: getCicloviasByZone,
            setCicloviasByZone: setCicloviasByZone,
            getCicloviasByZoneLayer: getCicloviasByZoneLayer,
            setCicloviasByZoneLayer: setCicloviasByZoneLayer
            // filterCentrality: filterCentrality
        };

        return service;

        function getCicloviasByZone() {
            return cicloviasByZoneJson;
        }

        function setCicloviasByZone(ciclovias) {
            cicloviasByZoneJson = ciclovias;
        }

        function getCicloviasByZoneLayer() {
            return cicloviasByZoneLayer;
        }

        function setCicloviasByZoneLayer(layer) {
            cicloviasByZoneLayer = layer;
        }

        /**
        * Este metodo borra una centralidad de la lista de centralidades por su id
        */
        // function filterCentrality(id) {
        //     console.log("Cant de centralidades ANTES de borrar: "+centralitiesJson.length);
        //     centralitiesJson = centralitiesJson.filter((item) => item.id !== id);
        //     console.log("Cant de centralidades DESPUES de borrar: "+centralitiesJson.length);
        // }

    }

})()
