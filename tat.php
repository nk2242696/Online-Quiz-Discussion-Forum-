<?php require("header.php"); 
?>
<?php 
	
?>
<?php 
//require("footer.php");
?>
<html>
	

	<body>
	<center>

	</center>
	</body>
	<?php
		session_start();
		if(!isset($_SESSION['UserName']))
		{
			
			header("refresh:3; url=login.php");
			die ("Please login first");
		}
	function getRandomNumbers($min, $max, $count)
{
    if ($count > (($max - $min)+1))
    {
        return false;
    }
    $values = range($min, $max);
    shuffle($values);
    return array_slice($values,0, $count);
}
	$client=new MongoClient();
	$db=$client->quiz;
	$collection=$db->ques;
	$count=$collection->find()->count();
	$nos=getRandomNumbers(1,$count,2);


		$document=$collection->find(['QID'=>$nos[0]]);
		$_SESSION['cor_ans']=$nos[0];
		foreach($document as $var)
		{
			echo $_SESSION['score'];
			echo "<form method='post' action='check.php'>";
			echo "Question "."<br>";
			echo $var['Question']."<br>";

			echo "Option 1 : ".$var['Option1'].'<input type="radio" name="correct" value="1"><br>';
			echo "Option 2 : ".$var['Option2'].'<input type="radio" name="correct" value="2"><br>';
			echo "Option 3 : ".$var['Option3'].'<input type="radio" name="correct" value="3"><br>';
			echo "Option 4 : ".$var['Option4'].'<input type="radio" name="correct" value="4"><br>';
			echo "<input type='submit' name='submit' value='Submit Answer'><br>";
			echo "<input type='submit' name='discuss' value='Discuss Answer'><br>";
			echo "<input type='submit' value='exit' name='exit'></form>";
		}
	



	?>
	
</html>