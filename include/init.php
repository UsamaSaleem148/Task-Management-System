<?php
$server = "127.0.0.1:3307";
$user = "root";
$dbname = "tms";
$pass = "";
$conn = mysqli_connect($server, $user, $pass, $dbname);
if(mysqli_connect_errno()){
	echo 'Not Connected : ' .mysqli_connect_error();
	die();
}

?>