<?php

	session_start();
	include'include/adminSidebar.php';


$sql = "SELECT * FROM employee WHERE m_id = 0";
			if($res = mysqli_query($conn, $sql)){
			
				
					$managerCount = mysqli_num_rows($res);
					if ($managerCount>0) {
						
					?>
					<div class="alert alert-danger" id="alertDiv">
						<a href="adminAssignDeveloper.php" style="text-decoration: none;">
  <strong>Alert!</strong> <strong> <?php echo $managerCount; ?></strong> employee needs to be assigned to a manager.
</a>
</div>
			
<?php
				}
			
		}
?>


	</div>
	</div>
<?php
include"include/footer.php";
?>

<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>