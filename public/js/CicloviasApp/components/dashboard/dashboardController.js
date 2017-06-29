(function () {
  'use strict';

  angular.module('dashboardModule')
    .controller('dashboardController', ['$scope','dataServer',DashboardController]);

  //Constructor
  function DashboardController(vm, dataServer){

    //Se genera gráfico 1 "Cantidad de centralidades por zona".
    generateGraph1(vm, dataServer);

    //Se genera gráfico 2 "Cantidad de centralidades por tipo".
    generateGraph2(vm, dataServer)

    //Se genera gráfico 3 "Ranking de centralidades".
    generateGraph3(vm, dataServer);

    //Se genera gráfico 4 "Cantidad de zonas registradas".
    generateGraph4(vm, dataServer);

    //Se genera gráfico 5 "Ranking top 10: Zonas atravesadas por recorridos".
    generateGraph5(vm, dataServer);

    //Se genera gráfico 6 "Cantidad de recorridos registrados"
    generateGraph6(vm, dataServer);

    //Se genera gráfico 7 "Recorridos por longitud (Mts)"
    generateGraph7(vm, dataServer);

  }//Constructor


  //Genera los dato del gráfico1 de "Centralidades por zona"
  function generateGraph1(vm, service){
    var servRest = '/centralitiesByZone';
    var labels = new Array();
    var datos = new Array();
    service.getDataDashboard(servRest)
            .then( function (data){
              data.forEach( function (item){
                labels.push(item.zone);
                datos.push(item.centralidades);
              });
              vm.labels_graph1 = labels;
              vm.data_graph1 = datos;
              vm.series_graph1 = ['Centralidad'];
            })
            .catch( function (err){
              console.error('Error al ejecutar consulta: countCentralitiesByZone.');
            });
  }

  function generateGraph2(vm, service){
    vm.labels_graph2 = ['Centro de Salud', 'Policia', 'Centro Educativo', 'Centro Cultural', 'Transporte', 'Turismo', 'Gobierno'];
    vm.data_graph2 = [25, 32, 9, 15, 20, 15, 16];
    vm.series_graph2 = ['Centralidad'];
  }

  //Genera los dato del gráfico3 de "Ranking de centralidades por recorridos cercanos."
  function generateGraph3(vm, service){
    var servRest = '/rankingCentralitiesByTrips';
    var labels = new Array();
    var datos = new Array();
    service.getDataDashboard(servRest)
            .then( function (data){
              data.forEach( function (item){
                labels.push(item.centrality);
                datos.push(item.cant_trips);
              });
              vm.labels_graph3 = labels;
              vm.data_graph3 = datos;
              vm.series_graph3 = ['Recorridos'];
            })
            .catch( function (err){
              console.error('Dashboard - Error al ejecutar consulta: rankingCentralitiesByTrips.');
            });
  }

  function generateGraph4(vm, service){
    service.getZones()
              .then( function (data){
                vm.count_zones = data.length;
              })
              .catch( function (err){
                console.log('Dashboard - Error al recuperar la cantidad de zonas.');
              });
  }

  function generateGraph5(vm, service){
    var servRest = '/rankingZoneCrossTrips';
    var labels = new Array();
    var datos = new Array();
    service.getDataDashboard(servRest)
            .then( function (data){
              data.forEach( function (item){
                labels.push(item.zone);
                datos.push(item.cant_trips);
              });
              vm.labels_graph5 = labels;
              vm.data_graph5 = datos;
              vm.series_graph5 = ['Recorridos'];
            })
            .catch( function (err){
              console.error('Dashboard - Error al ejecutar consulta: rankingCentralitiesByTrips.');
            });
  }


  function generateGraph6(vm, service){
    var servRest = '/amountTrips';
    service.getDataDashboard(servRest)
            .then( function (data){
              vm.count_trips = data[0].cant_trips;
            })
            .catch( function (err) {
              console.log('Dashboard - Error al recuperar la cantidad de recorridos.');
            });
  }

  function generateGraph7(vm, service){
    var servRest = '/tripsByLength';
    var labels = new Array();
    var datos = new Array();
    service.getDataDashboard(servRest)
            .then( function (data){
              data.forEach( function (item){
                labels.push(item.rango);
                datos.push(item.cant_trips);
              });
              vm.data_graph7 = datos;
              vm.labels_graph7 = labels;
              vm.options_graph7 = {
                legend: {
                  display : true,
                  position : 'bottom'
                }
              }
            })
            .catch( function (err) {
              console.log('Dashboard - Error al recuperar recorridos por longitud.');
            });
  }

})()
