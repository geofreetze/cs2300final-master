<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- Need to change API Key (this is Nik's) -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBkvbJdQpUUjHwqyFeyvaSEP9lvuKDKfU&callback=initMap">
    </script>

    <script src="../js/map.js">
        //Because I have to import async defer this should only work onload
        window.onload = function() {
            google.maps.event.addDomListener(window, 'load', initMap);
        };
    </script>
    
    <!--TODO: REMOVE THIS AFTER INITIAL TESTING-->
    <style>
        #map {
            left: 0;
            right: 0;
            margin: auto;

            height: 25em;
            width: 40em;
        }
    </style>
    <title>Where to find us</title>
</head>
<body>
<div class="head"></div>
<div class="main">
    <h1>Find us here!</h1>
    <!-- Click the marker -->
    <div id="map"></div>
</div>
</body>
</html>