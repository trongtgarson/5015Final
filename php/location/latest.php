<?php

include_once('../config/core.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once '../config/database.php';
include_once '../model/location.php';

session_start();

if(!isset($_SESSION["userId"])) {
  session_unset();
  $_SESSION["loginError"] = "Log in first";
  header("location:./login.php");
}

$database = new Database();
$db = $database->getConnection();
$location = new Location($db);

$userId = $_SESSION["userId"];;

$lastParkedLocation = $location->findLatestFor($userId);

echo $lastParkedLocation

?>
