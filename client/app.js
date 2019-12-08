(function($) {

  var app = this;

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

  $(document).ready(function() {
    // Application code starts here
    app.router.run('#/');

  });

})(jQuery);
