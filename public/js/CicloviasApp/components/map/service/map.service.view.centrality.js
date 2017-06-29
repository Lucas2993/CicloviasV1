// Responsabilidad : Se ocupa de ser interface entra la grafica y la logica de las centralides
// en este caso se ocupa de ocultar o mostrar centralidades
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvViewCentrality', ['srvViewFeature','creatorStyle', 'srvPathImageTypeCentrality', SrvViewCentrality]);

    function SrvViewCentrality(srvViewFeature,creatorStyle, servPathIcons) {

        var service = {
            viewCentrality: viewCentrality,
            addCentralities: addCentralities,
        };

        return service;


        // Este metodo hace un toogle de una centralidad
        function viewCentrality(centralityJson, layer) {
            var typeCentrality = servPathIcons.getPathType(centralityJson.type);
            srvViewFeature.viewFeature(centralityJson, layer,creatorStyle.getStyleCentrality(typeCentrality));
        }

        // agrega centralidades a partir de los datos recuperados del servidor a la capa recibida
        function addCentralities(centralitiesJson, layer) {
            var typeCentrality;
            for (var i = 0; i < centralitiesJson.length; i++) {
                typeCentrality = servPathIcons.getPathType(centralitiesJson[i].type);
                srvViewFeature.addFeature(centralitiesJson[i], layer,creatorStyle.getStyleCentrality(typeCentrality));
            }
        }

    } // FIn SrvViewCentrality

})()
