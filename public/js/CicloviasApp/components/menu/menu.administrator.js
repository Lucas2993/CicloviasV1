// Administrador de los eventos del mapa
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('adminMenu', [AdminMenu]);

    function AdminMenu() {

        var centralities = false;
        var editCentralities = false;
        var tripFinder = false;
        var journey = false;
        var tripsRanking = false;

        var service = {
            activeCentralities: activeCentralities,
            activeEditCentralities: activeEditCentralities,
            activeTripFinder: activeTripFinder,
            activeTripsRanking: activeTripsRanking,
            setActiveCentralities: setActiveCentralities,
            setActiveTripFinder: setActiveTripFinder,
            setActiveEditCentralities: setActiveEditCentralities,
            setActiveTripsRanking: setActiveTripsRanking,
            disableAll: disableAll
        };
        return service;

        // *******************************************************************************
        // ****************** Funciones publicas del servicio ****************************

        function activeCentralities() {
            return centralities;
        };

        function activeEditCentralities(){
            return editCentralities;
        }

        function activeTripFinder() {
            return tripFinder;
        };

        function activeTripsRanking(){
            return tripsRanking;
        }

        function setActiveCentralities(activated) {
            centralities = activated;
        };

        function setActiveTripFinder(activated) {
            tripFinder = activated;
        };

        function setActiveEditCentralities(activated){
            editCentralities = activated;
        }

        function setActiveTripsRanking(activated){
            tripsRanking = activated;
        }

        function disableAll(){
            setActiveTripFinder(false);
            setActiveCentralities(false);
            setActiveEditCentralities(false);
            setActiveTripsRanking(false);
        }

    }

})()
