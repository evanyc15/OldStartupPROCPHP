<!DOCTYPE html>
<html>
<head>
        <!--<link rel="stylesheet" type="text/css" href="css/foundation.css">-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Login Page</title>
       
</head>
 
<body style="background-color: #6A6969">
<canvas id="background-pic" width="8000" height="1000"  style="border: 0px solid black; z-index: -1"></canvas>
<canvas id="transparentBackdrop" width="1280" height="720" style="border: 0px solid black; z-index:0"></canvas>
<script type="text/javascript" src="js/signup.js"></script>
<img id="logo" src="/globalref/images/logo.png"/>
<img id="logobar" src="/globalref/header/images/headerbar.jpg"/>
<form action="php/SignUp.php" method="post">
<table id="text_boxes">
    <tr>
        <td><input id="first" type="text" name="firstname" placeholder="First name"><img id="book_1"src="/globalref/images/bookfirst.png"/></td>
        
        <td><input id="last" type="text" name="lastname" placeholder="Last name"><img id="book_2"src="/globalref/images/booklast.png"/></td>
    </tr>
 
        <tr>
        <td><input id="email" type="text" name="eml" placeholder="Email"><img id="book_3"src="/globalref/images/bookemail.png"/></td>
        <td><input id="password2" type="password" name="pwd" placeholder="Password"><img id="book_4"src="/globalref/images/bookpassword.png"/></td>
    </tr>
</table>
<!-- Password: <input type="password" name="pwd">
Email: <input type="text" name="eml"> -->
<input id="arrow" type="image" name="submit" value="submit" src="/globalref/images/signup_arrow.png" />
</form>
</body>
</html>