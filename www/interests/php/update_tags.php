<?php
session_start();
include('../../../assets/php/globalref/sqlconf.php');
include('../../../assets/php/interests/update_tags.php');
mysqli_close($con);

//if
//header("Location: /interests/");
?>