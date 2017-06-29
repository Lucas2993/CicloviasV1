// Responsabilidad : Brindar colores randomicamente.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('creatorColor', [CreatorColor]);

        function CreatorColor(){
            var service = {
                getRandomColor: getRandomColor
            };
            return service;

            // crea y devuelve un estilo de texto con el texto deseado
            function getRandomColor() {
                var color = "#" + (Math.round(Math.random() * 0XFFFFFF)).toString(16);
                return color;
            };

        }

})()
