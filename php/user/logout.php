<?php

include_once('../config/core.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

session_start();
session_unset();
session_destroy();

header("location:../../index.html");

?>
