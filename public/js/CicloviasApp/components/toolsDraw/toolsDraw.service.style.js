// Responsabilidad : Creacion de estilos
// TODO Falta refactorizar, muchos metodos se pueden unificar.
(function() {
    'use strict';
    // se hace referencia al modulo mapModule ya creado (esto esta determinado por la falta de [])
    angular.module('mapModule')
        .factory('creatorStyle', ['creatorColor', creatorStyle]);

    function creatorStyle(creatorColor) {
        var service = {
            getStyleText: getStyleText,
            getStyleBorder: getStyleBorder,
            getStyleFill: getStyleFill,
            getStyleCentrality: getStyleCentrality,
            getStyleTrip: getStyleTrip,
            getStylePolygon: getStylePolygon,
            getStyleJourney: getStyleJourney,
            getStyleJourneyDistinctColor: getStyleJourneyDistinctColor,
            getStyleTripCloseToPoint: getStyleTripCloseToPoint,
            getStyleTripsRanking: getStyleTripsRanking,
            getStyleTemporalEditCentrality: getStyleTemporalEditCentrality,
            getStyleTripCloseToPointViolet: getStyleTripCloseToPointViolet,
            getStylePoint: getStylePoint,

        };
        return service;

        // crea y devuelve un estilo de texto con el texto deseado
        function getStyleText(stringText) {
            var styleText = new ol.style.Text({
                text: stringText
            });

            return styleText;
        };

        function getStyleBorder(stringText) {
            var style = new ol.style.Text({
                text: stringText
            });

            return style;
        };

        function getStyleFill(stringText) {
            var style = new ol.style.Text({
                text: stringText
            });

            return style;
        };

        function getStyleCentrality() {
            var stylePoint = new ol.style.Style({
                image: new ol.style.Icon(({
                    anchor: [0.5, 0, 5],
                    anchorOrigin: 'bottom-right',
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'pixels',
                    src: 'https://openlayers.org/en/v4.1.0/examples/data/icon.png'
                    // src: 'https://openlayers.org/en/v4.1.0/examples/data/dot.png'
                    //, imgSize: [15, 25]
                    // , size: [15, 25]
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
                }),
                text: styleText
            });
            return stylePolygon;
        };

        function getStyleTrip(color, width) {
            var styleLine = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: color,
                    width: width
                }),
            });

            return styleLine;
        };

        function getStyleJourney() {
            var style = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'yellow',
                    width: 3
                }),
            });
            // console.log("color random: "+ creatorColor.getRandomColor());

            return style;
        }

        function getStyleJourneyDistinctColor() {
            var style = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: creatorColor.getRandomColor(),
                    width: 3
                }),
            });
            // console.log("color random: "+ creatorColor.getRandomColor());

            return style;
        }

        function getStyleTripCloseToPoint() {
            var style = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'yellow',
                    width: 2
                }),
            });

            return style;
        }

        function getStyleTripCloseToPointViolet() {
            var style = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'black',
                    width: 2
                }),
            });

            return style;
        }

        function getStyleTripsRanking() {
            var style = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'green',
                    width: 3
                }),
            });

            return style;
        }

        function getStyleTemporalEditCentrality() {
            var style = new ol.style.Style({
                fill: new ol.style.Fill({
                  color: 'rgba(255, 255, 255, 0.2)'
                }),
                stroke: new ol.style.Stroke({
                  color: '#ffcc33',
                  width: 2
                }),
                image: new ol.style.Circle({
                    radius: 5,
                    fill: new ol.style.Fill({
                        color: 'red'
                    })
                })
            });
            return style;
        }


        function getStylePoint(radius, colorFill, colorStroke) {
            var style = new ol.style.Style({
                image: new ol.style.Circle({
                    radius: radius,
                    fill: new ol.style.Fill({
                        color: colorFill,
                    }),
                    stroke: new ol.style.Stroke({
                        color: colorStroke,
                        width: 2
                    }),
                })
            });
            return style;
        }
    }

})()
