<?php


		session_start();
	include'include/adminSidebar.php';

$admin = $_SESSION['adminLogin'];


			$squery = "SELECT * FROM managermessage WHERE m_to = '$admin' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$countMessage = mysqli_num_rows($resulty);

					$id = $_GET["id"];



						$selectDeveloper = "SELECT * FROM employee where emp_id = $id";
						$resulty = mysqli_query($conn, $selectDeveloper);
						$count = mysqli_num_rows($resulty);

						while ($rowunit = mysqli_fetch_array($resulty)){
							$unit = $rowunit['unit'];
						}


						if ($count<=0) {
							header('location:adminAssignDeveloper.php');
						}




						$squery1 = "SELECT * FROM manager WHERE m_unit = '$unit'";
						$result1 = mysqli_query($conn, $squery1);


?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" >
		<div class="card text-white bg-dark cardAddTask" style=" border: none;">
			<div class="card-header header-heading">
				Assign a Manager
			</div>
			<div class="card-body">
				
					<form method="post">


						<label for="manager">Select Manager Name</label>
						<div class="form-group">
							
							<select id="manager" name="manager">
								
									<?php while ($row = mysqli_fetch_array($result1)):;?>
									<option value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></option>
									<?php endwhile; ?>
								
								
							</select>
						</div>


						<div class="form-group">
						<b>	<label for="task">Developer Name</label></b>
							<p>

								<?php 
									$resultSelect = mysqli_query($conn, $selectDeveloper);
									while ($rowemp = mysqli_fetch_array($resultSelect))
											{
												echo $rowemp['fullName'];
											
								?>
									
								</p>
						</div>


						<div class="form-group">
						<b>	<label for="task">Unit</label></b>
							<p>

								<?php 

												echo $rowemp['unit'];
											}
								?>
									
								</p>
						</div>

						



						<div>
							<input class="btn btn-primary submit" type="submit" name="submit" value="Submit" style="float: right;">
						</div>
					</form>
				</div>
			</div>


		</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>



</div></div>
<?php
	
if (isset($_POST['submit'])) {


	$selected_val = $_POST['manager'];
		if($selected_val != null){

			$sql = "SELECT m_id FROM manager WHERE fullName='$selected_val'";
			$resultSelect = mysqli_query($conn, $sql);

				while($rowS = mysqli_fetch_array($resultSelect)){
					$goo = $rowS[0];
				}
		



	$quInsert = $query = "UPDATE employee set m_id='$goo' where emp_id = $id";
	$runQuery = $conn->query($quInsert);

	if ($runQuery) {
		?>

			<script type="text/javascript">
				alert("Submitted");
				window.location="adminAssignDeveloper.php";
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

			<script type="text/javascript">
				alert("Kindly fill out the field");
			</script>

			<?php
}

}



?>



<script>

	tail.select('#manager',{
		search: true
	});

	$(document).ready(function(){
		$('#manager').editableSelect();
	});
	

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


</script>