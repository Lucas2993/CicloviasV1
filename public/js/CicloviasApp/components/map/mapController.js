/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
    .controller('MapController', ['$scope', 'creatorMap', 'srvLayers', 'dataServer', 'adminLayers', MapController]);

    function MapController(vm, creatorMap, srvLayers, dataServer, adminLayers) {

        // ********************* declaracion de variables y metodos *********************
        vm.map = creatorMap.getMap();

        vm.centralitiesJson = [];
        vm.checkboxModel;

        vm.findAllCentralities = findAllCentralities;
        vm.findAllZones = findAllZones;

        vm.toogleCentralitiesLayer = toogleCentralitiesLayer;
        vm.toogleZonesLayer = toogleZonesLayer;

        // ********************************** NUEVO *******************************
        vm.selectZone = selectZone;

        vm.checkboxModel = {
            centralitiesValue: false,
            zonesValue: false
        };

        var generateCentralitiesPoints;
        var createLayerZone;

        // ************************ inicializacion de datos del mapa ************************
        // **********************************************************************************
        vm.findAllCentralities();
        vm.findAllZones();

        // **********************************************************************************
        // ************************ Descripcion de las funciones ************************

        // Busca todas las centralidades de la BD
        function findAllCentralities() {
            dataServer.getCentralities()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.centralitiesJson = data;
                    console.log("Datos recuperados con EXITO! = " + data);
                    generateCentralitiesPoints(vm.centralitiesJson);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las CENTRALIDADES");
                })
        }

        // Busca todas las zonas de la BD
        function findAllZones() {
            dataServer.getZones()
                .then(function(data) {
                    // una vez obtenida la respuesta del servidor realizamos las sigientes acciones
                    vm.zonesJson = data;
                    console.log("Datos recuperados prom ZONES con EXITO! = " + data);
                    createLayerZone(vm.zonesJson);
                })
                .catch(function(err) {
                    console.log("ERRRROOORR!!!!!!!!!! ---> Al cargar las ZONES");
                })
        }

        //      Generacion de Capa de Centralidades a partir del json recibido desde el service
        function generateCentralitiesPoints(centralitiesJson) {
            // Se crea y agrega la capa de Centralidades al mapa
            vm.centralitiesLayer = srvLayers.getLayerMarker(centralitiesJson);
            vm.map.addLayer(vm.centralitiesLayer);
            vm.centralitiesLayer.setVisible(false);
        }

        //      Generacion de Capa de Zonas a partir del json recibido desde el service
        function createLayerZone(infoZoneJson) {
            vm.zonesLayer = srvLayers.getGroupLayerZones(infoZoneJson);
            vm.map.addLayer(vm.zonesLayer);
            vm.zonesLayer.setVisible(false);
        }

        // Toogle de capa de centralidades
        function toogleCentralitiesLayer() {
            adminLayers.viewLayer(vm.centralitiesLayer);
        }

        // Toogle de capa de zonas
        function toogleZonesLayer() {
            adminLayers.viewLayer(vm.zonesLayer);
        }

        // permite la visualizacion o no de una zona
        function selectZone(nameZone){
            var zoneSelected = adminLayers.findLayerZone(nameZone, vm.zonesLayer);
            if(zoneSelected == null){
                console.log("ERROR: la zona "+nameZone+" no se encuentra disponible.");
            }
            console.log("Zona seleccionada: "+nameZone);
            adminLayers.viewLayer(zoneSelected);
        }

        // ****************************** Lucas y ema ***************************************
        // **********************************************************************************
        // display popup on click
        vm.map.on('click', function(evt) {
            var feature = vm.map.forEachFeatureAtPixel(evt.pixel,
                function(feature) {
                    var coordinates = feature.getGeometry().getCoordinates();
                    var popup = new ol.Overlay.Popup({
                        // insertFirst: false
                    });
                    vm.map.addOverlay(popup);

                    popup.show(evt.coordinate,feature.get('object').name);
                    return feature;
                });
        });

        // Lucas
        // Aca empieza lo que agregue para el ABM de centralidades.
        // Incorporacion de agregar centralidad
        // Esta bandera se usa para saber si el usuario se encuentra seleccionando un punto para una nueva centralidad.
        vm.isSelecting = false;

        // Modelo de una nueva centralidad (inicializacion).
        vm.newCentrality = {
            name : '',
            location : '',
            latitude : '',
            longitude : ''
        }

        // Cuando el usuario quiere crear una nueva centralidad de ajustan las banderas y se inicializa la centralidad.
        vm.cetralitySelection = function(){
          vm.isSelecting = true;
          vm.isEditing = false;
          vm.centralityReset();
        }

        // Cuando se cancela se resetea la centralidad y sus correspondientes banderas.
        vm.centralityCancel = function(){
          vm.isSelecting = false;
          vm.isEditing = false;
          vm.centralityReset();
        }

        // Se inicializa nuevamente la centralidad.
        vm.centralityReset = function(){
            vm.newCentrality = {
                name : '',
                location : '',
                latitude : '',
                longitude : ''
            }
        }

        // Se llama al servicio y se guarda la nueva centralidad.
        vm.centralitySave = function(){
            dataServer.saveCentrality(vm.newCentrality, function(err, res){
  				if(err){
  					return alert('Ocurrió un error: ' + err)
  				}
  				alert('Se guardó correctamente la centralidad: ' + res.id)
                // Una vez guardada, se intentan recuperar todas las centralidades nuevamente para
                // obtener los cambios realizados.
                vm.findAllCentralities();
  			});
            // Se resetea la centralidad y sus banderas.
            vm.centralityCancel();

        }

        // Se captura el evento de click dentro del mapa.
        vm.map.on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            vm.callbackMarkersOnClick(evt.pixel);

            // Si estoy creando o editando una centralidad se obtienen las coordenadas donde se efectuo el click.
            if(vm.isSelecting || vm.isEditing){
              var coordinate = evt.coordinate;
              vm.newCentrality.longitude = coordinate[0];
              vm.newCentrality.latitude = coordinate[1];
              console.log('Selected point: '+coordinate);
              // Se fuerza la aplicacion de los cambios dentro de angular para refrescar la vista.
              vm.$apply();
            }
        });

        // Modificacion y borrado de una centralidad.
        vm.callbackMarkersOnClick =  function(pixel){
            // Determina que elemento se clickeo (indicador de centralidad).
            vm.map.forEachFeatureAtPixel(pixel, function(feature, layer){
                // Se obtienen los datos de coordenadas del indicador y se busca si corresponde a una centralidad.
                vm.searchCentrality(feature);
            })
        }

