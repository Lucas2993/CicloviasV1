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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/assets/css/slider.css') }}">
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

    <!-- Imagen -->
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}">

    <!-- Controladores y modulos propios -->
    <script src="{{ URL::asset('js/CicloviasApp/app.routes.module.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/app.module.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/app.routes.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/shared/navigationbar/navigationbarModule.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/shared/navigationbar/navigationbarController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/shared/pagefooter/pagefooterModule.js') }}"></script>

    <!-- Modulo de mapa -->
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.module.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.service.creatorMap.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/map.service.layer.js') }}"></script>

    <!-- Controlador de Eventos -->
    <script src="{{ URL::asset('js/CicloviasApp/components/events/events.createPoint.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/mapTripByCentralityController.js') }}"></script>

    <!-- Controladores de mapa -->

    <script src="{{ URL::asset('js/CicloviasApp/components/map/controller/mapCentralityController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/controller/mapCentralityEditController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/controller/mapJourneyController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/controller/mapTripByDistanceController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/controller/mapTripController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/controller/mapTripFinderController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/controller/mapTripRankingController.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/controller/mapZoneController.js') }}"></script>

    <!-- Modelo -->
    <script src="{{ URL::asset('js/CicloviasApp/components/map/model/map.service.model.centrality.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/model/map.service.model.trip.js') }}"></script>

    <!-- Vista -->
    <script src="{{ URL::asset('js/CicloviasApp/components/map/view/map.service.view.centrality.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/view/map.service.view.feature.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/view/map.service.view.trip.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/view/map.service.view.journey.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/view/map.service.view.zone.js') }}"></script>

    <!-- Herramientas de dibujo -->
    <script src="{{ URL::asset('js/CicloviasApp/components/toolsDraw/toolsDraw.service.style.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/toolsDraw/toolsDraw.service.feature.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/toolsDraw/toolsDraw.service.color.js ') }}"></script>

    <!-- Servicios HTTP -->
    <script src="{{ URL::asset('js/CicloviasApp/components/promise/promise.data.js') }}"></script>

    <!-- Administradores -->
    <script src="{{ URL::asset('js/CicloviasApp/components/layers/layers.administrator.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/menu/menu.administrator.js') }}"></script>

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
