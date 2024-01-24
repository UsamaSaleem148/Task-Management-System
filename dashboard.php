
<?php
session_start();
	include'include/init.php';
	include'include/head.php';
	include'include/navHead.php';

?>

<div class="container-fluid"  id="gradient-dashboard">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
			<div class="col-md-4 card-size">
					<div class="card text-white bg-info" style="max-width: 20rem; border: none;">
  					<div class="card-header heading">Administration</div>

					<div class="card-body" style=" color: #FFFFFF; text-align: center; border:none;">
						<img src="images/admin.png" class="img-fluid">


						<a id="admin" class="btn btn-secondary buttons" href="adminLogin.php">Sign In</a>
						
					</div>
				
			</div>
		</div>

			<div class="col-md-4 card-size">
				<div class="card text-white bg-success" style="max-width: 20rem; border: none;">
  					<div class="card-header heading">Manager</div>
					<div class="card-body" style=" color: #FFFFFF; text-align: center; border:none;">
						<img src="images/manager.png" class="img-fluid">
						<a id="manager" class="btn btn-secondary buttons" href="managerLogin.php">Sign In</a>
						
					</div>
				</div>
			</div>

			<div class="col-md-4 card-size">
				<div class="card text-white bg-warning" style="max-width: 20rem; border: none;">
  					<div class="card-header heading">Developer</div>
					<div class="card-body" style="color: #FFFFFF; text-align: center; border:none;">
						<img src="images/user.png" class="img-fluid">
						<a id="developer" class="btn btn-secondary buttons" href="developerLogin.php">Sign In</a>
					</div>
				</div>
			</div>

			</div>
</div>
<div class="col-md-1"></div>
</div>
</div>
<?php


   include"include/footer.php";
?>
