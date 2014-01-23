<!-- Include header -->
<?php
	include('globalref/php/sqlconf.php');
	include('globalref/php/sessionstart.php');
	
	// Check if they are already logged in
	if (isset($_SESSION['email']))
	{
		$user_check = $_SESSION['email'];
		$ses_query = mysqli_query($con,"SELECT Email FROM Users WHERE Email = '$user_check'");
		$row = mysqli_fetch_array($ses_query);
		$login_session = $row['Email'];
		if(isset($login_session))
		{
			header("Location: home/");
		}
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$email = addslashes($_POST['eml']);
		$password = addslashes($_POST['pwd']);
		$password = md5($password);
		
		$sql = "SELECT * FROM Users WHERE Email = '$email' AND Password = '$password'";
		$result = mysqli_query($con,$sql);
		
		$numRows = mysqli_num_rows($result);
		
		$row = mysqli_fetch_array($result);
		$_SESSION['FirstName'] = $row['FirstName'];
		$_SESSION['LastName'] = $row['LastName'];
		$_SESSION['id'] = $row['User_PK'];
		
		if($numRows == 1)
		{
			$_SESSION['email'] = $email;
			mysqli_close($con);
			header("Location: home/");
		}
		else
		{
			echo '<script type="text/javascript">
				alert("Could not find that combination!");
			</script>';	
		}
		mysqli_close($con);
	}
?>
<!DOCTYPE html>
<html>
<head>
  <!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
  <link rel="stylesheet" href="./login/css/style.css" type="text/css"/>
  <script src="globalref/js/jquery-1.9.1.min.js"></script>
  <title>Anilum | The Social Market</title>
</head>
<body>

<div id="navigation">
	<a href="localhost/">Home</a>
	<a href="browse/">Shop</a>
	<a href="post/">Sell</a>
	<a href="">Friends</a>
	<a href="">Information</a>
</div>

<table id ="login">
	<tr><td style ="height: 19px">
	<form action="" method="post">
		<input id="tb" maxlength="25" name="eml" placeholder="Email">
		<input id="tb" type ="password" maxlength="25" name="pwd" placeholder="Password">
		<input id="button" type="submit" value="Log In">
	</form>
	</td></tr>
	<tr style ="margin-left: 5px"><td id = "links">
	<a href="/signup/index.php" id="textlink">Not a member?</a>
	</td></tr>
</table>

<div>
	<!--<img src="/globalref/images/scrolling_anilum2.jpg">-->
</div>


<div class="center-logo">
	<img src="/globalref/header/images/headerlogo.png" id="logo">
</div>
	
<div class="center-theme">
	<img src="/globalref/header/images/headerbarborder.jpg" id="border">
</div>
    <div class="push"></div>
</div>

<table id="table">
	<tr>
		<td style="width: 20px">
		</td>
		<td id="textrow">
			<p id="header">Buy</p>
			<p id="textbody">A new social way to find great deals around you</p>
		</td>
		<td id="spacer">
		</td>
		<td id="textrow">
			<p id="header">Sell</p>
			<p id="textbody">We advertise for you! Selling has never been so easy</p>
		</td>
		<td id="spacer">
		</td>
		<td id="textrow">
			<p id="header">Blog</p>
			<p id="textbody">Blog great merch, generate a following, impact the market</p>
		</td>
		<td style="width: 20px">
		</td>
	</tr>
	</table>
        </div>
</body>
</html>