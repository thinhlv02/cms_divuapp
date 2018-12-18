<?php
//pre($data_map);
//die();
?>
<!DOCTYPE html >
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 600px;
            /*height: 100%;*/
            width: 100%
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
<div id="map"></div>

<script>
    var customLabel = {
        restaurant: {
            label: 'R'
        },
        bar: {
            label: 'B'
        },
        kh: {
            label: 'KH'
        }
    };

    function initMap() {
        var json_str = '<?php echo json_encode($data_map) ?>';
        var markers = JSON.parse(json_str);
        console.log(json_str);
        console.log(markers);
        // markers.forEach(function(element) {
        //     console.log(element);
        // });
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(21.020321, 105.820935),
            zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

        markers.forEach(function (element) {
            console.log(element);
            var id = element.id;
            var name = element.name;
            var address = element.address;
            var type = 'kh';

            var point = new google.maps.LatLng(
                parseFloat(element.lat),
                parseFloat(element.lng));

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name;
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address;
            infowincontent.appendChild(text);

            var icon = customLabel[type] || {};
            var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
            });
            marker.addListener('click', function () {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    }

    function doNothing() {
    }
</script>
<!--<script async defer-->
<!--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqo5394qbeerK9wl0tfywQVogvtxZ_3L4&callback=initMap">-->
<!--</script>-->

<!--<script async defer-->
<!--        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">-->
<!--</script>-->

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5rOgGtWkYkMfdHRR9yswOHLjGWttRUI4&callback=initMap">
</script>
</body>
</html>
<!--src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5yLFDQw2xR8gDMgADxSX1LyuQlAWk20k&callback=initMap">-->