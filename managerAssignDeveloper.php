<?php

	session_start();
	include'include/managerSidebar.php';

$manag = $_SESSION['managerLogin'];

$id = $_GET['id'];

$selectEmployee = "SELECT * FROM employee WHERE emp_id ='$id'";
		if($selectEmployeeQuery = mysqli_query($conn, $selectEmployee)){
			if(mysqli_num_rows($selectEmployeeQuery) > 0){
				while($selectEmployeeRow = mysqli_fetch_array($selectEmployeeQuery)){
					$empName = $selectEmployeeRow['fullName'];
				}
			}
		}

$selectManager = "SELECT * FROM manager WHERE email ='$manag'";
		if($selectManagerres = mysqli_query($conn, $selectManager)){
			if(mysqli_num_rows($selectManagerres) > 0){
				while($selectManagerresrow = mysqli_fetch_array($selectManagerres)){
					$managerId = $selectManagerresrow['m_id'];
				}
			}
		}

		$sql = "SELECT * FROM project WHERE m_id ='$managerId' AND emp_id = '0'";
		$res = mysqli_query($conn, $sql)
			
?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" >
		<div class="card border-dark cardAddTask">
			<div class="card-header header-heading">
				Assign a Developer
			</div>
			<div class="card-body text-dark">
				
					<form method="post">

						<div class="form-group">
					<b>
						<label for="developerName">Developer Name</label></b>
						<input type="text" class="form-control" id="developerName" name="developerName" readonly="readonly" value=<?php echo $empName;?>>
				</div>

					<div class="form-group">
					<b><label for="taskTitle">Select Task Name</label></b>
					<select name="taskTitle" id="taskTitle" placeholder="Search for Task name">
						
						<?php while ($row = mysqli_fetch_array($res)):;?>
									<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
								<?php endwhile; ?>
						
						
					</select>
				</div>


						<div>
							<input class="btn btn-outline-dark submit" type="submit" name="submit" value="Submit" style="float: right; width: 30%;">
						</div>
					</form>
				</div>
			</div>
		</div>
			<div class="col-md-3"></div>
		</div>
	</div>

</div></div>

<?php

   if (isset($_POST["submit"])) {
   		
$selected_val = $_POST['taskTitle'];

   	$query = "UPDATE project set emp_id = '$id' WHERE id = '$selected_val'";
	$squery = $conn->query($query);
	if ($squery) {
		?>

			<script>
				alert("Added");
			</script>

			<?php
	}
	else
	{
	?>

			<script>
				alert("Failed");
			</script>

			<?php
	}

}

   include"include/footer.php";




?>


<script>

	tail.select('#taskTitle',{
		search: true
	});



    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


</script>