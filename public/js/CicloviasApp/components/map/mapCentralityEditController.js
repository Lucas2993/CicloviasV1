/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapCentralityEditController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality','dataServer','adminLayers', 'adminMenu', MapCentralityEditController]);

    function MapCentralityEditController(vm, creatorMap, srvLayers, srvLayersCentrality ,dataServer,adminLayers, adminMenu) {

      // ********************* declaracion de variables y metodos *********************
      vm.map = creatorMap.getMap();

      // ********************************** FLAGS *************************************
      vm.updatePointCentrality = false;
      vm.enableDrawIndicator = enableDrawIndicator;
      vm.showIndicatorSelectedPoint = false;
      vm.inAction = "";

      function enableDrawIndicator(){
          vm.updatePointCentrality = false;
          vm.showIndicatorSelectedPoint = true;
      }
      // ******************************************************************************

      // Lucas
      // Aca empieza lo que agregue para el ABM de centralidades.
      // Esta bandera se usa para saber si el usuario se encuentra seleccionando un punto para una nueva centralidad.
      // Incorporacion de agregar centralidad
      vm.isSelecting = false;
      vm.openMenuEditCentralities = false;
      var buttonAddCentrality = false;

      // funcion que habilita el uso de los eventos de este menu
      var enableEventClick;

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
          vm.inAction = "Creando nueva Centralidad";
          buttonAddCentrality = true;
          vm.showIndicatorSelectedPoint = true;
          vm.isEditing = false;
          vm.centralityReset();
      }

      // Cuando se cancela se resetea la centralidad y sus correspondientes banderas.
      vm.centralityCancel = function() {
          vm.isSelecting = false;
          vm.isEditing = false;
          vm.centralityReset();
          // borramos el punto seleccionado
          temporalLayer.getSource().clear();
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
          vm.showIndicatorSelectedPoint = false;
          vm.updatePointCentrality = true;
          vm.inAction = "Editando Centralidad";
          // eliminamos el punto agregado, si es que habia alguno
          temporalLayer.getSource().clear();
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

      // *******************************************************************************
      // **************************** Entrando al menu *********************************

        var temporalLayer = srvLayers.getTemporalLayer();
        temporalLayer.setMap(vm.map);
        temporalLayer.getSource().on( 'addfeature', function (ft) {
            // ft - feature being added
            console.log("***Se agrego un nuevo punto***");
        });

      // *******************************************************************************

      // Se captura el evento de click dentro del mapa.
      vm.map.on('click', function(evt) {
          if(adminMenu.activeEditCentralities()){
              // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
              vm.callbackMarkersOnClick(evt.pixel);

              var longPointSelected = evt.coordinate[0];
              var latPointSelected = evt.coordinate[1];

              // Si estoy creando o editando una centralidad se obtienen las coordenadas donde se efectuo el click.
              if (vm.isSelecting || vm.isEditing) {
                  vm.newCentrality.longitude = longPointSelected;
                  vm.newCentrality.latitude = latPointSelected;
                  console.log('Selected point: [' +longPointSelected+' ;'+latPointSelected+']' );
              }
              // actualiza los valores de los componentes de la vista
              vm.$apply();
              // *********************************************************************
              // ****************** Agregar punto en el mapa *************************
              if(vm.showIndicatorSelectedPoint){
                  var point = new ol.Feature({
                            geometry: new ol.geom.Point([longPointSelected, latPointSelected])
                        });
                  temporalLayer.getSource().clear();
                  temporalLayer.getSource().addFeature(point);
              }
          }
      });

      // *******************************************************************************
      // **************************** Entrando al menu *********************************
      function enableEventClick(){
          adminMenu.disableAll();
          adminMenu.setActiveEditCentralities(true);
          console.log('Entro a actualizacion de eventos EDIT_CENTRALITIES');
      }

      vm.$watch('openMenuEditCentralities', function(isOpen){
          if (isOpen) {
            console.log('El menu de EDIT_CENTRALIDADES esta abierto');
            enableEventClick();
          }
          else {
              // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
              temporalLayer.getSource().clear();
          }
      });

    } // fin Constructor

})()
