<?php
	include'include/init.php';
	include'include/head.php';
	include'include/navHead.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>

		<div class="panel panel-info">

			<div class="panel-heading" id="panelHeading">

				LOGIN FORM

			</div>
			<div class="panel-body">
				<div class="col-md-6 col-md-offset-3" >
					<form method="post">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="remember"> Remember me</label>
						</div>
						<label><a href="registration.php" style="text-decoration:none;">Create account</a></label>
						<div>
						<input class="btn btn-default submit" type="submit" name="submit" value="Login">
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-3"></div>
			</div>
		</div>
	</div>

	<?php

	if (isset($_POST["submit"])) {
		
		$coun=0;

		$login = "SELECT * from librarian where email='$_POST[email]' && password='$_POST[pwd]'";

		$squery = $dbconnect->query($login);

		$count=mysqli_num_rows($squery);

		if ($count==0)
		{
			?>

			<div class="alert alert-danger col-lg-6 col-lg-push-3">
				<strong>Invalid </strong>Username or Password.
			</div>

			<?php
		}

		else
		{

			?>

			<script type="text/javascript">
				window.location="display_student_info.php";
			</script>

			<?php

		}


	}

	include'include/footer.php';


	?>