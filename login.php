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
<br><br>
Login Screen<br><br><br>

<form action="login.php" method="post">
	UserName <input type="text" name="UserName" required><br><br>
	Password <input type="password" name="Password" required><br><br>
	<input type="submit" name="Login" required><br>
</form>
</center>
</body>
<?php
	session_start();
	if(IsSet($_POST['Login'])){
		$pass=$_POST['Password'];
		$uname=$_POST['UserName'];

		$client=new MongoClient();
		$db=$client->quiz;
		$collection=$db->pass;


		$document=$collection->find(
			['UserName'=>$uname]
		);
		$count=$document->Count();
		//echo $count."%%%%";
		if($count==0){
			die("<center>User Name Does Not Exist</center>");
		}
		//var_dump($document);
		else{
			$document=$collection->find(
				['Password'=>$pass]
			);
			$count=$document->Count();
			if($count==0){
				die("<center>User Name and Password Doesn't match</center>");
			}
			else{
				$_SESSION['UserName']=$uname;
				$_SESSION['score']=0;
				header("location:page1.php");
			}
		}
	}
	
?>
</html>