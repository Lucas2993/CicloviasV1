// Responsabilidad : Contiene la informacion de las centralides y la capa que las contiene, este service permite
// compartir la lista de centralides entre distintos controladores.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvModelRoad', [SrvModelRoad]);

    function SrvModelRoad() {

        var roadsJson = [];
        var roadsLayer = null;
        var roadsWanted = false;

        var service = {
            getRoads: getRoads,
            setRoads: setRoads,
            getRoadsLayer: getRoadsLayer,
            setRoadsLayer: setRoadsLayer,
            getRoad: getRoad,
            filterRoad: filterRoad,
            isRoadsWanted: isRoadsWanted,
            setRoadsWanted: setRoadsWanted
        };

        return service;

        function getRoads() {
            return roadsJson;
        }

        function setRoads(roads) {
            roadsJson = roads;
        }

        function getRoadsLayer() {
            return roadsLayer;
        }

        function setRoadsLayer(layer) {
            roadsLayer = layer;
        }

        function getRoad(id){
            for(var i = 0 ; i < roadsJson.length ; i++){
                if(roadsJson[i].id == id ){
                  return roadsJson[i];
                }
            }
            return null;
        }

        /**
        * Este metodo borra una centralidad de la lista de centralidades por su id
        */
        function filterRoad(id) {
            console.log("Cant de centralidades ANTES de borrar: "+roadsJson.length);
            roadsJson = roadsJson.filter((item) => item.id !== id);
            console.log("Cant de centralidades DESPUES de borrar: "+roadsJson.length);
        }

        function isRoadsWanted(){
          return roadsWanted;
        }

        function setRoadsWanted( value ){
          roadsWanted = value;
        }
    }

})()
