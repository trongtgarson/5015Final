<?php
	header('Access-Control-Allow-Origin: *');
	session_start();
	$Size = $_GET["Size"];
	print "Size($Size) \n";
	$command= escapeshellcmd("python/correctness.py ".$Size." 2>&1");
	$output = shell_exec($command);
	echo $output;
?>