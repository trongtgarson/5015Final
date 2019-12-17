<?php
include_once('php/config/core.php');

session_start();
if(isset($_SESSION["userId"])) {
  header("location:./dashboard.php");
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
      <a class="navbar-brand js-scroll-trigger" href="index.php">Home</a>
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

  <header class="masthead">
    <div class="container h-100 align-items-center justify-content-center text-center">

<?php
  if(isset($_SESSION["loginError"])) {
    echo "<div class='row'>";
    echo "<div class='col-lg-4 offset-lg-4 align-self-end'>";
    echo "<div class='alert alert-danger' role='alert'>" . $_SESSION["loginError"] . "</div>";
    echo "</div>";
    echo "</div>";
  }
?>


      <div class="row">
        <div class="col-lg-4 offset-lg-4 align-self-end">
          <div class="card">
            <div class="card-header">Sign In</div>
            <div class="card-body">
              <form action="php/user/login.php" method="POST" id="login-form">

                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-user"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username" autocomplete="off" name="username"></input>
                </div>

                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-key"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password" autocomplete="off" name="password"></input>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn float-right btn-primary">Login</button>
                </div>

              </form>


            </div>

          </div>
        </div>
      </div>
    </div>
  </header>

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

</body>
