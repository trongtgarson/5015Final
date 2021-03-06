<?php
  session_start();
  if(isset($_SESSION["loginError"])){
    unset($_SESSION["loginError"]);
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
        <a class="navbar-brand js-scroll-trigger" href="login.php">Login/Register</a>
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
            <li class="nav-item">
			        <a class="nav-link js-scroll-trigger" href="#userguide">User Guide</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead">
      <div class="container h-100">

<?php
  if(isset($_SESSION["error"])) {
    echo "<div class='row'>";
    echo "<div class='col-lg-4 offset-lg-4 align-self-end'>";
    echo "<div class='alert alert-danger' role='alert'>" . $_SESSION["error"] . "</div>";
    echo "</div>";
    echo "</div>";
  } else if(isset($_SESSION["message"])) {
    echo "<div class='row'>";
    echo "<div class='col-lg-4 offset-lg-4 align-self-end'>";
    echo "<div class='alert alert-success' role='alert'>" . $_SESSION["message"] . "</div>";
    echo "</div>";
    echo "</div>";
  }
?>

        <div class="row h-100 align-items-center justify-content-center text-center">
          <div class="col-lg-10 align-self-end">
            <h1 class="text-white-75 font-weight-light mb-5">Where is my car? </h1>
            <hr class="divider my-4">
          </div>
          <div class="col-lg-8 align-self-baseline">
            <p class="text-white-75 font-weight-light mb-5">Have you ever traveled to a location, whether running errands or going out with friends and family, and forgot where you parked? It can be a stressful experience if you are especially in a location you are unfamiliar with.</p>
            <p class="text-white-75 font-weight-light mb-5">This application will allow you to set your parked location and determine a route to get you back to your car.</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
          </div>
        </div>

      </div>
    </header>



    <!-- about section, done -->
    <section class="page-section bg-primary" id="about">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10 align-self-end">
            <h1 class="text-white-75 font-weight-light mb-5">Where is my car? </h1>
            <hr class="divider my-4">
          </div>
          <div class="col-lg-8 align-self-baseline">
            <p class="text-white-75 font-weight-light mb-5">Have you ever traveled to a location, whether running errands or going out with friends and family, and forgot where you parked? It can be a stressful experience if you are especially in a location you are unfamiliar with.</p>
            <p class="text-white-75 font-weight-light mb-5">This application will allow you to set your parked location and determine a route to get you back to your car.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section, done -->
    <section class="page-section" id="contact">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h2 class="mt-0">Let's Get In Touch!</h2>
            <hr class="divider my-4">
            <div class="mt-5">
              <i class="fas fa-4x fa-heart text-primary mb-4"></i>
              <h3 class="h4 mb-2">Trong Garson</h3>
              <p class="text-muted mb-0">M.S. Information Science & Technology</p>
              <p class="text-muted mb-0">Project Role: Google Map & Database</p>
              <a class="d-block" href="mailto:contact@yourwebsite.com">tua20258@temple.edu</a>
            </div>
            <div class="mt-5">
              <i class="fas fa-4x fa-heart text-primary mb-4"></i>
              <h3 class="h4 mb-2">Haleigh Hunt</h3>
              <p class="text-muted mb-0">P.S.M. Forensic Chemistry </p>
              <p class="text-muted mb-0">Project Role: User Interface</p>
              <a class="d-block" href="mailto:contact@yourwebsite.com">tuj64005@temple.edu</a>
            </div>
            <div class="mt-5">
              <i class="fas fa-4x fa-heart text-primary mb-4"></i>
              <h3 class="h4 mb-2">Chi W. Lau</h3>
              <p class="text-muted mb-0">P.S.M. Biotechnology</p>
              <p class="text-muted mb-0">Project Role: User Interface</p>
              <a class="d-block" href="mailto:contact@yourwebsite.com">tuj80076@temple.edu</a>
            </div>
            <div class="mt-5">
              <i class="fas fa-4x fa-heart text-primary mb-4"></i>
              <h3 class="h4 mb-2">Hisham Naseer</h3>
              <p class="text-muted mb-0">P.S.M. Forensic Chemistry</p>
              <p class="text-muted mb-0">Project Role: Registration & Login</p>
              <a class="d-block" href="mailto:contact@yourwebsite.com">tuf12510@temple.edu</a>
            </div>
            <div class="mt-5">
              <i class="fas fa-4x fa-heart text-primary mb-4"></i>
              <h3 class="h4 mb-2">Peter L. Nguyen</h3>
              <p class="text-muted mb-0">M.S. Information Science & Technology</p>
              <p class="text-muted mb-0">Project Role: Google Map & Database</p>
              <a class="d-block" href="mailto:contact@yourwebsite.com">tuf63125@temple.edu</a>
            </div>		  
          </div>
        </div>
    </section>

    <!--User Guide Section -->
	  <section class="page-section" id="userguide">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="text-black-75 font-weight-light mb-5">User Guide: How to Use our Web Service </h1>
              <hr class="divider my-4">
            </div>
            <div class="col-lg-8 align-self-baseline">
              <p class="text-black-75 font-weight-light mb-5">Welcome! Please register if it's your first time visiting our site or login using the email and password you used when you registered. After this first step a map should pop up on your screen, if not, click on the "Where is my Car?" heading on the top left-hand corner of your screen. You should see two buttons, one that says "I Just Parked" and the other that says "Refresh Directions". After you found your parking spot, just click on the "I Just Parked" button so we can save your parking location. After you do this, you should see a point "A" and a point "B". Point "A" refers to where you parked your car and point "B" refers to your current location. When you're ready to find your car, click on the "Refresh Directions" button so you can have an updated route showing you how to get back to your car!</p>
              <p class="text-black-75 font-weight-light mb-5">If you have any questions, don't feel afraid to contact one of us (refer to the "Contact" section) and we will do our best to help you enjoy your experience using our service! Have a wonderful day!</p>
            </div>
          </div>
        </div>
	  </section>


    <!-- Footer -->
    <footer class="bg-light py-5">
      <div class="container">
        <div class="small text-center text-muted">Copyright &copy; 2019 - Start Bootstrap</div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>

    <script src="js/app.js"></script>

  </body>

</html>
