<?php
		require("header.php"); 
		require_once("utility.php"); 
		session_start();
		if(isset($_POST['exit'])){
			echo "<h3>Your final score is : ".$_SESSION['score']."</h3><br>";
			echo "<script>alert('Your Test Is Over. Better luck next time!!!!');</script>";
			unset($_SESSION['score']);
			header('refresh:1;url=page1.php');
			die();
		}
		if(isset($_POST['submit'])){
			$client=new MongoClient();
			$b=0;
			$db=$client->quiz;
			$collection=$db->ques;
			$document=$collection->find(['QID'=>$_SESSION['cor_ans']]);
			foreach($document as $a){
				$b=$a['Correct'];
				$q=$a['QID'];
				break;
			}
			//echo $q."<br>".$b.$_POST['correct'];
			if(strcmp($b,$_POST['correct'])==0)
			{
				echo "Correct ans!!!<br><br>";
				$_SESSION['score']+=4;
				echo 'Your Score is: '.$_SESSION['score'];
			}
			else{
				echo "Wrong ans!!!!<br><br>";
				$_SESSION['score']--;
				echo 'Your Score is: '.$_SESSION['score'];
			}
			//unset($_POST['correct']);
			header('location:tat.php');
		}

		
		if(isset($_POST['discuss']))
		{
			$client=new MongoClient();
			$b=0;
			$db=$client->quiz;
			$collection=$db->ques;
			$document=$collection->find(['QID'=>$_SESSION['cor_ans']]);
			foreach($document as $a){
				$b=$a['Correct'];
				$q=$a['QID'];
				$d=$a['d1'];
				$que=$a['que'];
		$option1=$a['option1'];
		$option2=$a['option2'];
		$option3=$a['option3'];
		$option4=$a['option4'];
		$correct=$a['correct'];
				break;
			}
			//echo $q."<br>".$b.$_POST['correct'];
			if(strcmp($b,$_POST['correct'])==0)
			{
				echo "Correct ans!!!<br><br>";
				$_SESSION['score']+=4;
				echo 'Your Score is: '.$_SESSION['score'];
				
			}
			else{
				echo "Wrong ans!!!!<br><br>";
				$_SESSION['score']--;
				echo 'Your Score is: '.$_SESSION['score'];
			}
			echo '<h2>DICUSSION........<h2><br>'.$d;
			echo '<form method="post" >';
			echo "<h4>Enter Your Discussion  :  </h4>
			<textarea name='d1'  maxlength='500' style='width: 500px;height:160;background-color: #D0FFD0; padding-left:0; padding-top:0; padding-bottom:0.04em; padding-right:0.4em;' required></textarea><br><br>";
		
			 echo '<input type="submit" name="upload" value="Post Comment"></form><br>';
			 echo '<form method="post" action="tat.php"><input type="submit" name="z" value="Next Question"></form>';
				//unset($_POST['correct']);





		}

		if(IsSet($_POST['upload'])){

			$client=new MongoClient();
			$b=0;
			$db=$client->quiz;
			$collection=$db->ques;
			$document=$collection->find(['QID'=>$_SESSION['cor_ans']]);
			foreach($document as $a){
				$b=$a['Correct'];
				$q=$a['QID'];
				$d=$a['d1'];
				$q=$a['QID'];
				
				$que=$a['que'];
		$option1=$a['option1'];
		$option2=$a['option2'];
		$option3=$a['option3'];
		$option4=$a['option4'];
				break;
			}
		
		$discuss=$d.'<br><br>'.$_POST['d1'];
						
				

			//$insertOneResult=$collection->insert(['QID'=>$q,'Question'=>$que,'Option1'=>$option1,'Option2'=>$option2,'Option3'=>$option3,'Option4'=>$option4,'Correct'=>$b,'d1'=>$discuss]);



					$insertOneResult=$collection->update(array('QID'=>$_SESSION['cor_ans']),array('$set'=>array('d1'=>$discuss)));

		
				echo '<script>alert("YOUR COMMENT IS ADDED")</script>';
				header('refresh:1;url=tat.php');
			
				}	



	?>