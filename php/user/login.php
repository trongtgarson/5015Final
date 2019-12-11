<?php

error_reporting(0);

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

if(empty($target)) {
  http_response_code(401);
  echo "Login Failed";
  exit;
} 

if(password_verify($password, $target["password"])) {
  http_response_code(200);
  session_start();
  $_SESSION["userId"] = $target["id"];
  $_SESSION["loginTime"] = time();
  echo "Success";
} else {
  session_unset();
  session_destroy();
  http_response_code(401);
  echo "Login Failed";
  exit;
}

?>
