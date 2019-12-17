<?php

include_once('../config/core.php');
include_once '../config/database.php';
include_once '../model/user.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

$username = $_POST["username"];
$password = $_POST["password"];

session_start();
unset($_SESSION["loginError"]);

if(empty($username) || empty($password)) {
  $_SESSION["username"] = $username;
  $_SESSION["loginError"] = "Login Failed";
  header("location:../../login.php");
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$target = $user->find($username);

if(empty($target)) {
  $_SESSION["loginError"] = "Login Failed";
  header("location:../../login.php");
} 

if(password_verify($password, $target["password"])) {
  $_SESSION["userId"] = $target["id"];
  $_SESSION["loginTime"] = time();
  header("location:../../dashboard.php");
} else {
  $_SESSION["loginError"] = "Login Failed";
  header("location:../../login.php");
}

?>
