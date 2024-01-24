<?php

session_start();
error_reporting(0);
ini_set('display_errors', 0);

	if ($_SESSION['adminLogin'] == null) {

	session_start();


	include'include/init.php';
	include'include/head.php';
	include'include/navHead.php';



?>
<div class="container-fluid" id="loginContainerAdmin">
	<div class="row">
		<div class="col-md-3"></div>
		
		<div class="col-md-4 offset-md-1" >
		<div class="card" id="gradient-card">

			<div class="card-body"  style="padding-bottom: 5.2% ;">
				<img src="images/login.png">
				<label id="label-login-admin">Admin Login</label>
					<form method="post">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
						</div>
						
						<div>
						<input class="btn submit" id="submit" type="submit" name="submit" value="Login" style="float: right;">
						</div>
					</form>
				</div>
			</div>
		</div>
			<div class="col-md-4"></div>
			
		</div>

	</div>



	<?php



}

	else{
		header("location: adminDashboard.php");
	}



if (isset($_POST["submit"])) {
	$user = $_POST['email'];
	$pwd = $_POST['password'];

	$query = "SELECT * FROM admin WHERE email = '$user' && password = '$pwd'";
	$data = mysqli_query($conn, $query);
	$total = mysqli_num_rows($data);
	if ($total == 1) {
		$_SESSION['adminLogin'] = $user;
		header("location:adminDashboard.php");
	}
	else
	{
		?>

			<script>
				alert("Kindly enter right username or password");
			</script>

			<?php
	}
}

 include"include/footer.php";

	?>

		<script>
		
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

	</script>