<?php

session_start();
	include'include/init.php';
	include'include/head.php';
	include'include/navManager.php';

	$manag = $_SESSION['managerLogin'];


	$squery1 = "SELECT * FROM manager WHERE email = '$manag'";
			$result1 = mysqli_query($conn, $squery1);

			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2[0];
			}


			$squery = "SELECT * FROM project WHERE m_id = '$mid'";
			$result = mysqli_query($conn, $squery);
?>
<div class="container" id="mydiv">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="panel panel-info">
			<div class="panel-heading" id="panelHeading">
				Submit Message
			</div>
			<div class="panel-body">
				<div class="col-md-6 col-md-offset-3" >
					<form method="post">
						<div class="form-group">
							<label for="tasktitle">Select Project Name</label>
							<select name="tasktitle" id="tasktitle" class="form-control" placeholder="Search for Project">
								<?php while ($row = mysqli_fetch_array($result)):;?>
									<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
								<?php endwhile; ?>
								
							</select>
						</div>



						<div class="form-group">
							<label for="remarks">Enter Remarks</label>
							<textarea class="form-control" rows="5" id="remarks" placeholder="Enter Remarks" name="remarks"></textarea>
						</div>



						<div>
							<input class="btn btn-primary submit" type="submit" name="submit" value="Submit" style="float: right;">
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>


<?php

if(isset($_POST['submit'])){

$selected_val = $_POST['tasktitle'];

	if ($_POST['remarks'] != 'NULL' && $selected_val != null) {
		
	


			$project = "SELECT * FROM project where title ='$selected_val'";
			$rres = mysqli_query($conn, $project);
			
			while ($row7 = mysqli_fetch_array($rres)){
				$titl = $row7['emp_id'];
			}


			$mName = "SELECT * FROM employee where emp_id ='$titl'";
			$mNameQ = mysqli_query($conn, $mName);
			
			while ($mrow = mysqli_fetch_array($mNameQ)){
				
				$employeename = $mrow[6];
			}





$quInsert = "INSERT INTO managermessage(message_id, m_to, m_from, message, status) VALUES ('','$employeename','$manag','$_POST[remarks]','No')";
	$runQuery = $conn->query($quInsert);

	if ($runQuery) {
		?>

			<script type="text/javascript">
				alert("Sent");
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
				alert("Message cannot be empty.");
			</script>

			<?php
}
}

include"include/footer.php";
?>
<script>
	
	$(document).ready(function(){
		$('#tasktitle').editableSelect();
	});




    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


</script>



