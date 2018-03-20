<?php
require_once("checklogin.php");
if(isset($_POST['submit'])){
	if(strcmp($_POST['newconfirmpassword'],$_POST['newpassword'])==0){
	$mysqli = new MySQLi('localhost', 'root', '', 'chatlogin'); 
	if($mysqli->errno){
		//connection wasn't made
		//handle the error here
		header("location: dashboard.php");
	}
	$stmt = $mysqli->prepare("SELECT password FROM logincred WHERE username = '".$_SESSION['user']."'");
	$stmt->execute();
	$stmt->bind_result($pass); 
	$stmt->fetch(); 
	
	//close all connections
	$stmt->close();
	$mysqli->close();
	if(strcmp($pass,$_POST['oldpassword'])==0){
				if(strcmp($_POST['newpassword'],$_POST['oldpassword'])!=0){
		$mysqli1 = new MySQLi('localhost', 'root', '', 'chatlogin'); 
	if($mysqli1->errno){
		//connection wasn't made
		//handle the error here
		header("location: dashboard.php");
	}
	$stmt = $mysqli1->prepare("Update logincred set password='".$_POST['newpassword']."' WHERE username = '".$_SESSION['user']."'");
	$stmt->execute();	
	//close all connections
	$stmt->close();
	$mysqli1->close();
	echo '<html><script>alert("Password Updated!");</script></html>';
	}
	else echo '<html><script>alert("Old and new passwords cannot be same!");</script></html>';
	}
	else {
		echo '<html><script>alert("You entered the wrong password!");</script></html>';
	}
	}
	else
		echo '<html><script>alert("Passwords dont match!");</script></html>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change password</title>
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

				<form method="post" action="changepass.php">
					<span class="login100-form-title">
						Change Password
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Password is required" required>
						<input class="input100" type="password" name="oldpassword" placeholder="Enter Old Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required" required>
						<input class="input100" type="password" name="newpassword" placeholder="Enter New Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required" required>
						<input class="input100" type="password" name="newconfirmpassword" placeholder="Confirm New Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="submit">
						</input>
					</div>
					<div class="text-center p-t-12">
						<a class="txt2" href="dashboard.php">
							Go back
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