<?php
//logout.php
session_start();
session_destroy();
unset($_SESSION);
setcookie("hash", "", time() - 3600);
header("location: index.php");
?>

