<?php

	session_start();
	include'include/adminSidebar.php';

	$admin = $_SESSION['adminLogin'];

			$squery2 = "SELECT * FROM manager";
			$result2 = mysqli_query($conn, $squery2);

			
?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>

		<div class="col-md-6">

		<div class="card text-white bg-dark cardAddTask" style=" border: none;">
			<div class="card-header header-heading">
				Add a Project
			</div>
			<div class="card-body">
				
					<form method="post" enctype="multipart/form-data">




						


						<label for="managerSelect">Select Manager Name</label>
				<div class="form-group">
					
					<select name="managerSelect" id="managerSelect">
						
						<?php while ($row3 = mysqli_fetch_array($result2)):;?>
									<option value="<?php echo $row3[1]; ?>"><?php echo $row3[1]; ?></option>
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
							
							<select name="priority" id="priority" >
								<option>High</option>
								<option>Moderate</option>
								<option>Low</option>
								
							</select>
						</div>


						<div class="form-group dates">
							<label for="startdate">Enter Start Date</label>
							<input type="date" class="form-control" id="startdate" name="startdate">
						</div>

						<div class="form-group dates">
							<label for="enddate">Enter End Date</label>
							<input type="date" class="form-control" id="enddate" name="enddate">
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



if(isset($_POST['submit'])){
	$selected_val = $_POST['managerSelect'];
	$selected_priority = $_POST['priority'];

	if ($selected_val != null && $_POST['task'] != null && $_POST['details'] != null && $selected_priority != null && $_POST['startdate'] != null && $_POST['enddate'] != null) {
		if ($_POST['startdate'] < $_POST['enddate']) {

	$sql = "SELECT m_id FROM manager WHERE fullName='$selected_val'";
		if($res = mysqli_query($conn, $sql)){
			if(mysqli_num_rows($res) > 0){
				while($row = mysqli_fetch_array($res)){
					$goo = $row['m_id'];
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


$query = "INSERT INTO project (id, emp_id, title, description, priority, startDate, endDate, completed, m_id,modified,file) VALUES ('','','$_POST[task]', '$_POST[details]','$selected_priority','$_POST[startdate]','$_POST[enddate]','0','$goo',CURDATE(),'$pname')";
$squery = $conn->query($query);
if ($squery) {
?>
	<script>
		alert("Task Added");
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

	
	tail.select('#managerSelect',{
		search: true
	});


	tail.select('#priority',{
		search: true
	});


	
	$(document).ready(function(){
		$('#managerSelect').editableSelect();
	});



	$(function(){
		$('.dates #startdate').datepicker({
			'format':'yyyy-mm-dd',
			'autoclose': true
		});
	});



	$(function(){
		$('.dates #enddate').datepicker({
			'format':'yyyy-mm-dd',
			'autoclose': true
		});
	});

if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

</script>



