<?php

include_once('../config/core.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '../config/database.php';
include_once '../model/user.php';

$username = $_POST["username"];
$password = $_POST["password"];

if(empty($username) || empty($password)) {
  http_response_code(400);
  echo "Username and Password Required";
  exit;
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$target = $user->find($username);

session_start();
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
