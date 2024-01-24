<?php


	session_start();
	include'include/managerSidebar.php';

	$manag = $_SESSION['managerLogin'];


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
		<div class="card border-secondary cardAddTask">
			<div class="card-heading header-heading">
				Add a Project
			</div>
			<div class="card-body text-secondary ">
				
					<form method="post" enctype="multipart/form-data">
						
				<label for="employee">Select Developer Name</label>
				<div class="form-group">
					
					<select name="employee" id="employee" placeholder="Search for Developer's name">
						
						<?php while ($row = mysqli_fetch_array($result)):;?>
						<option value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></option>
						<?php endwhile; ?>
						
						
					</select>
				</div>


						<div class="form-group">
							<label for="task">Enter Task Title</label>
							<input type="text" class="form-control" id="task" placeholder="Enter task name" name="task" onkeyup="onlyLetters(this)" maxlength="150">
						</div>

						<div class="form-group">
							<label for="details">Enter Task Details</label>
							<textarea class="form-control" rows="5" id="details" placeholder="Enter Task Details" name="details" onkeyup="onlyLetters(this)" maxlength="1000"></textarea>
						</div>

						<label for="priority">Select Priority</label>
						<div class="form-group">
							
							<select name="priority" id="priority" class="form-control" placeholder="Select Priority">
								<option>High</option>
								<option>Moderate</option>
								<option>Low</option>
								
							</select>
						</div>



						<div class="form-group dates">
							<label for="startdate">Enter Start Date</label>
							<input type="date" class="form-control" id="startdate" placeholder="yyyy-mm-dd" name="startdate">
						</div>

						<div class="form-group dates">
							<label for="enddate">Enter End Date</label>
							<input type="date" class="form-control" id="enddate" placeholder="yyyy-mm-dd" name="enddate">
						</div>

						<div class="form-group">
      					<input type="file" class="form-control-file border" name="file">
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
</div>


<?php
}
if(isset($_POST['submit'])){
	if ($_POST['employee'] != null && $_POST['task'] != null && $_POST['details'] != null && $_POST['priority'] != null && $_POST['startdate'] != null && $_POST['enddate'] != null) {

		if ($_POST['startdate'] < $_POST['enddate']) {

		
	
	$selected_val = $_POST['employee'];
	$selected_priority = $_POST['priority'];

	$sql = "SELECT emp_id FROM employee WHERE fullName='$selected_val'";
		if($res = mysqli_query($conn, $sql)){
			if(mysqli_num_rows($res) > 0){
				while($row = mysqli_fetch_array($res)){
					$goo = $row['emp_id'];
					echo $goo;
				}
			}
		}

		#file name with a random number so that similar dont get replaced
     $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
  
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
    
    #upload directory path
    $uploads_dir = 'images';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);

$query = "INSERT INTO project (id, emp_id, title, description, priority, startDate, endDate, completed, m_id,file,p_unit) VALUES ('','$goo','$_POST[task]', '$_POST[details]','$selected_priority','$_POST[startdate]','$_POST[enddate]','0','$mid','$pname','$unit')";
$squery = $conn->query($query);
if ($squery) {
?>
<script>
		alert("Successfully Added!!");
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
		alert("End date cannot be less than start date.");
	</script>
	<?php
}
}
else{
	?>
	<script>
		alert("Kindly provide all the mentioned fields");
	</script>
	<?php
}

}
include"include/footer.php";
?>
<script>


	function onlyLetters(input){
		var regex = /[^a-z ]+$/gi;
		input.value = input.value.replace(regex, "");
	}
	
	tail.select('#employee',{
		search: true
	});

	tail.select('#priority',{
		search: true
	});




    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }



</script>



