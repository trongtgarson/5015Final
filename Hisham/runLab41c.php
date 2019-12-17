<?php
	header('Access-Control-Allow-Origin: *');
	session_start();
	require_once("config.php");
	$Order = $_GET["Order"];
	$startSize = $_GET["SSize"];
	$endSize = $_GET["ESize"];
	$Step = $_GET["Step"];
	print " Order($Order) Start($startSize) End($endSize) Step($Step) \n";
	echo "<pre>";
	echo exec("python/scalability.py ".$startSize." ".$endSize." ".$Step." ".$Order." ".SERVER." "
		.USER." ".PASSWORD." ".DATABASE." 2>&1", $output); 
	var_dump ($output);
	echo "</pre>"; 
	/*
	$command= escapeshellcmd("python/bestOrder.py ".$Size." ".$Rep." 2>&1");
	$output = shell_exec($command);
//	exec("python/bestOrder.py ".$Size." ".$Rep." 2>&1", $output);
	echo $output;
	*/
?>