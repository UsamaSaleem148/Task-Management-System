<?php

	session_start();
	include'include/adminSidebar.php';

	$admin = $_SESSION['adminLogin'];
	$id = $_GET["id"];

			$squery2 = "SELECT * FROM project WHERE id = '$id'";
			$result2 = mysqli_query($conn, $squery2);
			while ($row3 = mysqli_fetch_array($result2)):;
			
?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>

		<div class="col-md-6">

		<div class="card text-white bg-dark cardAddTask" style=" border: none;">
			<div class="card-header header-heading">
				Edit Project
			</div>
			<div class="card-body">
				
					<form method="post" enctype="multipart/form-data">




						<div class="form-group">
							<label for="task">Enter Task Title</label>
							<?php echo "<input type='text' class='form-control' id='task' name='task' value='". $row3['title'] ."' onkeyup='onlyLetters(this)' maxlength='150'>"; ?>
						</div>

						<div class="form-group">
							<label for="details">Enter Task Details</label>
							<textarea  class="form-control" rows="5" id="details" name="details" onkeyup="onlyLetters(this)" maxlength="1000" ><?php echo trim($row3['description']); ?> </textarea>
						</div>

						
						<div class="form-group">
							<label for="priority">Select Priority</label>
							<?php echo "<input type='text' class='form-control' id='priority' name='priority' value='". $row3['priority'] ."'>"; ?>
						</div>


						<div class="form-group dates">
							<label for="startdate">Enter Start Date</label>
							<?php echo "<input type='date' class='form-control' id='startdate' name='startdate' value='". $row3['startDate'] ."'>"; ?>
						</div>

						<div class="form-group dates">
							<label for="enddate">Enter End Date</label>
							<?php echo "<input type='date' class='form-control' id='enddate' name='enddate' value='". $row3['endDate'] ."'>"; ?>
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
<?php endwhile; ?>
<?php



if(isset($_POST['submit'])){


	if ($_POST['task'] != null && $_POST['details'] != null && $_POST['priority'] != null && $_POST['startdate'] != null && $_POST['enddate'] != null) {
		if ($_POST['startdate'] < $_POST['enddate']) {

		

$query = "UPDATE project set title = '$_POST[task]', description = '$_POST[details]', priority = '$_POST[priority]', startDate = '$_POST[startdate]', endDate = '$_POST[enddate]' WHERE id = '$id'";
$squery = $conn->query($query);
if ($squery) {
?>
	<script>
		alert("Task Added");
		var val = "<?php echo $id ?>";
		window.location="adminEditProject.php?id="+val;
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
	
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


</script>



