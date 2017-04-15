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

    <!-- UI-Bootstrap -->
    <script src="{{ URL::asset('js/assets/libs/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js') }}"></script>

    <!-- jQuery (necesaria para Bootstrap) -->
    <script src="{{ URL::asset('js/assets/libs/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ URL::asset('js/assets/libs/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Controladores y modulos propios -->
    <script src="{{ URL::asset('js/CicloviasApp/app.module.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/app.routes.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/shared/navigationbar/navigationbarModule.js') }}"></script>
    <script src="{{ URL::asset('js/CicloviasApp/components/map/mapController.js') }}"></script>

    <script>
        function desactive() {
            document.getElementById("row-offcanvas").classList.remove("active");
            console.log("des");
        }

        function active() {
            document.getElementById("row-offcanvas").classList.toggle("active");
        }
    </script>

  </head>
  <body>
    <navigation></navigation>
    <!-- <div class="container" ng-view=""></div> -->
            <div class="" ng-view=""></div>
    <footer class="container-fluid text-right">
        <p>@Universidad Nacional de la Patagonia San Juan Bosco</p>
    </footer>
  </body>
</html>
