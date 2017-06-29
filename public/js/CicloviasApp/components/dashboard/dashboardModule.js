(function () {
  'use strict';
  angular.module('dashboardModule', ['chart.js'])
  .component('dashboardComponent', {
    templateUrl: '/CicloviasV1/public/js/CicloviasApp/components/dashboardView.html',
    controller: 'dashboardController'
  })
})()
