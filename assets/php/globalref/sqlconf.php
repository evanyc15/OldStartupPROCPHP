<?php
	
<<<<<<< HEAD
	$con = new mysqli('prod.chbdumuwvxif.us-west-2.rds.amazonaws.com','analumco','Riseashes2013','analumco_usa_PROD');
=======
	$con = new mysqli('analum.com','analumco_admin2','1a233b455c6d567ee89395f290','analumco_usa_PROD');
>>>>>>> refs/remotes/origin/master
	
	if($con->connect_errno > 0){
		die('Unable to connect to database [' . $con->connect_error . ']');
	}
	
	//Don't echo or it will mess up ajax json calls
	/*else{
		printf("Successfully connected to DB.\n");
	}*/
	
?>
