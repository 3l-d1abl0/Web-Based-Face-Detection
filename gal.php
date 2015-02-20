<?php

	/*if(empty($_POST['stat'])) {

			echo "Err11or"."<br>";		
	}
	else{*/


		$directory = '/var/www/testing/twoFace/up/';
        $files = glob($directory . '{*.jpg,*.JPG,*.png}', GLOB_BRACE);

        uasort($files, "newest");

		if ( $files !== false ){
			  //$filecount = count( $files );
			$gall="<center>";

			$i=0;
			foreach ($files as $fname) {
				//echo $fname." => " . date ("Y-m-d H:i:s.", filemtime($fname))."<br>";
				$time[$i]=date ("Y-m-d H:i:s.", filemtime($fname));
				$i+=1;
			}

			array_multisort($time, SORT_DESC, $files);


			  foreach ($files as $fname) {

				 	$seg=explode('/',$fname);
			   		$len=count($seg);
			   	//echo $seg[$len-1]."<br>";

			  		$gall.='<img src="up/'.$seg[$len-1].'" alt="Uploaded Image" class="gall"> ';
			   }

			   echo $gall."</center>";
    								//echo $filecount;
		}
		else
		{
    		echo "EError"."<br>";
		}
	//}

?>