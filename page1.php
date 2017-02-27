<?php require("header.php"); 
session_start();
?>
<?php 
echo "<center><h2><br>WELCOME ".$_SESSION['UserName']."</center></h2>";



?>
<?php require("footer.php");?>