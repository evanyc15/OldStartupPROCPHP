<?php
   //connecting to database

   //connecting to database test

   $db = mysql_connect("anilum.com","analumco_admin","Risefromtheashes2013") or die(mysql_error());

   //selecting our database
   $db_select = mysql_select_db("analumco_StartUp", $db) or die(mysql_error());

   //Retrieving data from html form
   $username = $_POST['user'];
   $password = $_POST['pwd'];

   //for mysql injection (security reasons)
   $username = mysql_real_escape_string($username);
   $password = mysql_real_escape_string($password);
   $password = md5($password);

   //checking if such data exist in our database and display result
   $login = mysql_query("SELECT * FROM logininfo WHERE username = '$username' AND
   password = '$password'");
   if(mysql_num_rows($login) == 1) {
      header("Location: UserPage.html");
   }
   else {
      echo "Username and Password does not Match";
   }

?>