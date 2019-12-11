<?php

error_reporting(0);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once '../config/database.php';
include_once '../model/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$users = $user->all();

http_response_code(200);
echo json_encode($users);

?>