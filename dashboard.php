<?php

include_once('php/config/core.php');
include_once 'php/config/database.php';
include_once 'php/model/location.php';

session_start();

$database = new Database();
$db = $database->getConnection();

if(!isset($_SESSION["userId"])) {
  session_unset();
  $_SESSION["loginError"] = "Log in first";
  header("location:./login.php");
}

$userId = $_SESSION["userId"];;
$location = new Location($db);
$lastParkedLocation = $location->findLatestFor($userId);

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
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet"> <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Where is my car?</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <form action="php/user/logout.php" method="POST">
              <button class="btn btn-link nav-link" type="submit">Logout</button>
            </form>
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
          <button type="button" class="btn btn-secondary" onClick="dashboard.uploadLocation();">I Just Parked</button>
          <button type="button" class="btn btn-secondary float-right" onClick="dashboard.updateDirections();">Refresh Directions</button>
        </div>
      </div>
<?php
      echo "<div class='row'>";
      echo "  <div class='col-lg-8 offset-lg-2'>";
      echo "    <p id='message-box'>";

      if(empty($lastParkedLocation)) {
      echo "No Stored Parked Car Location";
      }
      
      echo "    </p>";
      echo "  </div>";
      echo "</div>";
?>
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div id="map" style="height: 500px"></div>
        </div>
      </div>
    </div>
  </section>
    <section class="page-section" id="directions-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div id='right-panel'>
            <p>Total Distance: <span id="total"></span></p>
          </div>	
        <div>
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


<?php
echo "<script async defer src='https://maps.googleapis.com/maps/api/js?key=" . GOOGLE_KEY . "&callback=initializeApp'></script>";
?>

<?php
  echo "<script>";
  echo "  window.lastParkedLocation=$lastParkedLocation;";
  echo "  window.baseUrl='". BASE_URL . "';";
  echo "</script>";
    
?>
 

</body>

