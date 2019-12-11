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

if(empty($user->find($username))) {
  if($user->create($username, $password)) {
    http_response_code(200);
    echo "Created";
  } else {
    http_response_code(500);
    echo "Failed to create user";
  }
} else {
  http_response_code(400);
  echo "Username already registered";
}



?>
