<?php
//checklogin.php
session_start();

//don't want to read a cookie or session variable that doesn't exist
if(isset($_COOKIE['hash'], 
		 $_SESSION['key'], 
		$_SESSION['user']
		)
   ) 
{
	if(strcmp($_SESSION['auth'], 
			  hash_hmac('sha512', $_SESSION['key'], 
					hash_hmac('sha512', $_SESSION['user'] .
						      (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 
					 	            $_SERVER['HTTP_X_FORWARDED_FOR'] : 
					                    $_SERVER['REMOTE_ADDR']), 
						  $_COOKIE['hash'])
					)
			 )
		)
	{
		header("location: index.php");
	}
}
else
{
	header("location: index.php");
}
?>

