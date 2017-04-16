(function() {
    'use strict';

    angular.module('navigationbar').controller('NavController', ['$scope', NavController]);

    function NavController(vm) {

        vm.desactive = function() {
            if (document.getElementById("row-offcanvas") != null) {
                document.getElementById("row-offcanvas").classList.remove("active");
            }
        }

        vm.active = function() {
            if (document.getElementById("row-offcanvas") != null) {
                document.getElementById("row-offcanvas").classList.toggle("active");
            }
        }

    } // fin Constructor
})()
