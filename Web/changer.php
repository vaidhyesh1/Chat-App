<?php
require_once("checklogin.php");
$mysqli = new MySQLi('localhost', 'root', '', 'exam_schedule');
$mysqli->set_charset("utf8");
	if($mysqli->errno)
		header("location: index.html"); 
		
	if($_SESSION['person']=='student')
	$stmt = $mysqli->prepare("SELECT COUNT(username) AS total FROM student_login WHERE username = '".$_SESSION['user']."' AND passwor = '".($_POST['password'])."'");
     else if($_SESSION['person']=='faculty')
	$stmt = $mysqli->prepare("SELECT COUNT(username) AS total FROM faculty_login WHERE username = '".$_SESSION['user']."' AND passwor = '".($_POST['password'])."'");
    else{
	$stmt = $mysqli->prepare("SELECT COUNT(username) AS total FROM admin_login WHERE username = '".$_SESSION['user']."' AND passwor = '".($_POST['password'])."'");
	}
	$stmt->execute();
	$stmt->bind_result($total); 
	$stmt->fetch(); 
	 $stmt->close();
	if((int)$total == 1)
	{
		if($_SESSION['person']=='student')
    $mvar = $mysqli->prepare("UPDATE student_login SET passwor =? WHERE username =?");
     else if($_SESSION['person']=='faculty')
		     $mvar = $mysqli->prepare("UPDATE faculty_login SET passwor =? WHERE username =?");
		 else{
			 $mvar = $mysqli->prepare("UPDATE admin_login SET passwor =? WHERE username =?");
		 }
	$mvar->bind_param('ss',$new,$user);
	$new=($_POST['new']);
	$user=$_SESSION['user'];
	$mvar->execute();
		
		 $mvar->close();
	$mysqli->close();
	$_SESSION['passchange']='Password successfully changed';
	header("location: dashboard.php");
	}
	else{
		$_SESSION['passchange']='Wrong Password Entered';
		header("location: dashboard.php");
	}
	?>