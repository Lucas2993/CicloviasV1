// Responsabilidad : Contiene la informacion de las centralides y la capa que las contiene, este service permite
// compartir la lista de centralides entre distintos controladores.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvModelTrip', [SrvModelTrip]);

    function SrvModelTrip() {

        var tripJson = [];
        var tripLayer = null;

        var service = {
            getTrips: getTrips,
            setTrips: setTrips,
            getTripsLayer: getTripsLayer,
            setTripsLayer: setTripsLayer,
            filterTrips: filterTrips,
            getTrip: getTrip
        };

        return service;

        function getTrips() {
            return tripJson;
        }

        function setTrips(trips) {
            tripJson = trips;
        }

        function getTripsLayer() {
            return tripLayer;
        }

        function setTripsLayer(layer) {
            tripLayer = layer;
        }

        function getTrip(id){
            for(var i = 0 ; i < tripJson.length ; i++){
                if(tripJson[i].id == id ){
                  return tripJson[i];
                }
            }
            return null;
        }

        /**
        * Este metodo borra una centralidad de la lista de centralidades por su id
        */
        function filterTrips(id) {
            console.log("Cant de centralidades ANTES de borrar: "+tripJson.length);
            tripJson = tripJson.filter((item) => item.id !== id);
            console.log("Cant de centralidades DESPUES de borrar: "+tripJson.length);
        }
    }

})()
