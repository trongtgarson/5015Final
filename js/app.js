(function($) {

  var app = this;
  window.WhereIsMyCar = app; // expose

  app.loggedIn = false;

  app.router = $.sammy('#main-content', function() {

    this.use('Template');

    this.get('#/', function(context) {
      context.app.swap('');
      context.render('templates/landing.html')
        .appendTo(context.$element());
    });

    this.get('#dashboard', function(context) {

      if(!app.loggedIn) {
        this.redirect('#/');
        return;
      }

      context.app.swap('');
      context.render('templates/dashboard.html')
        .appendTo(context.$element());
    });

    this.get('#thanks', function(context) {
      context.app.swap('');
      context.render('templates/thanks.html')
        .appendTo(context.$element());
    });

    this.put('#/login', function(context) {
      app.loggedIn = true;
      // Actual Login Logic Goes Here
      this.redirect('#dashboard');
    });

  });

  app.initMap = function() {
    app.map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 39.9526, lng: -75.1652},
      zoom: 15
    });
  };

  $(document).ready(function() {
    // Application code starts here
    app.router.run('#/');
  });

})(jQuery);
