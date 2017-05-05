<!DOCTYPE html>
<html ng-app='cicloviasApp'>
  <head>
    <title>[[title]]</title>

    <!-- Styles -->


    <!-- Estilos externos -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('js/assets/libs/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- OpenLayers -->
    <link rel="stylesheet" href="{{ URL::asset('js/assets/libs/bower_components/openlayers/ol.css') }}">

    <!-- Estilos propios -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/assets/css/session.css') }}">


    <!-- Scripts -->
    <!-- Librerias externas -->
    <!-- AngularJS -->
    <script src="{{ URL::asset('js/assets/libs/bower_components/angular/angular.min.js') }}"></script>
    <script src="{{ URL::asset('js/assets/libs/bower_components/angular-sanitize/angular-sanitize.min.js') }}"></script>
    <script src="{{ URL::asset('js/assets/libs/bower_components/angular-route/angular-route.min.js') }}"></script>

    <!-- OpenLayers -->
    <script src="{{ URL::asset('js/assets/libs/bower_components/openlayers/ol.js') }}"></script>
    <script src="{{ URL::asset('js/assets/libs/bower_components/angular-openlayers-directive/dist/angular-openlayers-directive.min.js') }}"></script>
    <script src="{{ URL::asset('js/assets/libs/ol3-popup.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/assets/css/ol3-popup.css') }}">

    <!-- UI-Bootstrap -->
    <script src="{{ URL::asset('js/assets/libs/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js') }}"></script>

    <!-- jQuery (necesaria para Bootstrap) -->
    <script src="{{ URL::asset('js/assets/libs/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ URL::asset('js/assets/libs/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Controladores y modulos propios -->
    <script src="{{ URL::asset('js/CicloviasApp/app.routes.module.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/app.module.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/app.routes.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/shared/navigationbar/navigationbarModule.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/shared/navigationbar/navigationbarController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/shared/pagefooter/pagefooterModule.js') }}"></script>

    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.module.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/mapController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/mapCentralityController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/mapCentralityEditController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/mapZoneController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.service.layer.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.service.layer.centrality.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.service.creatorMap.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/toolsDraw/toolsDraw.service.style.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/toolsDraw/toolsDraw.service.feature.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/toolsDraw/toolsDraw.service.drawZones.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.service.point.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/promise/promise.data.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.service.zone.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/trip/trip.service.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/trip/trip.administrator.js') }}"></script>

    <script src="{{ URL::asset('js/CicloviasApp/components/layers/layers.administrator.js') }}"></script>

    <!-- Constantes de la aplicacion -->
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.constants.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/app.routes.constants.js') }}"></script>

  </head>
  <body>
    <navigation></navigation>
    <div class="" ng-view=""></div>
    <footer></footer>
  </body>
</html>
