<?php
	 require("header.php"); 
	require_once("utility.php"); 
	session_start();
	session_destroy();
	#header("location:login.php");
	header( "refresh:3;url=login.php" );
	echo "<h1>Thanks for visiting! you are being logged out!........</h1>";
?>