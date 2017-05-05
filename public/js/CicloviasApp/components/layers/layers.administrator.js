// Servicio encargado de devolver un vector con la info necesarias de las zonas para su visualizacion
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('adminLayers', ['creatorPoints', 'srvLayers', adminLayers]);

    function adminLayers(creatorPoints, srvLayers) {
        var service = {
            viewLayer: viewLayer,
            viewLayerGroup: viewLayerGroup,
            findLayerZone: findLayerZone,
            viewCentrality: viewCentrality,
            addCentralities: addCentralities,
            addTrips: addTrips,
            enableAllZone: enableAllZone,
            disableAllZone: disableAllZone
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

        // busca una capa dentro de un grupo de capas (por medio del nombre)
        // si no encuentra la capa devuelve null
        function findLayerZone(nameZone, groupLayer) {
            console.log("entro a buscar la zona!!");
            var layerZones = groupLayer.getLayers().getArray();
            var name;
            var layer = null;

            for (var i = 0; i < layerZones.length; i++) {
                name = layerZones[i].getStyle().getText().getText();
                if (angular.equals(name, nameZone)) {
                    console.log("Se encontro la zona, service.");
                    layer = layerZones[i];
                }
            }
            return layer;
        };


                // busca una capa dentro de un grupo de capas (por medio del nombre)
                // si no encuentra la capa devuelve null
                function disableAllZone(groupLayer) {
                    console.log("entro a todas las zonas!!");
                    var layerZones = groupLayer.getLayers().getArray();
                    var layer = null;

                    for (var i = 0; i < layerZones.length; i++) {
                        layerZones[i].setVisible(false);
                        console.log("zona "+i+" visible: "+layerZones[i].getVisible());
                    }
                };

                // busca una capa dentro de un grupo de capas (por medio del nombre)
                // si no encuentra la capa devuelve null
                function enableAllZone(groupLayer) {
                    console.log("entro a todas las zonas!!");
                    var layerZones = groupLayer.getLayers().getArray();

                    console.log("cant de zonas de groupLayer: "+layerZones.length);
                    for (var i = 0; i < layerZones.length; i++) {
                        layerZones[i].setVisible(true);
                        console.log("zona "+i+" visible: "+layerZones[i].getVisible());
                    }
                };

        // busca una capa dentro de un grupo de capas (por medio del nombre)
        // si no encuentra la capa devuelve null
        function viewCentrality(centrality, layer) {

            var feacture = null;
            var feactures = layer.getSource().getFeatures();
            var object;
            for (var i = 0; i < feactures.length; i++) {
                object = feactures[i].get('object');
                if (angular.equals(centrality.id, object.id)) {
                    console.log("Se encontro la centralidad, service.");
                    feacture = feactures[i];
                    layer.getSource().removeFeature(feacture);
                    break;

                }
              }
                if (feacture == null) {
                    var point = creatorPoints.getPointCentrality(centrality);
                    layer.getSource().addFeature(point);
                }
                return feacture;

        }

        function addCentralities(centralitiesJson, layer) {
            var points = creatorPoints.getVectorPointCentralities(centralitiesJson);
            layer.getSource().addFeatures(points);
        }

        function addTrips(dataJsonTrips, layer){
            var vectorFeatureTrips = srvLayers.getVectorFeatures(dataJsonTrips);
            console.log("Nro de features: "+vectorFeatureTrips.length);
            layer.getSource().addFeatures(vectorFeatureTrips);
        }
    }

})()