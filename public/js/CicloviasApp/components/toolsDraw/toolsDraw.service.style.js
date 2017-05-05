// Creacion de estilos
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('creatorStyle', [creatorStyle]);

        function creatorStyle(){
            var service = {
                getStyleText: getStyleText,
                getStyleBorder: getStyleBorder,
                getStyleFill: getStyleFill,
                getStylePoint: getStylePoint,
                getStyleTrip: getStyleTrip,
                getStylePolygon: getStylePolygon
            };
            return service;

            // crea y devuelve un estilo de texto con el texto deseado
            function getStyleText(stringText) {
                var styleText = new ol.style.Text({
                      text: stringText});

                return styleText;
            };

            function getStyleBorder(stringText) {
                var style = new ol.style.Text({
                      text: stringText});

                return style;
            };

            function getStyleFill(stringText) {
                var style = new ol.style.Text({
                      text: stringText});

                return style;
            };

            function getStylePoint() {
                var stylePoint = new ol.style.Style({
                    image: new ol.style.Icon(({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        src: 'https://openlayers.org/en/v4.1.0/examples/data/icon.png'
                        // src: 'https://openlayers.org/en/v4.1.0/examples/data/dot.png'
                    }))
                });

                return stylePoint;
            };

            function getStylePolygon(colorBorder, styleText) {
                var stylePolygon = new ol.style.Style({
                    stroke: new ol.style.Stroke({
                      color: colorBorder,
                      width: 1
                    }),
                    fill: new ol.style.Fill({
                      // color: 'rgba(0, 0, 255, 0.1)'
                      color: 'rgba(0, 23, 251, 0.1)'
                      // color: 'yellow'
                    }),
                    text: styleText
               });
               return stylePolygon;
            };

            function getStyleTrip(){
                var styleLine = new ol.style.Style({
                    stroke: new ol.style.Stroke({color: 'red', width: 3}),
                });

                return styleLine;
            };
        }

})()
