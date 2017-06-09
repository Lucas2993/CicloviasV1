// Responsabilidad : se ocupa de ser interface entra la grafica y la logica de las recorridos
// en este caso se ocupa de ocultar o mostrar dichos recorridos.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvViewTrip', ['srvViewFeature','creatorStyle','creatorColor', SrvViewTrip]);

    function SrvViewTrip(srvViewFeature,creatorStyle,creatorColor) {

        var service = {
            addTrips: addTrips,
            viewTrip: viewTrip
        };

        return service;

        // permite la visualizacion del feature por Id en la capa
        function viewTrip(tripJson, layer) {
            srvViewFeature.viewFeature(tripJson, layer,null);
        };

        // agrega recorridos a partir de los datos recuperados del servidor a la capa recibida
        function addTrips(tripsJson, layer) {
          for (var i = 0; i < tripsJson.length; i++) {
              srvViewFeature.addFeature(tripsJson[i],layer ,creatorStyle.getStyleTrip(creatorColor.getRandomColor(),3));
          }
        }

    } // Fin SrvViewtriP

})()
