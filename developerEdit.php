<?php
session_start();
	include'include/developerSidebar.php';
	$devel = $_SESSION['loginsession'];
	$id = $_GET['id'];
	$squery1 = "SELECT * FROM employee WHERE email = '$devel'";
			$result1 = mysqli_query($conn, $squery1);
			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2[0];
			}
			$squery = "SELECT * FROM project WHERE id = '$id'";
			$result = mysqli_query($conn, $squery);
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" >
			<div class="card border-secondary cardAddTask">
				<div class="card-heading header-heading">
					Edit Project
				</div>
				<div class="card-body text-secondary ">
					
					<form method="post">
						<div class="form-group">
							<label for="tasktitle">Project Name</label>
						<?php while ($row = mysqli_fetch_array($result)):;?>
							<input type="text" class="form-control" id="tasktitle" name="tasktitle" readonly="readonly" value=<?php echo $row['title'];?>>
						<?php endwhile; ?>

						</div>
						<div class="form-group">
							<label for="percentage">Enter how much you have done the work</label>
							<input class="form-control" type="text" id="percentage" placeholder="Enter %" name="percentage" onkeyup="onlyLetters(this)" maxlength="3">
						</div>
						<div class="form-group">
							<label for="messagess">Send a message to Manager</label><i>&nbsp;&nbsp;&nbsp;*Optional</i>
							<textarea class="form-control" rows="5" id="messagess" placeholder="Enter Message" name="messagess"></textarea>
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
	
	if ($_POST['percentage'] != null){
	
	$project = "SELECT * FROM project where title ='$_POST[tasktitle]'";
			$rres = mysqli_query($conn, $project);
			
			while ($row7 = mysqli_fetch_array($rres)){
				$titl = $row7[0];
				$prev = $row7[7];
				$managerId = $row7[8];
			}
			$mName = "SELECT * FROM manager where m_id ='$managerId'";
			$mNameQ = mysqli_query($conn, $mName);
			
			while ($mrow = mysqli_fetch_array($mNameQ)){
				
				$managerName = $mrow[5];
			}
			if ($_POST['percentage'] > 100 || $_POST['percentage'] < $prev || $_POST['percentage'] < 0) {

				echo '<script language="javascript">';
echo 'alert("Percentage cannot be greater than 100% or smaller than the previous percentage.")';
echo '</script>';				
			}
			else {
				$sql = "UPDATE project SET completed='$_POST[percentage]', modified=CURDATE() WHERE id='$titl'";
				if ($conn->query($sql) === TRUE) {
				if ($_POST['messagess'] != null ) {
				$sqli = "INSERT INTO managermessage(message_id, m_to, m_from, message, sentDate, status) VALUES ('','$managerName','$devel','$_POST[messagess]',CURDATE(),'No')";
				if (!$conn->query($sqli) === TRUE) {
				echo "Error updating record: " . $conn->error;
				}
				
			}
echo '<script language="javascript">';
echo 'alert("Updated Successfully")';
echo '</script>';
}
else {
echo "Error updating record: " . $conn->error;
}
}
}
else
{
echo '<script language="javascript">';
echo 'alert("Fields cannot be empty")';
echo '</script>';
}
}
include"include/footer.php";
?>
<script>

	function onlyLetters(input){
		var regex = /[^0-9]/gi;
		input.value = input.value.replace(regex, "");
	}

	tail.select('#tasktitle',{
		search: true
	});

if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>