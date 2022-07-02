(function ($) {
    $.fn.GoogleMap = function (options) {
        let settings = $.extend({
            initLat: 0,
            initLng: 0,
            initZoom: 20,
            initTilt: 0,
            addInitMarker: false,
            mapType: google.maps.MapTypeId.HYBRID,
            addPolygons: false,
            polygonPoints: [],
            newAreaCallback: null,
            newPolygonVertex: null,
            polygonFillColor: '#90cb3A',
            polygonStrokeColor: '#90cb3A',
            cursor: 'grab',
            fullscreenControl: true,
            mapTypeControl: true
        }, options);

        const mapOptions = {
            center: new google.maps.LatLng(settings.initLat, settings.initLng),
            zoom: settings.initZoom,
            tilt: settings.initTilt,
            mapTypeId: settings.mapType,
            draggableCursor: settings.cursor,
            fullscreenControl: settings.fullscreenControl,
            mapTypeControl: settings.mapTypeControl
            //draggingCursor: 'grab'

        };
        const map = new google.maps.Map(document.getElementById(this[0].id), mapOptions);

        if (settings.addInitMarker) {
            let markers = [];
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(settings.initLat, settings.initLng),
                map: map
            });
            markers.push(marker);
        }

        if (settings.addPolygons) {
            polygonPath = new google.maps.MVCArray;

            poly = new google.maps.Polygon({
                strokeWeight: 3,
                fillColor: settings.polygonFillColor,
                strokeColor: settings.polygonStrokeColor,
                editable: true
            });
            poly.setMap(map);

            google.maps.event.addListener(polygonPath, 'set_at', polygonAreaChanged);
            google.maps.event.addListener(polygonPath, 'insert_at', polygonAreaChanged);
            new google.maps.event.addListener(map, 'click', addPolygonPoint);

            if (settings.polygonPoints && settings.polygonPoints.length) {
                for (let i = 0; i < settings.polygonPoints.length; i++) {
                    polygonPath.insertAt(polygonPath.length, settings.polygonPoints[i]);
                }
                poly.setPaths(new google.maps.MVCArray([polygonPath]));
                polygonAreaChanged();
            }

        }

        function addPolygonPoint(event) {
            polygonPath.insertAt(polygonPath.length, event.latLng);
            poly.setPaths(new google.maps.MVCArray([polygonPath]));
            polygonAreaChanged();
        }

        function polygonAreaChanged() {
            if (settings.newAreaCallback) {
                let area = google.maps.geometry.spherical.computeArea(polygonPath);
                settings.newAreaCallback(area);
            }
            if (settings.newPolygonVertex) {
                settings.newPolygonVertex(polygonPath);
            }
        }

        function newPolygon() {

        }

        function deletePolygons() {
            polygonPath = new google.maps.MVCArray;
            poly.setPaths(new google.maps.MVCArray([polygonPath]));
            polygonAreaChanged();
        }

        return {
            GetPolygonArea: function () {
                if (polygonPath) {
                    return google.maps.geometry.spherical.computeArea(polygonPath);
                }
                return 0;                
            },
            deletePolygons: function () {
                deletePolygons();
            }
        };
    };
}(jQuery));