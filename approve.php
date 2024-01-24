<?php


	session_start();

	$_SESSION['managerLogin'];
	
	include'include/init.php';
	include'include/head.php';
	include'include/navManager.php';

$manag = $_SESSION['managerLogin'];


$id = $_GET["message_id"];



						$checkinfo = "SELECT * FROM managermessage where message_id = $id";
						$resulty = mysqli_query($conn, $checkinfo);
						$count = mysqli_num_rows($resulty);


						if ($count<=0) {
							header('location:managermessage.php');
						}

$query = "UPDATE managermessage set status='Yes' where message_id=$id";
$squery = $conn->query($query);

						
?>



<div class="container" id="rep">
	<label id="das">Reply</label>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="panel panel-info">
			<div class="panel-heading" id="panelHeading">
				Add a Reply
			</div>
			<div class="panel-body">
				<div class="col-md-6 col-md-offset-3" >
					<form method="post">


						<div class="form-group">
							<label for="task">Message</label>
							<p>

								<?php 

									$info = "SELECT * FROM managermessage where message_id = $id";
									$squery1 = $conn->query($info);

									while ($rowemp = mysqli_fetch_array($squery1))
											{

												$employee = $rowemp['m_from'];
												echo $rowemp['message'];
											}
								?>
									
								</p>
						</div>

						<div class="form-group">
							<label for="reply">Enter a Reply</label>
							<textarea class="form-control" rows="5" id="reply" placeholder="Reply.." name="reply"></textarea>
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
	
if (isset($_POST['submit'])) {
	if ($_POST['reply']!=null) {
	$quInsert = "INSERT INTO managermessage(message_id, m_to, m_from, message, status) VALUES ('','$employee','$manag','$_POST[reply]','No')";
	$runQuery = $conn->query($quInsert);

	if ($runQuery) {
		?>

			<script type="text/javascript">
				alert("Sent");
				window.location="managermessage.php";
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
		alert("Empty message");
	</script>

	<?php
}
}

?>



<script>
	

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


</script>