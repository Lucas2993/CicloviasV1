// Servicio encargado de devolver un vector con la info necesarias de las zonas para su visualizacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('adminLayers', [ adminLayers]);

    function adminLayers() {
        var service = {
            viewLayer: viewLayer,
            viewLayerGroup: viewLayerGroup,
        };

        return service;

        // maneja la visualizacion de una capa
        function viewLayer(layer) {
            console.log("entro al admin de capas!!");
            if (layer.getVisible()) {
                layer.setVisible(false);
            } else {
                layer.setVisible(true);
            }
        };

        //TODO verificar si se va a usar
        // maneja la visualizacion de una capa
        function viewLayerGroup(layer, groupLayer) {
            console.log("entro al admin de capas!!");
            if (layer.getVisible()) {
                groupLayer.setVisible(false);
                layer.setVisible(false);
            } else {
                groupLayer.setVisible(true);
                layer.setVisible(true);
            }
        };

    } // fin Layer.Administrator

})()
