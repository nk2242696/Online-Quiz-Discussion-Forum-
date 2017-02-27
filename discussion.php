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
			echo $q."<br>".$b.$_POST['correct'];
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
			unset($_POST['correct']);
		}

		header('location:tat.php');
	?>