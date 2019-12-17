<?php
include_once('php/config/core.php');

session_start();
if(!isset($_SESSION["email"])) {
  header("location:./login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Where Is My Car?</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.html">Logout</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- about section, done -->
  <section class="page-section bg-primary" id="map-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div id="map" style="height: 500px"></div>
        </div>
      </div>
    </div>
  </section>

  <script>
  function initMap() {
    var myLatLng = {lat: 39.9526, lng: -75.1652};
  
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
      center: myLatLng
      });
  
      var directionsService = new google.maps.DirectionsService;
      var directionsRenderer = new google.maps.DirectionsRenderer({
      draggable: true,
        map: map,
        panel: document.getElementById('right-panel')
      });
  
      directionsRenderer.addListener('directions_changed', function() {
        computeTotalDistance(directionsRenderer.getDirections());
      });
  
      displayRoute('Temple University', 'Broad street & Cecil B. Moore', directionsService,
        directionsRenderer);
    }
  
    function displayRoute(origin, destination, service, display) {
      service.route({
      origin: origin,
        destination: destination,
        travelMode: 'WALKING',
        avoidTolls: true
      }, function(response, status) {
        if (status === 'OK') {
          display.setDirections(response);
        } else {
          alert('Could not display directions due to: ' + status);
        }
        });
    }
  
    function computeTotalDistance(result) {
      var total = 0;
      var myroute = result.routes[0];
      for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
      }
      total = total / 1000;
      document.getElementById('total').innerHTML = total + ' km';
    }
    // Try HTML5 geolocation.
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {
              lat: position.coords.latitude,
                lng: position.coords.longitude
              };
        var infoWindow = new google.maps.InfoWindow();
              infoWindow.setPosition(pos);
              infoWindow.setContent('My Location!');
              infoWindow.open(map);
              map.setCenter(pos);
            }, function() {
              handleLocationError(true, infoWindow, map.getCenter());
            });
          } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
          }
  
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      infoWindow.setPosition(pos);
      infoWindow.setContent(browserHasGeolocation ?
        'Deafult: Philadelphia City Hall' :
        'Your browser doesn\'t support geolocation');
      infoWindow.open(map);
      }
  </script>

  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAs0ei2v6pdX96OavGj_U7rSbmdfCTpxBU&callback=initMap">
  </script>

</body>

