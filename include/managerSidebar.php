<?php

	
	include'include/init.php';
	include'include/head.php';
	include'include/navManager.php';

$manager = $_SESSION['managerLogin'];



			$squery = "SELECT * FROM managermessage WHERE m_to = '$manager' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$count = mysqli_num_rows($resulty);

			
			
?>
<div class="d-flex" id="wrapper">

<div class="bg-light" id="sidebar-wrapper">

      <div class="list-group list-group-flush">
      	<a href="managerAllEmployees.php" class="list-group-item list-group-item-action bg-light">Search Employees</a>
        <a href="addProject.php" class="list-group-item list-group-item-action bg-light">Add Project</a>
        <a href="developerReport.php" class="list-group-item list-group-item-action bg-light">All Projects</a>
        <a href="managerReply.php" class="list-group-item list-group-item-action bg-light">Messages <span class="badge badge-danger">

					<?php
							echo $count;
					?>

				</span>
			</a>

      </div>
    </div>


    <div id="page-content-wrapper">
<div class="row">
	<div class="col-md-12">
    	<div class="card border-0">
  <div class="card-header"><h3><i class="fas fa-desktop"></i> Dashboard</h3></div>

</div>
</div>
</div>