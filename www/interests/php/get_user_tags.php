<?php
require('../../../assets/php/globalref/sqlconf.php');
session_start();
require('../../../assets/php/interests/get_user_tags.php');
mysqli_close($con);
?>