/* Controla la apertura y cierre del menu de CicloviasByZone */
(function() {
    'use strict';
    // Se llama al modulo "mapModule"(), seria una especie de get
    angular.module('mapModule')
        .controller('tripsCicloviasByZoneObserver', [
            '$scope',
            // 'creatorMap',
            // 'srvLayers',
            // 'dataServer',
            // 'srvViewZone',
            // 'srvModelZone',
            // 'srvViewTrip',
            // 'srvModelCicloviasByZone',
            // 'adminLayers',
            'adminMenu',
            TripsCicloviasByZoneObserver
        ]);

    // function TripsCicloviasController(vm, creatorMap, srvLayers, dataServer, srvViewZone, srvModelZone, srvViewTrip, srvModelCicloviasByZone, adminLayers, adminMenu) {
    function TripsCicloviasByZoneObserver(vm, adminMenu) {

        // ********************* declaracion de variables y metodos *********************

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PUBLICO ***********************************

        // ===============>>>>>> FLAGS <<<<<===============
        // indica si el menu se encuentra abierto o cerrado
        vm.openMenuTripsCiclovia = false;

        // **************************** FUNCIONES ****************************
        // permite la visualizacion de la capa de tramos ponderados (segun el estado del checkbox)

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ********************************** PRIVADO ***********************************
        // MENU: deshabilita los eventos de los demas menues y habilita los correspondientes a este
        var enableEventClick;


        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Descripcion de las funciones ************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // recupera todas las zonas del sistema


        // // ################## OBSERVADORAS ##################
        // se encarga de observar si el menu se encuentra abierto o cerrado
        vm.$watch('openMenuTripsCiclovia', function(isOpen){
            if (isOpen) {
              console.log('El menu de POSIBLES_CICLOVIAS_OBSERVER esta abierto');
              enableEventClick();
            }
            else {
                // antes de pasar a otro menu limpiamos los puntos graficados en el mapa
                console.log("Se cerro el menu POSIBLES_CICLOVIAS_OBSERVER\n");
                adminMenu.setActiveTripsCiclovias(false);
                vm.openMenuTripsCiclovia = false;
            }
        });

        // ****************************************************************
        // *************************** PRIVADAS ***************************

        function enableEventClick(){
            adminMenu.disableAll();
            adminMenu.setActiveTripsCiclovias(true);
        }

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************ Inicializacion de datos *****************************
        // ******************************************************************************
        // al crear el controlador ejecutamos esta funcion

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    } // fin Constructor

})()
