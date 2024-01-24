<?php

	session_start();
	include'include/adminSidebar.php';
	
	$admin = $_SESSION['adminLogin'];

			$squery = "SELECT * FROM managermessage WHERE m_to = '$admin' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$count = mysqli_num_rows($resulty);

	$squery1 = "SELECT * FROM admin WHERE email = '$admin'";
			$result1 = mysqli_query($conn, $squery1);

			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2[0];
			}

?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" >
		<div class="card text-white bg-info cardAddTask" style=" border: none;">
			<div class="card-header header-heading">
				Edit Project
			</div>
			<div class="card-body">
				
					<form method="post">
						



						<div class="form-group">
							<label for="email">Enter Email</label>
							<input class="form-control" type="email" id="email" placeholder="Enter email" name="email">
						</div>


						<div class="form-group">
							<label for="messagess">Enter your message</label>
							<textarea class="form-control" rows="10" id="messagess" placeholder="Enter Message" name="messagess"></textarea>
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


	if ($_POST['email'] != null && $_POST['messagess'] != null ){

				$sqli = "INSERT INTO managermessage(message_id, m_to, m_from, message, status) VALUES ('','$_POST[email]','$admin','$_POST[messagess]','No')";
					$result = mysqli_query($conn, $sqli);

					echo '<script language="javascript">';
					echo 'alert("Sent")';
					echo '</script>';
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
	
	$(document).ready(function(){
		$('#tasktitle').editableSelect();
	});




    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


</script>



