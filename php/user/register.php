<?php

include_once('../config/core.php');
include_once '../config/database.php';
include_once '../model/user.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

$contactName = $_POST["contactName"];
$username = $_POST["username"];
$password = $_POST["password"];
$passwordConfirm = $_POST["passwordConfirm"];

session_start();
unset($_SESSION["registerError"]);

$_SESSION["contactName"] = $contactName;
$_SESSION["username"] = $username;

function registerFailed($message) {
  $_SESSION["registerError"] = $message;
  header("location:../../register.php");
}

if(empty($contactName) || empty($username) || empty($password) || empty($passwordConfirm)) {
  registerFailed("Required fields missing.");
}

if($password != $passwordConfirm) {
  registerFailed("Password Confirmation did not match.");
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(empty($user->find($username))) {
  if($user->create($username, $password, $contactName)) {

    if($user->sendActivationCode($username)) {
      $_SESSION["message"] = "Activation email sent.";
      header("location:../../index.php");
    } else {
      registerFailed("Failed to send registration email.");
    }
  } else {
    registerFailed("Failed to create user");
  }
} else {
  registerFailed("Email already registered");
}

?>
