<script>
    (function (window) {
        'use strict';

        function initMap() {
            var control;
            var L = window.L;

            var google = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', 
                { zIndex: 50, opacity: 1, maxZoom: 50, subdomains: ["mt0", "mt1", "mt2", "mt3"] 
                });

            
            var map = L.map('map', {
                center: [11.9981, 125.1539], 
                zoom: 8
            }).addLayer(google);

            var style = {
                color: 'yellow',
                opacity: 1.0,
                fillOpacity: 0.2,
                weight: 1,
                clickable: true
            };

            L.Control.FileLayerLoad.LABEL = '<i class="ti ti-folders"></i>';
            
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
</script>