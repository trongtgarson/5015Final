<?php

include_once '../config/core.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once '../config/database.php';
include_once '../model/location.php';

$database = new Database();
$db = $database->getConnection();

$location = new Location($db);

$locations = $location->all();

http_response_code(200);
echo json_encode($locations);

?>
