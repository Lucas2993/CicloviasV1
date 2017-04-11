<!DOCTYPE html>
<!-- <html ng-app='demoapp'> -->
<html ng-app='cicloviasApp'>
  <head>
    <title>[%title%]</title>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-sanitize.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-route.min.js"></script>
    <script src="http://tombatossals.github.io/angular-openlayers-directive/bower_components/openlayers3/build/ol.js"></script>
    <link rel="stylesheet" href="http://tombatossals.github.io/angular-openlayers-directive/bower_components/openlayers3/build/ol.css">
    <script src="http://tombatossals.github.io/angular-openlayers-directive/dist/angular-openlayers-directive.min.js"></script>

    <!-- Librerias y css de bootstrap (componentes visuales)-->
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.1.3.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- path de los controladores y modulos -->
    <script src="{{ URL::asset('js/AngularApp/principal/ruteo.js') }}"></script>
    <script src="{{ URL::asset('js/AngularApp/principal/otrasRutas.js') }}"></script>
    <script src="{{ URL::asset('js/AngularApp/controllers/map.js') }}"></script>
    <script src="{{ URL::asset('js/AngularApp/components/compEncabezado.js') }}"></script>
    <script src="{{ URL::asset('js/AngularApp/controllers/bootstrapModule.js') }}"></script>
    <script src="{{ URL::asset('js/AngularApp/principal/CicloviasAppMod.js') }}"></script>

    </script>

    </script>
  </head>
  <body>
    <encabezado></encabezado>
    <div class="container" ng-view=""></div>
  </body>
</html>
