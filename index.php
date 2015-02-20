<?php
ob_start();
session_start();
?>
<!DOCTYPE>
<html>
	<head>
		<title>Lets Face It</title>

		<meta name="viewport" content="width=device-width , initial-scale=1.0">		
		<link href="css/custom.css" type="text/css" rel="stylesheet" media="screen">
		<script type="text/javascript" src="js/jquery.1.11.1.js"></script>		
		<script type="text/javascript" src="js/essential.js"></script>
		<script type="text/javascript" src="js/hkeeping.js"></script>
		
	</head>


<body id="body">
<!--
	<div id="topBar">
		<center><span style="color:grey;font-weight:bold;font-size:22px">Let the Face do the Talkin'</span> </center>
	</div>
-->
	<div id="container">

			<div id="workspace">
				<div id="display">
						<center>	<img src="img/def.jpg" alt="Processed Image" id="pimg">		</center>
						<center>	<img src="img/ajax-loader.gif" alt="Processing" id="processing">	</center> 
				</div>
				<div id="single">

					 <!--
						
						<img src="img/def.jpg" alt="Def Image" class="Division"> 
						<img src="img/def.jpg" alt="Def Image" class="Division"> 
						<img src="img/def.jpg" alt="Def Image" class="Division"> 
						<img src="img/def.jpg" alt="Def Image" class="Division"> 
						<img src="img/def.jpg" alt="Def Image" class="Division"> 
						<img src="img/def.jpg" alt="Def Image" class="Division"> 
						<img src="img/def.jpg" alt="Def Image" class="Division"> 
						<img src="img/def.jpg" alt="Def Image" class="Division"> 
						<img src="faces/image2-12.jpg" alt="Def Image" class="Division">
					<img src="faces/image2-9.jpg" alt="Def Image" class="Division">
					<img src="faces/image2-10.jpg" alt="Def Image" class="Division">
					<img src="faces/image2-10.jpg" alt="Def Image" class="Division">
					-->
					

				</div>
			</div>

			<div id="gallery">

				<div class="disp">
				<center>
				
						<!--
						<img src="img/img.jpg" alt="Def Image" class="gall">  	-->

						<?php

								$directory = '/var/www/testing/twoFace/up/';
                                $files = glob($directory . '{*.jpg,*.JPG,*.png}', GLOB_BRACE);


								if ( $files !== false )
								{

									$i=0;
			  					 foreach ($files as $fname) {
			  						//echo $fname." => " . date ("Y-m-d H:i:s.", filemtime($fname))."<br>";
			  						$time[$i]=date ("Y-m-d H:i:s.", filemtime($fname));
			  						$i+=1;
			  					 }

			  					 array_multisort($time, SORT_DESC, $files);
								    //$filecount = count( $files );

								    foreach ($files as $fname) {

								    	$seg=explode('/',$fname);
								    	$len=count($seg);
								    	//echo $seg[$len-1]."<br>";

								    	echo '<img src="up/'.$seg[$len-1].'" alt="Uploaded Image" class="gall"> ';
								    }
    								//echo $filecount;
								}
								else
								{
    								echo 0;
								}




						?>
						

					
				
				</center>

				</div>

				<div class="dwrapper">
						<div class="dropzone" id="dropzone">
						Drop Images to upload
						</div>
				</div>
				
			</div>
			

	</div>
<!--
	<div id="outer">
    <div id="one">Div 1!</div>
    <div id="two">Div 2!</div>
    <div id="three">Div 3!</div>
</div>
 	-->
	
</body>

</html>