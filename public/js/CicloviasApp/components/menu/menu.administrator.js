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
        var roads = false;
        var centralities = false;
        var editCentralities = false;
        var tripFinder = false;
        var tripsRanking = false;
        var tripsToDistance = false;
        var journies = false;
        var tripsToCentrality = false;
        var tripsCiclovias = false;
        var tripsBetweenZones = false;

        // ******************************************************************************
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        // ******************** Funciones PUBLICAS del servicio *************************
        var service = {
            activeRoads: activeRoads,
            activeCentralities: activeCentralities,
            activeJournies: activeJournies,
            activeEditCentralities: activeEditCentralities,
            activeTripFinder: activeTripFinder,
            activeTripsRanking: activeTripsRanking,
            activeTripsToDistance: activeTripsToDistance,
            activeTripsCiclovias: activeTripsCiclovias,
            activeTripsBetweenZones: activeTripsBetweenZones,
            activeTripsToCentrality: activeTripsToCentrality,
            setActiveRoads: setActiveRoads,
            setActiveCentralities: setActiveCentralities,
            setActiveJournies: setActiveJournies,
            setActiveEditCentralities: setActiveEditCentralities,
            setActiveTripFinder: setActiveTripFinder,
            setActiveTripsRanking: setActiveTripsRanking,
            setActiveTripsToDistance: setActiveTripsToDistance,
            setActiveTripsCiclovias: setActiveTripsCiclovias,
            setActiveTripsBetweenZones: setActiveTripsBetweenZones,
            setActiveTripsToCentrality: setActiveTripsToCentrality,
            disableAll: disableAll
        };
        return service;

        // ******************* GETTERS *******************
        // ***********************************************
        function activeRoads() {
            return roads;
        };

        function activeCentralities() {
            return centralities;
        };

        function activeJournies() {
            return journies;
        };

        function activeEditCentralities() {
            return editCentralities;
        }

        function activeTripFinder() {
            return tripFinder;
        };

        function activeTripsRanking() {
            return tripsRanking;
        }

        function activeTripsToDistance() {
            return tripsToDistance;
        }

        function activeTripsToCentrality() {
            return tripsToCentrality;
        }

        function activeTripsCiclovias() {
            return tripsCiclovias;
        }

        function activeTripsBetweenZones() {
            return tripsBetweenZones;
        }

        // ******************* SETTERS *******************
        // ***********************************************
        function setActiveJournies(activated) {
            journies = activated;
        };

        function setActiveRoads(activated) {
            roads = activated;
        };

        function setActiveCentralities(activated) {
            centralities = activated;
        };

        function setActiveEditCentralities(activated) {
            editCentralities = activated;
        }

        function setActiveTripFinder(activated) {
            tripFinder = activated;
        };

        function setActiveTripsRanking(activated) {
            tripsRanking = activated;
        }

        function setActiveTripsToDistance(activated) {
            tripsToDistance = activated;
        }

        function setActiveTripsToCentrality(activated) {
            tripsToCentrality = activated;
        }

        function setActiveTripsCiclovias(activated) {
            tripsCiclovias = activated;
        }

        function setActiveTripsBetweenZones(activated) {
            tripsBetweenZones = activated;
        }

        // ***********************************************
        // ************* OTRAS FUNCIONES *****************
        function disableAll() {
            setActiveJournies(false);
            setActiveCentralities(false);
            setActiveEditCentralities(false);
            setActiveTripFinder(false);
            setActiveTripsRanking(false);
            setActiveTripsToDistance(false);
            setActiveTripsToCentrality(false);
            setActiveTripsCiclovias(false);
            setActiveTripsBetweenZones(false);
            setActiveRoads(false);
        }

    }

})()
