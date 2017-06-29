// Responsabilidad : Almacena los distintos tipos de centralidades y sus rutas correspondientes
// a sus iconos
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .service('srvPathImageTypeCentrality', ['path',SrvPathImageTypeCentrality]);

    function SrvPathImageTypeCentrality(path) {

          var service = {
              getPathType: getPathType
          };

          return service;

          function getPathType(type){
            return path.ICON_CENTRALITY + '/' + type +'.png' ;
          }

    }

})()
