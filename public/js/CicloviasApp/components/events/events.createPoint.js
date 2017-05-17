(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('eventMousecontroller', ['$scope', 'creatorMap', EventMousecontroller]);

    function EventMousecontroller(vm, creatorMap) {

        // ********************* declaracion de variables y metodos *********************

        vm.map = creatorMap.getMap();

        // ******************************************************************************************

        // ************************ agrega el punto al mouse *******************************
        var features = new ol.Collection();
        var featureOverlay = new ol.layer.Vector({
        source: new ol.source.Vector({features: features}),
        // source: new ol.source.Vector(),
        style: new ol.style.Style({
          fill: new ol.style.Fill({
            color: 'rgba(255, 255, 255, 0.2)'
          }),
          stroke: new ol.style.Stroke({
            color: '#ffcc33',
            width: 2
          }),
          image: new ol.style.Circle({
            radius: 7,
            fill: new ol.style.Fill({
              color: '#ffcc33'
            })
          })
        })
      });
      featureOverlay.setMap(vm.map);

      var modify = new ol.interaction.Modify({
        features: features,
        // se debe presionar Shift para eliminar vertices ya creados
        deleteCondition: function(event) {
            console.log("entro a deleteCondition");
          return ol.events.condition.shiftKeyOnly(event) &&
              ol.events.condition.singleClick(event);
        }
      });
      vm.map.addInteraction(modify);
    //   vm.map.removeInteraction(modify);

    //   console.log(vm.map.getInteractions().a);
    //   console.log(vm.map.getInteractions().a.count);

      var draw; // global so we can remove it later
    //   var typeSelect = document.getElementById('type');

      function addInteraction() {
        draw = new ol.interaction.Draw({
          features: features,
          type: 'Point'
            // type: /** @type {ol.geom.GeometryType} */ (typeSelect.value)
        });
        console.log("Entro a addInteraction.");
        vm.map.addInteraction(draw);
      }

    //   typeSelect.onchange = function() {
    //     vm.map.removeInteraction(draw);
    //     addInteraction();
    //   };

      addInteraction();

    }

})()
