// Responsabilidad : Se ocupa de ser interface entra la grafica y la logica de las centralides
// en este caso se ocupa de ocultar o mostrar centralidades
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvViewCentrality', ['srvViewFeature','creatorStyle', SrvViewCentrality]);

    function SrvViewCentrality(srvViewFeature,creatorStyle) {

        var service = {
            viewCentrality: viewCentrality,
            addCentralities: addCentralities,
        };

        return service;


        // Este metodo hace un toogle de una centralidad
        function viewCentrality(centralityJson, layer) {

            srvViewFeature.viewFeature(centralityJson, layer,creatorStyle.getStyleCentrality() );
        }

        // agrega centralidades a partir de los datos recuperados del servidor a la capa recibida
        function addCentralities(centralitiesJson, layer) {
            for (var i = 0; i < centralitiesJson.length; i++) {
                srvViewFeature.addFeature(centralitiesJson[i],layer ,creatorStyle.getStyleCentrality());
            }
        }

    } // FIn SrvViewCentrality

})()
