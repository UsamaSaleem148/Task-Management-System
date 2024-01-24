<?php
session_start();
	include'include/init.php';
	if (isset($_POST["employee_id"])) {


		$fetch = "SELECT * FROM project WHERE id = '".$_POST["employee_id"]."'";
		$fetchResult = mysqli_query($connect, $fetch);
		$fetchrow = mysqli_fetch_array($fetchResult);
		echo json_encode($fetchrow);
		
}
			
?>