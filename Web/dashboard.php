<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ClusterChat</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php">Cluster Chat</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Your Profile</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="addmoney.php">
            <i class="fa fa-bank"></i>
            <span class="nav-link-text">Add Money to Wallet</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="viewbal.php">
            <i class="fa fa-address-card	"></i>
            <span class="nav-link-text">View Balance</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="sendmoney.php">
            <i class="fa fa-arrow-right"></i>
            <span class="nav-link-text">Send Money</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="groups.php">
            <i class="fa fa-address-card	"></i>
            <span class="nav-link-text">Groups</span>
          </a>
        </li>
        </li>

          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
            
              </ul>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="dashboard.php">Your Chat Space</a>
                </div>
            
			
            </div>
        </nav>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
		<li class="nav-item">
		<div class="dropdown">
		<button class="dropbtn"><?php echo 'Hi '.$_SESSION['user'] ?></button>
		<div class="dropdown-content">
		<a href="changepass.php">Change Password</a>
		<a href="imageup.php">Update Image</a>
		<a href="qr.php">Connect to Mobile</a>
		 <a data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
		</div>
</div>
		</li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
     
    </div>
	
	<?php
require_once("function.php");
if(isset($_POST['submit'])){
	$mysqli1 = new MySQLi('localhost', 'root', '', 'chatlogin'); 
	if($mysqli1->errno){
		//connection wasn't made
		//handle the error here
		header("location: dashboard.php");
	}
	$stmt = $mysqli1->prepare("Update logincred set email='".$_POST['email']."',phonenumber='".$_POST['phonenumber']."',name='".$_POST['name']."',age='".$_POST['age']."'  WHERE username = '".$_SESSION['user']."'");
	$stmt->execute();	
	//close all connections
	$stmt->close();
	$mysqli1->close();
	echo '<html><script>alert("Details Updated!");</script></html>';
}
	$mysqli = new MySQLi('localhost', 'root', '', 'chatlogin'); 
	if($mysqli->errno){
		//connection wasn't made
		//handle the error here
		header("location: dashboard.php");
	}
	$stmt = $mysqli->prepare("SELECT image,email,phonenumber,name,age FROM logincred WHERE username = '".$_SESSION['user']."'");
	$stmt->execute();
	$stmt->bind_result($image,$email,$phonenumber,$name,$age); 
	$stmt->fetch(); 
	
	//close all connections
	$stmt->close();
	$mysqli->close();
	


?>
<div>
<head>
	<title>Update Details</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
	<div class="limiter">
<br>
				<form method="post" action="dashboard.php">
					<span class="login100-form-title">
						Update Details
					</span>
          <img class="center" style="width:200px;height:200px;" src="data:image/jpeg;base64,<?php if(isset($image)) echo base64_encode($image); 
				                     else  echo base64_encode(file_get_contents('images/bat.jpg'));?>" name="uglyphotos" alt="..."/>
                             <br>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="username" value=<?php echo $_SESSION['user'];?> readonly>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid Phone number required">
						<input class="input100" type="text" name="phonenumber" value=<?php echo $phonenumber; ?> placeholder="Phone Number" pattern="[1-9]{1}[0-9]{9}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
			
					<div class="wrap-input100 validate-input" data-validate = "Enter the email">
						<input class="input100" type="text" name="email" value=<?php echo $email ?> placeholder="Email"> 
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="name" placeholder="Name" value=<?php echo $name;?>  >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" name="age" value=<?php echo $age;?> maxlength="3" min="15" max="115" placeholder="Age" data-validate = "Enter Age between 15 and 115">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-building-o" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" name="submit" type="submit">
						</input>
					</div>
          <br>
				</form>
		</div>
    </div>
	</div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="js/main.js"></script>
</body>
</div>
	
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer >
      <div class="container">
        <div class="text-center">
          <small>Copyright © ClusterChat 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Do you really want to leave?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/sb-admin.min.js"></script>
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
  <style>
  .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    font-size: 13px;
    border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 140px;
    box-shadow: 0px 8px 10px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 50%;
    width: 50%;
}
  </style>
</body>

</html>
