<?php
	header('Content-Type: application/json');
	session_start();
	require_once("config.php");

	$con = mysqli_connect(SERVER,USER,PASSWORD,DATABASE);
	if (!$con) {
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Connection failure: ".mysqli_connect_error();
		echo json_encode($_SESSION);
		exit();
	}

	$query = "select Host, Size, ElapsedTime, LoopOrder from PLogs where LoopOrder not like 'BubbleSort%';";
	$result = mysqli_query($con, $query);
	if (!$result) {
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "Plot41b read Failed: ".mysqli_error($con);
		echo json_encode($_SESSION);
		exit();
	} 
	// Fetch data 
	$data = array();
	while ($dataset = mysqli_fetch_assoc($result)) {
		$data[] = $dataset;
	};
	mysqli_close($con);
	echo json_encode($data);
	exit();
?> 