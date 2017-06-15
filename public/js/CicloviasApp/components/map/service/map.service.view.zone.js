// Responsabilidad : Se ocupa de ser interface entra la grafica y la logica de las centralides
// en este caso se ocupa de ocultar o mostrar centralidades
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvViewZone', ['srvViewFeature','creatorStyle', SrvViewZone]);

    function SrvViewZone(srvViewFeature,creatorStyle) {

        var service = {
            viewZone: viewZone,
            addZones: addZones,
            removeZone: removeZone,
            addZone: addZone,
        };

        return service;

        /*
         * Este metodo hace un toogle de una zona
         */
        function viewZone(zoneJson, layer) {
            var style = creatorStyle.getStylePolygon(zoneJson.color, creatorStyle.getStyleText(zoneJson.name));
            srvViewFeature.viewFeature(zoneJson, layer, style );
        }

        // agrega zonas a partir de los datos recuperados del servidor a la capa recibida
        function addZones(zonesJson, layer) {
            var style;
            for (var i = 0; i < zonesJson.length; i++) {
                style = creatorStyle.getStylePolygon(zonesJson[i].color, creatorStyle.getStyleText(zonesJson[i].name));
                srvViewFeature.addFeature(zonesJson[i],layer ,style );
            }
        }// fin addZones

        function removeZone(zoneJson , layer){
            srvViewFeature.removeFeature(zoneJson, layer);
        }

        function addZone(zoneJson, layer) {
            var style = creatorStyle.getStylePolygon(zoneJson.color, creatorStyle.getStyleText(zoneJson.name));
            srvViewFeature.addFeature(zoneJson,layer,style);
        }

        function addZone(zoneJson, layer, color ) {
          var style = creatorStyle.getStylePolygon(color, creatorStyle.getStyleText(zoneJson.name));
          srvViewFeature.addFeature(zoneJson,layer,style);
        }


    } // FIn SrvViewZone

})()
