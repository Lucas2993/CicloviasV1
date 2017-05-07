// Constantes utilizadas por el modulo mapModule
(function() {
    'use strict';
    angular.module('mapModule')
    .constant('path',{
        CENTRALITY: 'api/centrality',
        TRIP:'api/trip',
        JOURNEY: 'api/journey',
        ZONE: 'api/zone'
    })
    .constant('propiertiesMap',{
        PROJECTION: 'EPSG:4326',
        LONG_CENTER: '-65.0339126586914',
        LAT_CENTER: '-42.77000141404137',
        ZOOM: 13
    });
})()
