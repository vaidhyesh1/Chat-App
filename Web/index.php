<?php
session_start();
require_once("function.php");
if(isset($_POST['username'], $_POST['password']))
{
	$mysqli = new MySQLi('localhost', 'root', '', 'chatlogin');   // Database connectivity
	if($mysqli->errno){
		//connection wasn't made
		//handle the error here
		header("location: index.php");
	}
	$stmt = $mysqli->prepare("SELECT COUNT(username) AS total FROM logincred WHERE username = '".$_POST['username']."' AND password = '".($_POST['password'])."'");
	$stmt->execute();
	$stmt->bind_result($total); 
	$stmt->fetch();     // Match username and password
	
	//close all connections
	$stmt->close();
	$mysqli->close();

	if((int)$total == 1)
	{
		session_regenerate_id(true);
		$_SESSION['user'] = $_POST['username'];
		$key = generate_key();
		$hash = hash_hmac('sha512', $_POST['password'], $key);    // Create a new session
		$_SESSION['key'] = $key;
				$_SESSION['passchange']="Hello User";
		$_SESSION['auth'] = hash_hmac('sha512', $key, 
				    hash_hmac('sha512', $_SESSION['user'] . 
						(isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 
					 	       $_SERVER['HTTP_X_FORWARDED_FOR'] : 
					               $_SERVER['REMOTE_ADDR']), $hash));
		$_SESSION['otp'] = rand(1000,9999);   // Random number generation
				$_SESSION['count']=0;
$mysqli = new MySQLi('localhost', 'root', '', 'chatlogin'); 
				if($mysqli->errno){
		//connection wasn't made
		//handle the error here
		header("location: otp.php");
	}
		$stmt = $mysqli->prepare("SELECT phonenumber FROM logincred WHERE username = '".$_SESSION['user']."'");
		$stmt->execute();
		$stmt->bind_result($phno); 
		$stmt->fetch(); 
		$stmt->close();
		$mysqli->close();
		$web='https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=7zR64Qf3PUe9iAURFblc8A&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number='.$phno.'&text=Your%20OTP%20is%3A'.$_SESSION['otp'].'&route=clickhere';
		//$web='https://smsapi.engineeringtgr.com/send/?Mobile=9066264327&Password=nelloregaaru&Message=Your%20OTP%20is%3A'.$_SESSION['otp'].'&To='.$phno;
		$num=file_get_contents($web);
		$_SESSION['response']=$num;
		if(!setcookie('hash', $hash, 0, '/')) 
		{
			session_regenerate_id(true);
			header("location: otp.php"); 
			exit();
		}
		header("location: otp.php");
	}
	else
	{
echo '<script type="text/javascript">'; 
echo 'alert("Wrong Username/Password ");'; 
echo 'window.location = "index.php";';
echo '</script>';
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form method="post" action="index.php">
					<span class="login100-form-title">
						Member Login
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit">
						</input>
					</div>
					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="forgotpass.php">
							Username/Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>