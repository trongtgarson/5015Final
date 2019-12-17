<?php
	header('Access-Control-Allow-Origin: *');
	session_start();
	require_once("config.php");
	$Size = $_GET["Size"];
	$Rep = $_GET["Rep"];
	print "Size($Size) Rep($Rep) \n";
	echo "<pre>";
	echo exec("python/bestOrder.py ".$Size." ".$Rep." ".SERVER." ".USER." ".PASSWORD." ".DATABASE." 2>&1", $output);
	var_dump ($output);
	echo "</pre>"; 
	/*
	$command= escapeshellcmd("python/bestOrder.py ".$Size." ".$Rep." 2>&1");
	$output = shell_exec($command);
//	exec("python/bestOrder.py ".$Size." ".$Rep." 2>&1", $output);
	echo $output;
	*/
?>