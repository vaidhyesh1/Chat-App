<?php
require_once("checklogin.php");
$otp=$_SESSION['otp'];
//echo $_SESSION['response'];
if(!isset($_SESSION['user']))
	header("location: index.php");
if(isset($_POST['submit'])&&isset($_POST['otp'])){
	if(strcmp($_POST['otp'],$otp)==0){
		header("location: dashboard.php");
	}
	if($_SESSION['count']<4){
			echo '<script>alert("Wrong OTP,'.(4-$_SESSION['count']).' tries left");</script>';
			$_SESSION['count']=$_SESSION['count']+1;
	}
	if($_SESSION['count']==4){
		session_destroy();
		header("location: index.php");
	}
	}
?>
<!DOCTYPE html>
<html lang="en">
<style>
#partitioned {
  padding-left: 15px;
  letter-spacing: 42px;
  border: 0;
  background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
  background-position: bottom;
  background-size: 50px 1px;
  background-repeat: repeat-x;
  background-position-x: 35px;
  width: 220px;
  min-width:220px;
}

#divInner{
  left: 0;
  position: sticky;
}

#divOuter{
  width:190px; 
  overflow:hidden
}
</style>
<script>
var obj = document.getElementById('partitioned');
obj.addEventListener("keydown", stopCarret); 
obj.addEventListener("keyup", stopCarret); 

function stopCarret() {
	if (obj.value.length > 3){
		setCaretPosition(obj, 3);
	}
}

function setCaretPosition(elem, caretPos) {
    if(elem != null) {
        if(elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        }
        else {
            if(elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            }
            else
                elem.focus();
        }
    }
}
</script>
<head>
	<title>Enter OTP</title>
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

				<form method="post" action="otp.php">
					<span class="login100-form-title">
						Enter OTP here
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter the OTP">

					<div id="divOuter">
					<div id="divInner">
						<input class="input100" type="text" name="otp" placeholder="Enter OTP" maxlength="4">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						</div>
					
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" name="submit" type="submit">
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