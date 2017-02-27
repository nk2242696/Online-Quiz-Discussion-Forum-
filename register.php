<!DOCTYPE html>
<?php require("header.php"); 
require_once("utility.php"); 
session_start();
	if(isset($_SESSION['UserName'])){
		die("<h3>You Are Already Logged In</h3>");
	}
?>
<html>
<head>
	<title></title>
</head>
<body>
<center>
<form action="register.php" method="post">
<br><br>
	Email <input type="text" name="Email" required><br><br>
	UserName <input type="text" name="UserName" required><br><br>
	Password <input type="password" name="Password" required><br><br>
	<input type="submit" name="Register"><br><br>
</form>
</center>
</body>
<?php
	//require 'vendor/autoload.php';

	if(IsSet($_POST['Register'])){
		$email=$_POST['Email'];
		$pass=$_POST['Password'];
		$uname=$_POST['UserName'];

		$client=new MongoClient();
		$db=$client->quiz;
		$collection=$db->pass;
		$document=$collection->find(
			['Email'=>$email]
		);
		$count=$document->Count();
		//echo $count."%%%%";
		if($count>0){
			die("<center>Email Already Exists</center>");
		}
		$document=$collection->find(
			['UserName'=>$uname]
		);
		$count=$document->Count();
		//echo $count."%%%%";
		if($count>0){
			die("<center>User Name Already Exists</center>");
		}
		var_dump($document);
		
		$insertOneResult=$collection->insert(['Email'=>$email,'UserName'=>$uname,'Password'=>$pass]);
	}
	
?>
</html>