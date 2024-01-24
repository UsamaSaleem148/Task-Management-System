<?php

session_start();
error_reporting(0);
ini_set('display_errors', 0);

	if ($_SESSION['loginsession'] == null) {

	session_start();
	include'include/init.php';
	include'include/head.php';
	include'include/navHead.php';



?>
<div class="container-fluid" id="loginContainerDeveloper">
	<div class="row">
		<div class="col-md-3"></div>
		
		<div class="col-md-4 offset-md-1" >
		<div class="card" id="gradient-card">

			<div class="card-body"  style="padding-bottom: 5.2% ;">
				<img src="images/developer-icon.png">
				<label id="label-login-manager">Developer Login</label>
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
						<p style=" font-size: 2.2vh;">Don't have an account?<a href="employee_registration.php" style="text-decoration:none;"> SignUp Here</a></p>
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
		header("location: developerDashboard.php");
	}


include'include/footer.php';
if (isset($_POST["submit"])) {
	$user = $_POST['email'];
	$pwd = $_POST['password'];

	$query = "SELECT * FROM employee WHERE email = '$user' && password = '$pwd'";
	$data = mysqli_query($conn, $query);
	$total = mysqli_num_rows($data);
	if ($total == 1) {
		$_SESSION['loginsession'] = $user;
		header("location:developerDashboard.php");
	}
	else
	{
		?>

			<script>
				alert("Wrong Credentials");
			</script>

			<?php
	}
}
		


	?>


	<script>
		
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

	</script>