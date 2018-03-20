<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load composer's autoloader
require 'vendor/autoload.php';

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(isset($_POST['username'])&&isset($_POST['email'])&&$_POST['username']!=''&&$_POST['email']!=''){
$reset=$_POST['username'];
	$mysqli = new MySQLi('localhost', 'root', '', 'chatlogin');  
	if($mysqli->errno)
		header("location: index.php"); 
	$stmt = $mysqli->prepare("SELECT COUNT(username) AS total FROM logincred WHERE username = '".$reset."'");
	$stmt->execute();
	$stmt->bind_result($total); 
	$stmt->fetch(); 
	$stmt->close();
	$stmt3 = $mysqli->prepare("SELECT email FROM logincred WHERE username = '".$reset."'");
		$stmt3->execute();
		$stmt3->bind_result($total2); 
		$stmt3->fetch();
		$stmt3->close();
	if((int)$total == 1&&$_POST['email']==$total2)
	{		
		$newpass=generateRandomString();
		$stmt2 = $mysqli->prepare("UPDATE logincred SET password='".($newpass)."' WHERE username = '".$reset."'");
		$stmt2->execute();
		$stmt2->close();
		$mail = new PHPMailer(true);
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->IsSMTP();
		$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
		$mail->Username = 'fool19991@gmail.com';                    // SMTP username
		$mail->Password = 'nataliePort';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;
		$mail->From="vaidhyesh1@gmail.com";
		$mail->FromName = "Vaidhyesh Sundar";
		 $mail->AddAddress($total2);
         $mail->Subject = "Your password is reset";
         $mail->Body = "Hi ".$reset.", your password was reset and your new password is:".$newpass;
if(!$mail->Send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "<script>alert('Reset password has been set to your email');</script>";
}
		}
	else
	{
		echo "<script>alert('Wrong username/Email-id');</script>";
		echo "<h2>Sorry the service failed</h2>";
	//	header("location: index.html"); 
	}
	$mysqli->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forgot Password</title>
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

				<form method="post" action="forgotpass.php">
					<span class="login100-form-title">
						Forgot Password
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter the username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email Address">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
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