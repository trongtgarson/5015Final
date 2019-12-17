(function($){


  window.initializeApp = function() {

    let temple = {
      lat: 39.9811877,
      lng: -75.1576866
    };

    let dashboard = this;

    dashboard.myLocation = temple;

    window.dashboard = dashboard;

    dashboard.map = new google.maps.Map(
      document.getElementById('map'), 
      { zoom: 15, center: dashboard.myLocation }
    );
    dashboard.directionsService = new google.maps.DirectionsService; 
    dashboard.directionsRenderer = new google.maps.DirectionsRenderer( { 
        draggable: true, 
        map: dashboard.map, 
        panel: document.getElementById('right-panel') 
      });

    dashboard.messageBox = $('#message-box');

    dashboard.displayRoute = function() {
      if(window.lastParkedLocation && window.lastParkedLocation.lat) {
        dashboard.directionsService.route({
          origin: window.lastParkedLocation,
          destination: dashboard.myLocation,
          travelMode: 'WALKING',
          avoidTolls: true
        }, function(response, status) {
          if (status === 'OK') {
            dashboard.directionsRenderer.setDirections(response);
          } else {
            alert('Could not display directions due to: ' + status);
          }
        });
      }
    };

    dashboard.computeTotalDistance = function(result) {
      var total = 0;
      var myroute = result.routes[0];
      for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
      }
      total = total / 1000;
      document.getElementById('total').innerHTML = total + ' km';
    };

    dashboard.uploadLocation = function() {
      navigator.geolocation.getCurrentPosition(function(position) {
        dashboard.myLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        dashboard.map.setCenter(dashboard.myLocation);

        $.post(window.baseUrl + "php/location/create.php", dashboard.myLocation,
          function(result) {
            dashboard.messageBox.innerHTML = "Location Updated";
            dashboard.displayRoute();
          });
      }, function() {
        alert('Failed to get location data from your browser');
      });
    };

    dashboard.updateDirections = function() {
      // Try HTML5 geolocation.
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          dashboard.myLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          dashboard.map.setCenter(dashboard.myLocation);
          dashboard.displayRoute();
        }, function() {
          alert('Failed to get location data from your browser');
        });
      } else {
        // Browser doesn't support Geolocation
        alert('This browser does not support geolocation');
      }
    };

    dashboard.updateDirections();

  };

})(jQuery); // iife

