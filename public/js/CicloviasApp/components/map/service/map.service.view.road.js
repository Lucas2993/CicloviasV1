// Responsabilidad : se ocupa de ser interface entra la grafica y la logica de las trayectos
// en este caso se ocupa de ocultar o mostrar dichos recorridos.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvViewRoad', ['srvViewFeature','creatorStyle','creatorColor', SrvViewRoad]);

    function SrvViewRoad(srvViewFeature,creatorStyle,creatorColor) {

        var service = {
            viewRoad: viewRoad,
            addAll: addAll,
            addRoad: addRoad,
            toogleAll : toogleAll,

        };

        return service;

        // permite la visualizacion del feature por Id en la capa
        function viewRoad(roadJson, layer) {
            srvViewFeature.viewFeature(roadJson, layer,creatorStyle.getStyleTrip(creatorColor.getRandomColor(),3));
        };

        // agrega recorridos a partir de los datos recuperados del servidor a la capa recibida
        function addAll(roadsJson, layer) {
          for (var i = 0; i < roadsJson.length; i++) {
              srvViewFeature.addFeature(roadsJson[i],layer ,creatorStyle.getStyleTrip(creatorColor.getRandomColor(),3));
          }
        }

        function addRoad(roadsJson, layer) {
            srvViewFeature.addFeature(roadsJson,layer,creatorStyle.getStyleTrip(creatorColor.getRandomColor(),3));
        }

        function toogleAll(isSelectedAllFeatures, featuresJson , layer ){
          return srvViewFeature.toogleAllFeatures(isSelectedAllFeatures, featuresJson , layer ,this);
        }

    } // Fin SrvViewRoad

})()
