// Responsabilidad : se ocupa de ser interface entra la grafica y la logica de las trayectos
// en este caso se ocupa de ocultar o mostrar dichos recorridos.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvViewJourney', ['srvViewFeature','creatorStyle','creatorColor', SrvViewJourney]);

    function SrvViewJourney(srvViewFeature,creatorStyle,creatorColor) {

        var service = {
            viewJourney: viewJourney,
            addJourneys: addJourneys,
        };

        return service;

        // permite la visualizacion del feature por Id en la capa
        function viewJourney(journeyJson, layer) {
            srvViewFeature.viewFeature(journeyJson, layer,null);
        };

        // agrega recorridos a partir de los datos recuperados del servidor a la capa recibida
        function addJourneys(journeysJson, layer) {
          for (var i = 0; i < journeysJson.length; i++) {
              srvViewFeature.addFeature(journeysJson[i],layer ,creatorStyle.getStyleTrip(creatorColor.getRandomColor(),3));
          }
        }

    } // Fin SrvViewtriP

})()
