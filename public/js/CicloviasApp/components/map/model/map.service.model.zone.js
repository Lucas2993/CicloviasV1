// Responsabilidad : Contiene la informacion de las zonas y la capa que las contiene, este service permite
// compartir la lista de zonas entre distintos controladores.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvModelZone', [SrvModelZone]);

    function SrvModelZone() {

        var zoneJson = [];
        var zoneLayer = null;

        var service = {
            getZones: getZones,
            setZones: setZones,
            getZonesLayer: getZonesLayer,
            setZonesLayer: setZonesLayer,
            filterZone: filterZone,
            getZone: getZone
        };

        return service;

        function getZones() {
            return zoneJson;
        }

        function setZones(centralities) {
            zoneJson = centralities;
        }

        function getZonesLayer() {
            return zoneLayer;
        }

        function setZonesLayer(layer) {
            zoneLayer = layer;
        }

        function getZone(id){
            for(var i = 0 ; i < zoneJson.length ; i++){
                if(zoneJson[i].id == id ){
                  return zoneJson[i];
                }
            }
            return null;
        }

        /**
        * Este metodo borra una centralidad de la lista de centralidades por su id
        */
        function filterZone(id) {
            console.log("Cant de zonas ANTES de borrar: "+zoneJson.length);
            zoneJson = zoneJson.filter((item) => item.id !== id);
            console.log("Cant de zonas DESPUES de borrar: "+zoneJson.length);
        }

    }

})()
