<?php
include "QR_BarCode.php"; 
require_once("checklogin.php");
$user=$_SESSION['user'];
$mysqli = new MySQLi('localhost', 'root', '', 'chatlogin'); 
	if($mysqli->errno){
		//connection wasn't made
		//handle the error here
		header("location: dashboard.php");
	}
	$stmt = $mysqli->prepare("SELECT password FROM logincred WHERE username = '".$user."'");
	$stmt->execute();
	$stmt->bind_result($total); 
	$stmt->fetch(); 
		$md5=$user.','.md5($total);
		//close all connections
	$stmt->close();
	$mysqli->close();


?>
<html>
<head>
	<title>QR connect</title>
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
<div>
<div id="outer">
<h1>Scan this image to login in mobile device<h1>
<div id="inner">
<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $md5 ?>&choe=UTF-8" title="Scan this" /><br>
<div id="inner2">
<h2><a href="dashboard.php">Go back</a></h2>
</div>
</div>
</div>
</div>
</body>
<style>
#outer {
  display: table;
  margin: 0 auto;
}
#inner {
  display: table;
  margin: 0 auto;
}
#inner2 {
   font-size: 500px;
  display: table;
  margin: 0 auto;
}
</style>
</html>