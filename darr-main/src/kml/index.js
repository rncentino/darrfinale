(function (window) {
    'use strict';

    function initMap() {
        var control;
        var L = window.L;

        var google = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', 
            { zIndex: 50, opacity: 1, maxZoom: 24, subdomains: ["mt0", "mt1", "mt2", "mt3"] 
            });

        var map = L.map('map', {
            center: [29.3, 76.0856],
            zoom: 8
        }).addLayer(google);



        var style = {
            color: 'yellow',
            opacity: 1.0,
            fillOpacity: 0.2,
            weight: 1,
            clickable: true
        };

        L.Control.FileLayerLoad.LABEL = '<img class="icon" src="folder.svg" alt="file icon"/>';
        
        control = L.Control.fileLayerLoad({
            fitBounds: true,
            layerOptions: {
                style: style,
                pointToLayer: function (data, latlng) {
                    return L.circleMarker(
                        latlng,
                        { style: style }
                    );
                }
            }
        });
        control.addTo(map);

        control.loader.on('data:loaded', function (e) {
            var layer = e.layer;
            console.log(layer);
        });
    }

    window.addEventListener('load', function () {
        initMap();
    });
}(window));
