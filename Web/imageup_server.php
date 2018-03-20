<?php
require_once("checklogin.php");
$username=$_SESSION['user'];
$mysqli = new MySQLi('localhost', 'root', '', 'chatlogin');
$check=getimagesize($_FILES["photo"]["tmp_name"]);
if($check == false){
echo "File not uploaded properly";
//header("location: imageup.php");
}
else{
$image = addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
$sql2=$mysqli->prepare("UPDATE logincred SET image='{$image}' WHERE username='".$username."'");
$sql2->execute();
$sql2->close();
header("location: dashboard.php");
}
?>