// Responsabilidad : Contiene la informacion de las centralides y la capa que las contiene, este service permite
// compartir la lista de centralides entre distintos controladores.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvModelCentrality', [SrvModelCentrality]);

    function SrvModelCentrality() {

        var centralitiesJson = [];
        var centralitiesLayer = null;
        var centralitiesWanted = false;

        var service = {
            getCentralities: getCentralities,
            setCentralities: setCentralities,
            getCentralitiesLayer: getCentralitiesLayer,
            setCentralitiesLayer: setCentralitiesLayer,
            getCentrality: getCentrality,
            filterCentrality: filterCentrality,
            isCentralitiesWanted: isCentralitiesWanted,
            setCentralitiesWanted: setCentralitiesWanted
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

        function getCentrality(id){
            for(var i = 0 ; i < centralitiesJson.length ; i++){
                if(centralitiesJson[i].id == id ){
                  return centralitiesJson[i];
                }
            }
            return null;
        }

        /**
        * Este metodo borra una centralidad de la lista de centralidades por su id
        */
        function filterCentrality(id) {
            console.log("Cant de centralidades ANTES de borrar: "+centralitiesJson.length);
            centralitiesJson = centralitiesJson.filter((item) => item.id !== id);
            console.log("Cant de centralidades DESPUES de borrar: "+centralitiesJson.length);
        }

        function isCentralitiesWanted(){
          return centralitiesWanted;
        }

        function setCentralitiesWanted( value ){
          centralitiesWanted = value;
        }
    }

})()
