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
  
    
    <br>
    <div class="content-wrapper">
    <div class="container-fluid">
    <form method="post" action="addmoney.php">
					<span class="login100-form-title">
						Add money to your wallet
					</span>
                    <div class="wrap-input100 validate-input">
						<input type="number" min="1" step="any" class="input100" type="text" name="rate" placeholder="Enter amount in Rs.">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-bank" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="container-login100-form-btn">
						<input class="login100-form-btn" name="submit" type="submit">
						</input>
					</div>
        </form>
        </div>
       
<?php
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Errors\SignatureVerificationError;
use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);
if(isset($_POST['submit'])){
$orderData = [
    'receipt'         => 3456,
    'amount'          =>(int) $_POST['rate'] * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
$_SESSION['rate']=$_POST['rate'];
$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];
if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);
    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}
$checkout = 'automatic';
$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $_SESSION['user'],
    "description"       => "Add Money",
    "image"             => "https://www.anchorexpressinc.com/wp-content/uploads/2018/01/payment.png",
    "prefill"           => [
    "name"              => $_SESSION['user'],
    "email"             => "vaidhyesh1@gmail.com",
    "contact"           => "7975104110",
    ],
    "notes"             => [
    "address"           => "Somewhere in the world",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}
$json = json_encode($data);
}
?>

    <?php if(isset($_POST['submit'])){ ?>
      <form action="verify.php" name="myForm" id="myForm" method="POST">
     <br>

    <script type="text/javascript"
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php  echo $data['key']; ?>"
    data-amount="<?php  echo $data['amount'];?>"
    data-currency="INR"
    data-name="<?php  echo $data['name'];?>"
    data-image="<?php  echo $data['image'];?>"
    data-description="<?php  echo $data['description'];?>"
    data-prefill.name="<?php  echo $data['prefill']['name'];?>"
    data-prefill.email="<?php  echo $data['prefill']['email'];?>"
    data-prefill.contact="<?php  echo $data['prefill']['contact'];?>"
    data-notes.shopping_order_id="3456"
    data-order_id="<?php  echo $data['order_id'];?>"
    <?php if ($displayCurrency === 'INR') { ?> data-display_amount="<?php  echo $displayAmount;?>" <?php } ?>
    document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
    }
}
  ></script>
</form>
</div>
</div>
<script>

</script>
    <?php } ?>	
	<?php
if(isset($_SESSION['money'])){
        if($_SESSION['money']==1){
            $mysqli = new MySQLi('localhost', 'root', '', 'chatlogin'); 
            if($mysqli->errno){
                header("location: addmoney.php");
            }
            $stmt = $mysqli->prepare("SELECT money FROM logincred WHERE username = '".$_SESSION['user']."';");
            $stmt->execute();
            $stmt->bind_result($money); 
            $stmt->fetch(); 
            $money=$money+(int)$_SESSION['rate'];
            $stmt->close();
            $mysqli->close();
            $mysqli1 = new MySQLi('localhost', 'root', '', 'chatlogin');
            if($mysqli1->errno){
              header("location: addmoney.php");
          }
            $stmt1 = $mysqli1->prepare("Update logincred set money='".$money."' where username='".$_SESSION['user']."'");
            $stmt1->execute();
            $stmt1->fetch(); 
            echo '<script>alert("Payment Successful!");</script>';
            unset($_SESSION['rate']);
            //close all connections
            unset($_SESSION['money']);
            unset($_SESSION['rate']);
            $stmt1->close();
            $mysqli1->close();
    }
    else{
        echo "<script>alert('Payment Failed!');</script>";
    }
}
?>

<div>
<head>
	<title>Add Money</title>
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
    <footer class="sticky-footer">
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
.razorpay-payment-button{
  background-color: #4CAF50;
  height:30px; 
    width:100px; 
    margin: -20px -50px; 
    position:relative;
    top:50%; 
    left:50%;

}
  </style>
</body>

</html>
