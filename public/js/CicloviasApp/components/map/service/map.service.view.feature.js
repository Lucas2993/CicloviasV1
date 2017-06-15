// Responsabilidad : Se ocupa de mostrar y ocultar features, estas funciones son genericas ya que pueden
// recibir cualquier tipo geometry,
// Lo recomendado es crear un service para tipo de geometry ( centrality, trip, journey)
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvViewFeature', ['creatorFeature', SrvViewFeature]);

    function SrvViewFeature(creatorFeature) {

        var service = {
            viewFeature: viewFeature,
            addFeature: addFeature,
            removeFeature : removeFeature,

        };

        return service;

        // permite la visualizacion del feature por Id en la capa
        function viewFeature(featureJson, layer,style) {
            var feature = removeFeature(featureJson,layer);
            // si no se encontro el feature se lo muestra
            if (feature == null) {
              addFeature(featureJson, layer, style);
            }
        };

        function removeFeature(featureJson, layer){
          // buscamos el feature para de la capa o agregarlo
          var feature = null;
          var features = layer.getSource().getFeatures();
          for (var i = 0; i < features.length; i++) {
              if (angular.equals(features[i].getId(), featureJson.id)) {
                  feature = features[i];
                  // removeFeature(feature, layer);
                    layer.getSource().removeFeature(feature);
                  break;
              }
          }
          return feature;
        }

        function  addFeature(featureJson, layer, style ) {
            var newFeature = creatorFeature.getFeature(featureJson.geom ,featureJson.id , style );
            layer.getSource().addFeature(newFeature);
        }

    } // FIn SrvViewtriP

})()
