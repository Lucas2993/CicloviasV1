// Servicio encargado de devolver un vector con la info necesarias de las zonas para su visualizacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('adminTrip', ['creatorFeature', adminTrip]);

    function adminTrip(creatorFeature) {
        var service = {
            viewTrip: viewTrip
        };

        return service;

        // permite la visualizacion del feature en la capa
        function viewTrip(tripJson, layer) {
            console.log("entro al admin de features!!");
            var feature = null;
            var features = layer.getSource().getFeatures();
            var idFeatureAux;

            // buscamos el feature para de la capa o agregarlo
            for (var i = 0; i < features.length; i++) {
                idFeatureAux = features[i].getId();
                if(angular.equals(idFeatureAux, tripJson.id)){
                    console.log("Se encontro el recorrido, adminTrip.");
                    feature = features[i];
                    layer.getSource().removeFeature(feature);
                    break;

                }
            }
            // si no se encontro el feature se lo muestra
            if (feature == null) {
                var trip = creatorFeature.getFeatureTripJson(tripJson);
                layer.getSource().addFeature(trip);
            }

        };
    }

})()
