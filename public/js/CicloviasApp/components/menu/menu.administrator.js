// Responsabilidad : Administrar el control de los eventos del mapa
// Este servicio permite controlar que menu tiene el control de la vista del mapa,
// en otras palabras que eventos estan activos en determinado momento.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('adminMenu', [AdminMenu]);

    function AdminMenu() {

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ************************* VARIABLES PRIVADAS *********************************
        var centralities = false;
        var editCentralities = false;
        var tripFinder = false;
        var tripsRanking = false;
        var tripsToDistance = false;
        var journey = false;
        var tripsToCentrality = false;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ******************** Funciones PUBLICAS del servicio *************************
        var service = {
            activeCentralities: activeCentralities,
            activeEditCentralities: activeEditCentralities,
            activeTripFinder: activeTripFinder,
            activeTripsRanking: activeTripsRanking,
            activeTripsToDistance: activeTripsToDistance,
            activeTripsToCentrality: activeTripsToCentrality,
            setActiveCentralities: setActiveCentralities,
            setActiveEditCentralities: setActiveEditCentralities,
            setActiveTripFinder: setActiveTripFinder,
            setActiveTripsRanking: setActiveTripsRanking,
            setActiveTripsToDistance: setActiveTripsToDistance,
            setActiveTripsToCentrality: setActiveTripsToCentrality,
            disableAll: disableAll
        };
        return service;

        // ******************* GETTERS *******************
        // ***********************************************
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

        function activeTripsToDistance(){
            return tripsToDistance;
        }

        function activeTripsToCentrality(){
            return tripsToCentrality;
        }


        // ******************* SETTERS *******************
        // ***********************************************
        function setActiveCentralities(activated) {
            centralities = activated;
        };

        function setActiveEditCentralities(activated){
            editCentralities = activated;
        }

        function setActiveTripFinder(activated) {
            tripFinder = activated;
        };

        function setActiveTripsRanking(activated){
            tripsRanking = activated;
        }

        function setActiveTripsToDistance(activated){
            tripsToDistance = activated;
        }

        function setActiveTripsToCentrality(activated){
            tripsToCentrality = activated;
        }


        // ***********************************************
        // ************* OTRAS FUNCIONES *****************
        function disableAll(){
            setActiveCentralities(false);
            setActiveEditCentralities(false);
            setActiveTripFinder(false);
            setActiveTripsRanking(false);
            setActiveTripsToDistance(false);
            setActiveTripsToCentrality(false);
        }

    }

})()
