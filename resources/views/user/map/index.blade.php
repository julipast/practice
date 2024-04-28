@extends('layouts.header')
@section('content')
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>

    <h3 id="custom-text">Мапа паркомісць</h3>
    <button onclick="calculateAndDisplayRoute()">Прокласти маршрут</button>
    <div id="map"></div>
    <script>
        var map;
        var currentMarker = null;
        var markers = [];

        function calculateAndDisplayRoute() {
            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            var start = currentMarker.getPosition(); // Початкова точка - поточне місце користувача
            var closestMarker = null;
            var closestDistance = Number.POSITIVE_INFINITY;
            for (var i = 0; i < markers.length; i++) {
                var markerPosition = markers[i].getPosition();
                var distance = google.maps.geometry.spherical.computeDistanceBetween(start, markerPosition);
                if (distance < closestDistance) {
                    closestMarker = markers[i];
                    closestDistance = distance;
                }
            }

            if (closestMarker) {
                var end = closestMarker.getPosition(); // Кінцева точка - позиція найближчого маркера
                var request = {
                    origin: start,
                    destination: end,
                    travelMode: 'DRIVING' // Тип транспорту - може бути 'DRIVING', 'WALKING', 'BICYCLING' або 'TRANSIT'
                };

                directionsService.route(request, function(response, status) {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(response);
                    } else {
                        window.alert('Не вдалося прокласти маршрут через: ' + status);
                    }
                });
            }
        }

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 48.9226, lng: 24.7111},
                zoom: 14
            });
            map.addListener('click', function(event) {
                addMarker(event.latLng);
            });

            <?php foreach ($parkings as $parking): ?>
            var geocoder = new google.maps.Geocoder();
            var address = 'Україна, Івано-Франківськ, вулиця <?php echo $parking->address; ?>';

            geocoder.geocode({'address': address}, function(results, status) {
                if (status === 'OK') {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        label: { text: 'p', color: '#FFFFFF' }
                    });
                    markers.push(marker);

                    var uniqueMarkers = [];
                    var markerPositions = new Set();
                    markers.forEach(function(existingMarker) {
                        var positionKey = existingMarker.getPosition().toUrlValue();
                        if (!markerPositions.has(positionKey)) {
                            uniqueMarkers.push(existingMarker);
                            markerPositions.add(positionKey);
                        }
                    });

                    for (var i = 0; i < uniqueMarkers.length; i++) {
                        var markerPosition = uniqueMarkers[i].getPosition();
                    }

                    marker.addListener('click', function() {
                        var parkUrl = '/parkings?address={{$parking->address}}';
                        var contentString = '<a href="' + parkUrl + '">' + '<?php echo "Парковка на вулиці " . $parking->address; ?>' + '</a>';
                        var infoWindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        infoWindow.open(map, marker);
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
            <?php endforeach; ?>

            function addMarker(location) {
                var closestMarker;
                var closestDistance = Number.POSITIVE_INFINITY;
                if (currentMarker) {
                    currentMarker.setMap(null);
                }

                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });

                currentMarker = marker;
                currentMarkerPosition = currentMarker.getPosition();

                marker.addListener('click', function() {
                    marker.setMap(null);
                    currentMarker = null;
                });
            }

            google.maps.event.addDomListener(window, 'load', initMap);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA99njo8txSmG5y1zm7wXdGQPMcstfr-xw&callback=initMap" async defer></script>
@endsection
