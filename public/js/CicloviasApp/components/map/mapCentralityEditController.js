/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapCentralityEditController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality','dataServer','adminLayers', MapCentralityEditController]);

    function MapCentralityEditController(vm, creatorMap, srvLayers, srvLayersCentrality ,dataServer,adminLayers) {

      // ********************* declaracion de variables y metodos *********************
      vm.map = creatorMap.getMap();

      // Lucas
      // Aca empieza lo que agregue para el ABM de centralidades.
      // Esta bandera se usa para saber si el usuario se encuentra seleccionando un punto para una nueva centralidad.
      // Incorporacion de agregar centralidad
      vm.isSelecting = false;

      // Modelo de una nueva centralidad (inicializacion).
      vm.newCentrality = {
          name: '',
          location: '',
          latitude: '',
          longitude: ''
      }

      // Cuando el usuario quiere crear una nueva centralidad se ajustan las banderas y se inicializa la centralidad.
      vm.centralitySelection = function() {
          vm.isSelecting = true;
          vm.isEditing = false;
          vm.centralityReset();
      }

      // Cuando se cancela se resetea la centralidad y sus correspondientes banderas.
      vm.centralityCancel = function() {
          vm.isSelecting = false;
          vm.isEditing = false;
          vm.centralityReset();
      }

      // Se inicializa nuevamente la centralidad.
      vm.centralityReset = function() {
          vm.newCentrality = {
              name: '',
              location: '',
              latitude: '',
              longitude: ''
          }
      }


      // Guarda una centralidad en la BD
      vm.centralitySave = function() {
          dataServer.saveCentrality(vm.newCentrality)
              .then(function(data) {
                  // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                  alert('Se guardó correctamente la centralidad: ' + data.id)
                  srvLayersCentrality.getCentralities().push(data);
                  data.selected = true;
                  adminLayers.viewCentrality(data, srvLayersCentrality.getCentralitiesLayer());
                  // vm.$apply();
              })
              .catch(function(err) {
                  console.log("ERRRROOORR!!!!!!!!!! ---> Al guardar centrality");
              });
          vm.centralityCancel();
      }




      // Modificacion y borrado de una centralidad.
      vm.callbackMarkersOnClick = function(pixel) {
          // Determina que elemento se clickeo (indicador de centralidad).
          vm.map.forEachFeatureAtPixel(pixel, function(feature, layer) {
              // Se obtienen los datos de coordenadas del indicador y se busca si corresponde a una centralidad.
              vm.searchCentrality(feature);
          })
      }

      //nooooooooooooooooooo

      // Se realiza la busqueda de la centralidad a la que pertenece el punto dado.
      vm.searchCentrality = function(point) {
          vm.centralityEdit();
          vm.newCentrality = point.get('object');
          vm.$apply();
      }

      // Cuando se edita se resetea la centralidad y se establece la bandera de edicion.
      vm.centralityEdit = function() {
          vm.isSelecting = false;
          vm.isEditing = true;
          vm.centralityReset();
      }

      // Bandera para indicar que se esta editando una centralidad.
      vm.isEditing = false;


      vm.centralityDelete = function() {
          dataServer.deleteCentrality(vm.newCentrality.id)
              .then(function(data) {
                  // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                  console.log(data);
                  alert('Se elimino correctamente la centralidad: ' + data.id);
                  adminLayers.viewCentrality(data, srvLayersCentrality.getCentralitiesLayer());
                  srvLayersCentrality.filterCentrality(data);
                  // vm.$apply();
              })
              .catch(function(err) {
                  console.log("ERRRROOORR!!!!!!!!!! ---> Al guardar centrality");
              });
          vm.centralityCancel();
      }


      vm.centralityUpdate = function() {
          dataServer.updateCentrality(vm.newCentrality)
              .then(function(data) {
                  // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                  console.log(data);
                  alert('Se modifico correctamente la centralidad: ' + data.id);
                  // var cent = vm.centralitiesJson.find(findById);
                  // adminLayers.viewCentrality(cent, vm.centralitiesLayer);
                  srvLayersCentrality.getCentralities().push(data);
                  adminLayers.viewCentrality(data, srvLayersCentrality.getCentralitiesLayer());
                  adminLayers.viewCentrality(data, srvLayersCentrality.getCentralitiesLayer());
                  // vm.centralitiesJson = vm.centralitiesJson.filter((item) => item.id !== data.id);

              })
              .catch(function(err) {
                  console.log("ERRRROOORR!!!!!!!!!! ---> Al guardar centrality");
              });
          vm.centralityCancel();
      }

      // Se captura el evento de click dentro del mapa.
      vm.map.on('click', function(evt) {
          // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
          vm.callbackMarkersOnClick(evt.pixel);

          var coordinate = evt.coordinate;

          // vm.selectedPoint.longitude = coordinate[0];
          // vm.selectedPoint.latitude = coordinate[1];

          // Si estoy creando o editando una centralidad se obtienen las coordenadas donde se efectuo el click.
          var coordinate = evt.coordinate;
          if (vm.isSelecting || vm.isEditing) {
              vm.newCentrality.longitude = coordinate[0];
              vm.newCentrality.latitude = coordinate[1];
              console.log('Selected point: ' + coordinate);
          }


      });


    } // fin Constructor

})()
