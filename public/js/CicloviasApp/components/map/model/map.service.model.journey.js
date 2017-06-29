// Responsabilidad : Contiene la informacion de los trayectos y la capa que las contiene, este service permite
// compartir la lista de trayectos entre distintos controladores.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvModelJourney', [SrvModelJourney]);

    function SrvModelJourney() {

        var journeyJson = [];
        var journeyLayer = null;
        var journeysWanted = false;

        var service = {
            getJourneys: getJourneys,
            setJourneys: setJourneys,
            getJourneysLayer: getJourneysLayer,
            setJourneysLayer: setJourneysLayer,
            filterJourneys: filterJourneys,
            getJourney: getJourney,
            isJourneysWanted: isJourneysWanted,
            setJourneysWanted: setJourneysWanted,

        };

        return service;

        function getJourneys() {
            return journeyJson;
        }

        function setJourneys(journeys) {
            journeyJson = journeys;
        }

        function getJourneysLayer() {
            return journeyLayer;
        }

        function setJourneysLayer(layer) {
            journeyLayer = layer;
        }

        function getJourney(id){
            for(var i = 0 ; i < journeyJson.length ; i++){
                if(journeyJson[i].id == id ){
                  return journeyJson[i];
                }
            }
            return null;
        }

        /**
        * Este metodo borra una centralidad de la lista de centralidades por su id
        */
        function filterJourneys(id) {
            console.log("Cant de centralidades ANTES de borrar: "+journeyJson.length);
            journeyJson = journeyJson.filter((item) => item.id !== id);
            console.log("Cant de centralidades DESPUES de borrar: "+journeyJson.length);
        }

        function isJourneysWanted() {
          return journeysWanted;
        }

        // Verdadero cuando los recorridos ya fueron buscados en el servidor
        function setJourneysWanted( value ){
          journeysWanted = value;
        }
    }

})()
