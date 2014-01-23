<?php
	session_start();
	require('../../../assets/php/globalref/sqlconf.php');
	require('../../../assets/php/notifications/retrieve_notifications.php');
	mysqli_close($con);
?>