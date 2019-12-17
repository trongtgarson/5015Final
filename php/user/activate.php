<?php

include_once('../config/core.php');
include_once '../config/database.php';
include_once '../model/user.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

$username = $_GET["username"];
$activationCode = $_GET["activationCode"];

session_start();
unset($_SESSION["activateError"]);
unset($_SESSION['activateSuccess']);

if(empty($username) || empty($activationCode)) {
  $_SESSION["username"] = $username;
  $_SESSION["error"] = "Activation Failed";
  header("location:../../index.php");
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$target = $user->find($username);

if(empty($target) || !empty($target["activatedAt"])) {
  $_SESSION["activateError"] = "Activation Failed";
  header("location:../../activate.php");
} 

if($target["activationCode"] == $activationCode) {
  if($user->activateNow($target)) {
    $_SESSION["userId"] = $target["id"];
    $_SESSION["loginTime"] = time();
    header("location:../../dashboard.php");
  } else {
    $_SESSION["loginError"] = "Activation Failed";
    header("location:../../activate.php");
  }

} else {
  $_SESSION["loginError"] = "Activation Failed";
  header("location:../../activate.php");
}

?>
