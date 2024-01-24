<?php
session_start();
	include'include/developerSidebar.php';
	$devel = $_SESSION['loginsession'];
	$selectDevel = "SELECT * FROM employee WHERE email ='$devel'";
		if($selectDevelres = mysqli_query($conn, $selectDevel)){
			if(mysqli_num_rows($selectDevelres) > 0){
				while($selectDevelresrow = mysqli_fetch_array($selectDevelres)){
					$develId = $selectDevelresrow['emp_id'];
				}
			}
		}
			$squery = "SELECT * FROM managermessage WHERE m_to = '$devel' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$count = mysqli_num_rows($resulty);
			$sql = "SELECT * FROM project WHERE emp_id ='$develId' AND completed = '0'";
		if($res = mysqli_query($conn, $sql)){
			
				
					$managerCount = mysqli_num_rows($res);
?>
<div class="alert alert-danger" id="alertDiv">
	<a href="developerNewProjects.php" style="text-decoration: none;">
		<strong>Alert!</strong> You have <strong> <?php echo $managerCount; ?></strong> new Projects.
	</a>
</div>

<?php
				
			
		}
			
?>
</div>
</div>
<?php
include"include/footer.php";
?>