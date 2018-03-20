<?php
if(isset($_POST['phonenumber'],$_POST['username'],$_POST['password'],$_POST['confirmpassword'],$_POST['email'])){
	if($_POST['password']==$_POST['confirmpassword']){
		$mysqli = new MySQLi('localhost', 'root', '', 'chatlogin'); 
	if($mysqli->errno){
		//connection wasn't made
		//handle the error here
		header("location: index.php");
	}
	$stmt1 = $mysqli->prepare("SELECT COUNT(username) AS total FROM logincred WHERE username = '".$_POST['username']."'");
	$stmt1->execute();
	$stmt1->bind_result($total); 
	$stmt1->fetch(); 
	$stmt1->close();
	if($total!=1){
	$stmt = $mysqli->prepare("Insert into logincred(username,password,email,phonenumber) values ('".$_POST['username']."','".$_POST['password']."','".$_POST['email']."','".$_POST['phonenumber']."');");
	$stmt->execute();	
	//close all connections
	$stmt->close();
	$mysqli->close();
	echo '<script>alert("Registration Successful");</script>';
	}
	else echo '<html><script>alert("User already exists,Try again!");</script></html>';
	}
	else 
		echo '<html><script>alert("Passwords dont match!");</script></html>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>New User Registration</title>
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

				<form method="post" action="register.php">
					<span class="login100-form-title">
						New User Registraion
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter the username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid Phone number required">
						<input class="input100" type="text" name="phonenumber" placeholder="Phone Number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Enter the email">
						<input class="input100" type="text" name="email" placeholder="Email">
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
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="confirmpassword" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit">
						</input>
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