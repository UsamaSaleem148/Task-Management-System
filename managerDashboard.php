<?php

	session_start();
	include'include/managerSidebar.php';

$manag = $_SESSION['managerLogin'];

$selectManager = "SELECT * FROM manager WHERE email ='$manag'";
		if($selectManagerres = mysqli_query($conn, $selectManager)){
			if(mysqli_num_rows($selectManagerres) > 0){
				while($selectManagerresrow = mysqli_fetch_array($selectManagerres)){
					$managerId = $selectManagerresrow['m_id'];
				}
			}
		}



			$squery = "SELECT * FROM managermessage WHERE m_to = '$manag' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$count = mysqli_num_rows($resulty);



			$sql = "SELECT * FROM project WHERE m_id ='$managerId' AND emp_id = '0'";
		if($res = mysqli_query($conn, $sql)){
			
				
					$managerCount = mysqli_num_rows($res);
					if($managerCount>0){
					?>
			<div class="alert alert-danger" id="alertDiv">
				<a href="notAssignedDeveloper.php">
  					<strong>Alert!</strong> You have <strong> <?php echo $managerCount; ?></strong> projects that needs to be assigned to a developer.
  				</a>
			</div>
<?php
				
			}
		}
			
?>
</div></div>