//nooooooooooooooooooo

        // Se realiza la busqueda de la centralidad a la que pertenece el punto dado.
        vm.searchCentrality = function(point){
            vm.centralityEdit();
            vm.newCentrality = point.get('object');
            vm.$apply();
        }

        // Cuando se edita se resetea la centralidad y se establece la bandera de edicion.
        vm.centralityEdit = function(){
          vm.isSelecting = false;
          vm.isEditing = true;
          vm.centralityReset();
        }

        // Bandera para indicar que se esta editando una centralidad.
        vm.isEditing = false;

        // Se realiza el llamado al servicio de borrado para borrar una centralidad.
        vm.centralityDelete = function(){
            dataServer.deleteCentrality(vm.newCentrality.id, function(err, res){
  				if(err){
  					return alert('Ocurrió un error: ' + err)
  				}
  				alert('Se elimino correctamente la centralidad: ' + vm.newCentrality.id)
                // Al haber borrado una centralidad se obtienen nuevamente las centralidades para obtener los cambios.
                vm.findAllCentralities();
                // Se limpia el modelo y sus banderas.
                vm.centralityCancel;
  			});
        }

        // Se realiza el llamado al servicio de actualizacion para actualizar una centralidad.
        vm.centralityUpdate = function(){
            dataServer.updateCentrality(vm.newCentrality, function(err, res){
                if(err){
                    return alert('Ocurrió un error: ' + err)
                }
                alert('Se actualizo correctamente la centralidad: ' + vm.newCentrality.id)
                // Al haber actualizado una centralidad se obtienen nuevamente las centralidades para obtener los cambios.
                vm.findAllCentralities();
                // Se limpia el modelo y sus banderas.
                vm.centralityCancel;
            });
        }

    } // fin Constructor

})()
