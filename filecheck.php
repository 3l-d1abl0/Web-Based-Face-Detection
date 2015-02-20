<?php
	header('Content-Type: application/json');


	if(!empty($_FILES['file']['name'][0])){

		//$uploaded=array();
		$serverStat=array(
				'status'=>'OK',
				'log'=>'uploaded'
			);


		foreach ($_FILES['file']['name'] as $pos => $name) {
			
			if(move_uploaded_file($_FILES['file']['tmp_name'][$pos], 'up/'.$name)){

				chmod('up/'.$name,0755);

			/*	$uploaded[]=array(
						'name' => $name,
						'file' => 'up/'.$name
					);	*/
				}
				else{
							$serverStat=array(
									'status'=>'ERROR',
									'log'=>'Cannot Upload'
									);

							return json_encode($serverStat);
				}
						

		}//for

		echo json_encode($serverStat);


	}
	else
	{
									$errorlog=array(
									'status'=>'ERROR',
									'log'=>'No file'
									);

							echo json_encode($errorlog);
	}
?>