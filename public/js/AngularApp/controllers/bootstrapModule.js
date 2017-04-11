/* angular.module('ui.bootstrap.demo').controller('CollapseDemoCtrl', function ($scope) {
  // $scope.isNavCollapsed = true;
  $scope.isCollapsed = false;
  $scope.isCollapsedHorizontal = false;
}); */

(function () {
	'use strict';

  	angular.module('UIBootstrapModule', [])
  		 .controller('ControllerBootstrap', ['$scope', ControllerBootstrap]);

    function ControllerBootstrap(vm){
      vm.isCollapsed = false;
      vm.isCollapsedHorizontal = false;
    }

})()
