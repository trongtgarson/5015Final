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

$locations = $location->findLatestFor($userId);

http_response_code(200);
echo json_encode($locations);

?>
