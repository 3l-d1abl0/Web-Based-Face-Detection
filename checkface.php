<?php

	if(empty($_POST['filePath']) || empty($_POST['absName']) || empty($_POST['exten'])) {

			echo "Error"."Post";		
	}
	else{

		$filePath=$_POST['filePath'];
		$fileName=$_POST['absName'];
		$extension=$_POST['exten'];
		$opdir="det/";

			//$command="./fd --ipdir=".$filePath." --opdir=".$opdir." --fname=".$fileName." --ext=".$extension." 2>&1";
			$command="./fd --ipdir=".$filePath." --opdir=".$opdir." --fname=".$fileName." --ext=".$extension."";

			//echo $command;
			$stat=exec($command,$out);

			echo $stat;
	}



			
?>