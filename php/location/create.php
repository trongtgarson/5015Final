<?php

include_once('../config/core.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once '../config/database.php';
include_once '../model/location.php';

$database = new Database();
$db = $database->getConnection();

session_start();

if(empty($_SESSION)) {
  http_response_code(401);
  echo "No Active Session";
  exit;
}

$userId = $_SESSION["userId"];
if(empty($userId)) {
  http_response_code(401);
  echo "Not Authenticated";
  exit;
}

$location = new Location($db);

$latitude = (float)$_POST["latitude"];
$longitude = (float)$_POST["longitude"];

$success = false;
if(!(empty($latitude) || empty($longitude))) {
  $success = $location->create($latitude, $longitude, $userId);
}

var_dump($latitude);
var_dump($longitude);
var_dump($userId);

if($success) {
  http_response_code(200);
  echo "Success";
} else {
  http_response_code(500);
  echo "Failed to save location";
}

?>
