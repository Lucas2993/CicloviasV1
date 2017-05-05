/* Controlador que permite la representacion del mapa en la pagina y que cuenta con los datos
   necesarios para esto */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('mapCentralityEditController', ['$scope', 'creatorMap', 'srvLayers', 'srvLayersCentrality','dataServer', MapCentralityEditController]);

    function MapCentralityEditController(vm, creatorMap, srvLayers, srvLayersCentrality ,dataServer) {

        // Lucas
        // Aca empieza lo que agregue para el ABM de centralidades.
        // Incorporacion de agregar centralidad

        // Esta bandera se usa para saber si el usuario se encuentra seleccionando un punto para una nueva centralidad.
        vm.isSelecting = false;

        // Modelo de una nueva centralidad (inicializacion).
        vm.newCentrality = {
            name: '',
            location: '',
            latitude: '',
            longitude: ''
        }

        // Cuando el usuario quiere crear una nueva centralidad de ajustan las banderas y se inicializa la centralidad.
        vm.cetralitySelection = function() {
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

        // Se llama al servicio y se guarda la nueva centralidad.
        vm.centralitySave = function() {
            dataServer.saveCentrality(vm.newCentrality, function(err, res) {
                if (err) {
                    return alert('Ocurrió un error: ' + err)
                }
                alert('Se guardó correctamente la centralidad: ' + res.id)
                // Una vez guardada, se intentan recuperar todas las centralidades nuevamente para
                // obtener los cambios realizados.
                // vm.findAllCentralities();
                console.log(res);
                srvLayersCentrality.getCentralities().push(res);
            });
            // Se resetea la centralidad y sus banderas.
            vm.centralityCancel();
        }

        // Se captura el evento de click dentro del mapa.
        creatorMap.getMap().on('click', function(evt) {
            // Este metodo se encarga de detectar si se hace click en un indicador de una centralidad.
            vm.callbackMarkersOnClick(evt.pixel);

            // Si estoy creando o editando una centralidad se obtienen las coordenadas donde se efectuo el click.
            if (vm.isSelecting || vm.isEditing) {
                var coordinate = evt.coordinate;
                vm.newCentrality.longitude = coordinate[0];
                vm.newCentrality.latitude = coordinate[1];
                console.log('Selected point: ' + coordinate);
                // Se fuerza la aplicacion de los cambios dentro de angular para refrescar la vista.
                vm.$apply();
            }
        });

        // Modificacion y borrado de una centralidad.
        // Determina que elemento se clickeo (indicador de centralidad).
        vm.callbackMarkersOnClick = function(pixel) {
            creatorMap.getMap().forEachFeatureAtPixel(pixel, function(feature, layer) {
                // Se obtienen los datos de coordenadas del indicador y se busca si corresponde a una centralidad.
                vm.searchCentrality(feature);
            })
        }

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

        // Se realiza el llamado al servicio de borrado para borrar una centralidad.
        vm.centralityDelete = function() {
            dataServer.deleteCentrality(vm.newCentrality.id, function(err, res) {
                if (err) {
                    return alert('Ocurrió un error: ' + err)
                }
                alert('Se elimino correctamente la centralidad: ' + vm.newCentrality.id)
                // Al haber borrado una centralidad se obtienen nuevamente las centralidades para obtener los cambios.
                // vm.findAllCentralities(); TODO
                // Se limpia el modelo y sus banderas.
                vm.centralityCancel;
            });
        }

        // Se realiza el llamado al servicio de actualizacion para actualizar una centralidad.
        vm.centralityUpdate = function() {
            dataServer.updateCentrality(vm.newCentrality, function(err, res) {
                if (err) {
                    return alert('Ocurrió un error: ' + err)
                }
                alert('Se actualizo correctamente la centralidad: ' + vm.newCentrality.id)
                // Al haber actualizado una centralidad se obtienen nuevamente las centralidades para obtener los cambios.
                // vm.findAllCentralities(); TODO
                // Se limpia el modelo y sus banderas.
                vm.centralityCancel;
            });
        }

    } // fin Constructor

})()
