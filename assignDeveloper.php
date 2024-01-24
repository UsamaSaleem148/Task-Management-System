<?php


	session_start();
	include'include/managerSidebar.php';

$manag = $_SESSION['managerLogin'];


$id = $_GET["id"];



						$selectProject = "SELECT * FROM project where id = $id";
						$resulty = mysqli_query($conn, $selectProject);
						$count = mysqli_num_rows($resulty);


						if ($count<=0) {
							header('location:notAssignedDeveloper.php');
						}




						$squery1 = "SELECT * FROM manager WHERE email = '$manag'";
						$result1 = mysqli_query($conn, $squery1);

							while ($row2 = mysqli_fetch_array($result1)){
								$mid = $row2[0];
								$unit = $row2['m_unit'];
							}


			$squery1 = "SELECT * FROM employee WHERE m_id = '$mid' and unit = '$unit'";
			$result = mysqli_query($conn, $squery1);
			$employeeNameQueryCount = mysqli_num_rows($result);
			if ($employeeNameQueryCount <= 0) {
				?>
				<div class="alert-danger" style="margin: 4% 20% 0%; text-align: center; padding: 2%;"><b>No Developer is assigned to you.</b></div>
				<?php
			}
			else{
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
							<b><label for="task">Task Title</label></b>
							<p>

								<?php 

									while ($rowemp = mysqli_fetch_array($resulty))
											{
												echo $rowemp['title'];
											
								?>
									
								</p>
						</div>


						<div class="form-group">
							<b><label for="task">Description</label></b>
							<p>

								<?php 

												echo $rowemp['description'];
											}
								?>
									
								</p>
						</div>

						



						
						<div class="form-group">
					<b><label for="employee">Select Developer Name</label></b>
					<select name="employee" id="employee" placeholder="Search for Developer's name">
						
						<?php while ($row = mysqli_fetch_array($result)):;?>
									<option value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></option>
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
</div>

</div>



<?php
	}
if (isset($_POST['submit'])) {

	$selected_val = $_POST['employee'];
	if($selected_val != null){



	$sql = "SELECT * FROM employee WHERE fullName='$_POST[employee]'";
		$resultSelect = mysqli_query($conn, $sql);

				while($rowS = mysqli_fetch_array($resultSelect)){
					$goo = $rowS['emp_id'];

				}

	$quInsert = $query = "UPDATE project set emp_id = '$goo' where id = $id";
	$runQuery = $conn->query($quInsert);

	if ($runQuery) {
		?>

			<script type="text/javascript">
				alert("Submitted");
				window.location="notAssignedDeveloper.php";
			</script>

			<?php
	}
	else
	{
	echo("Error description: " . mysqli_error($conn));
	}


}
else{
	?>
	<script>
		alert("Fields cannot be null");
		var val = "<?php echo $id ?>";
		window.location="assignDeveloper.php?id="+val;
	</script>
	<?php
}
}
?>



<script>

	tail.select('#employee',{
		search: true
	});



    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


</script>