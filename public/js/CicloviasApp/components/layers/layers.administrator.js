// Servicio encargado de devolver un vector con la info necesarias de las zonas para su visualizacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('adminLayers', [adminLayers]);

        function adminLayers(){
            var service = {
                viewLayer: viewLayer,
                findLayerZone: findLayerZone
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

            // busca una capa dentro de un grupo de capas (por medio del nombre)
            // si no encuentra la capa devuelve null
            function findLayerZone(nameZone, groupLayer) {
                console.log("entro a buscar la zona!!");
                var layerZones = groupLayer.getLayers().getArray();
                var name;
                var layer = null;

                for (var i = 0; i < layerZones.length; i++) {
                    name = layerZones[i].getStyle().getText().getText();
                    if(angular.equals(name, nameZone)){
                        console.log("Se encontro la zona, service.");
                        layer = layerZones[i];
                    }
                }
                return layer;
            };

        }

})()
