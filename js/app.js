(function($) {

  var app = this;
  window.WhereIsMyCar = app; // expose

  app.login = function() {
    var data = $('#login-form').serializeArray().reduce(function(obj, item) {
          obj[item.name] = item.value;
          return obj;
    }, {});

    $.post("php/user/login.php", $('#login-form').serialize(), function(result) {
        console.log("result: ", result);
      }, 
      "text"
    );
  };

  app.initMap = function() {
    app.map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 39.9526, lng: -75.1652},
      zoom: 15
    });
  };

  $(document).ready(function() {
    // Application code starts here
  });

})(jQuery);
