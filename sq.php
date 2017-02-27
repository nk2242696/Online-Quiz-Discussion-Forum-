<?php require("header.php"); 
	session_start();
	if(!isset($_SESSION['UserName']))
		{
			
			header("refresh:3; url=login.php");
			die ("Please login first");
		}
?>

<html>
	

	<body>
	
		<center>
		<form method="post" >
		<h4>Enter Your Question  :  </h4>
		<textarea name="que"  maxlength="500" style="width: 500px;height:60;background-color: #D0FFD0; padding-left:0; padding-top:0; padding-bottom:0.04em; padding-right:0.4em;" required></textarea><br><br>
		<h5>Options  : </h5><br>
		Option 1 : <input type="text" name="option1" required>    <input type="radio" name="correct" value="1" required> <br><br>
		Option 2 : <input type="text" name="option2" required>    <input type="radio" name="correct" value="2" required> <br><br>
		Option 3 : <input type="text" name="option3" required>    <input type="radio" name="correct" value="3" required> <br><br>
		Option 4 : <input type="text" name="option4" required>    <input type="radio" name="correct" value="4" required> <br><br>
		<h4>Enter Your Discussion  :  </h4>
		<textarea name="d1"  maxlength="500" style="width: 500px;height:160;background-color: #D0FFD0; padding-left:0; padding-top:0; padding-bottom:0.04em; padding-right:0.4em;" required></textarea><br><br>
		<input type="submit" name="upload" value="Submit Question">
		</form>

		</center>
	</body>
	<?php
	
		
	if(IsSet($_POST['upload'])){
		$que=$_POST['que'];
		$option1=$_POST['option1'];
		$option2=$_POST['option2'];
		$option3=$_POST['option3'];
		$option4=$_POST['option4'];
		$correct=$_POST['correct'];
		$discuss=$_POST['d1'];

		//echo $correct."<br>";

		$client=new MongoClient();
		$db=$client->quiz;
		$collection=$db->ques;
		$count=$collection->find()->count();

		$insertOneResult=$collection->insert(['QID'=>$count+1,'Question'=>$que,'Option1'=>$option1,'Option2'=>$option2,'Option3'=>$option3,'Option4'=>$option4,'Correct'=>$correct,'d1'=>$discuss]);


		$document=$collection->find(['QID'=>2],['_id'=>0,'Question'=>1]);
		//var_dump($document);
		//$docArray=$document.toArray();
		//echo $docArray[0]."aaaaa<br>";
		//var_dump($document);
		foreach($document as $current){
			//echo $current['Question']."<br>";
		}
		//echo "ABCD";
		echo "<h2><center>Congratulations!!!!!!! Your Question Has Been Inserted!!! <br>";
		
		echo "Number of questions in database = ".($count+1)."</h2></center>";
	}

	?>
</html>
