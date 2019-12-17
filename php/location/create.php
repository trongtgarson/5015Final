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
  echo "{error: 'No Active Session' }";
  exit;
}

$userId = $_SESSION["userId"];
if(empty($userId)) {
  http_response_code(401);
  echo "{error: Not Authenticated' }";
  exit;
}

$location = new Location($db);

$latitude = (float)$_POST["lat"];
$longitude = (float)$_POST["lng"];

$success = false;
if(!(empty($latitude) || empty($longitude))) {
  $success = $location->create($latitude, $longitude, $userId);
}

if($success) {
  http_response_code(200);
  echo "{}";
} else {
  http_response_code(500);
  echo "{ error: 'Failed to save location' }";;
}

?>
