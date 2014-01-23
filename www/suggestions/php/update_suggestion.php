<?php
session_start();
require('../../../assets/php/globalref/sqlconf.php');
require("../../../assets/php/globalref/get_user_info.php");
require('../../../assets/php/suggestions/update_suggestion.php');
mysqli_close($con);
?>