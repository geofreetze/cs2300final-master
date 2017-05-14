var markerType = {
    restaurant: {
        label: 'R'
    },
    bar: {
        label: 'B'
    }
};

//From https://developers.google.com/maps/documentation/javascript/mysql-to-maps#try-it-yourself
//This was a copy-paste from the tutorial
function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}

function doNothing() {}

//Default initialization provided on Google Maps API website
function initMap() {
    var center = {lat: 42.443881, lng: -76.478554};

    var mapCanvas = document.getElementById('map');
    var mapOptions = {
        center: center,
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(mapCanvas, mapOptions);

    //Info window {src for help: https://developers.google.com/maps/documentation/javascript/}
    var infoWindow = new google.maps.InfoWindow;

    //From https://developers.google.com/maps/documentation/javascript/mysql-to-maps#try-it-yourself
    downloadUrl('loadmarkers.php', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
            //--EDIT DATABASE ENTRY HERE--//
            var id = markerElem.getAttribute('id');
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var type = markerElem.getAttribute('type');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));
            //--FINISH HERE--//

            //Name in bold//
            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name;
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address;
            infowincontent.appendChild(text);

            //icon can be seen on map B/R
            var icon = markerType[type] || {};
            var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
            });

            marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    });
}
