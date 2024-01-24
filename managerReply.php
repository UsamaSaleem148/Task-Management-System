<?php
	session_start();
	
	include'include/init.php';
	include'include/head.php';
	include'include/navManager.php';
$manager = $_SESSION['managerLogin'];
						
?>
<div class="d-flex" id="wrapper">
	<div class="bg-light" id="sidebar-wrapper" style="overflow-y: scroll;width: 23.3%; height: 1px;">
		<div class="sidebar-heading"><button type="button" class="btn btn-primary" id="primaryCompose" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Compose</button></div>
		<div class="list-group list-group-flush">
			<?php
					$info = "SELECT DISTINCT m_from FROM managermessage WHERE m_to = '$manager' ORDER BY status ASC";
					$squery = $conn->query($info);
					while ($row = mysqli_fetch_array($squery)) {
						$employeeName = "SELECT * FROM employee WHERE email = '$row[m_from]'";
						$employeeNameQuery = $conn->query($employeeName);
						$employeeNameQueryCount = mysqli_num_rows($employeeNameQuery);
						$AdminName = "SELECT * FROM admin WHERE email = '$row[m_from]'";
						$AdminQuery = $conn->query($AdminName);
						$AdminQueryCount = mysqli_num_rows($AdminQuery);
			?>
			<a class="list-group-item list-group-item-action bg-light" href="managerReply.php?m_from=<?php echo $row["m_from"]; ?>">
				<?php
					
							if($employeeNameQueryCount > 0){
							while ($employeeNameQueryRow = mysqli_fetch_array($employeeNameQuery)) {
					echo $employeeNameQueryRow['fullName'];
					$m_from = $employeeNameQueryRow['email'];
				}
				}
				elseif($AdminQueryCount > 0){
				while ($AdminNameQueryRow = mysqli_fetch_array($AdminQuery)) {
					echo $AdminNameQueryRow['fullName'];
				}
				}
				else{
				echo $row['m_from'];
				}
				}
				?>
			</a>
			
		</div>
	</div>
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12" >
					<?php
					if (!isset($_GET['m_from'])) {
					?>
					<div class="card bg-light cardAdminReply" style=" border: none; display: none;">
						<?php
						}
						?>
						<div class="card bg-light cardAdminReply" style=" border: none;">
							<div class="card-header header-heading">
								<?php
								$headName = "SELECT * FROM admin WHERE email = '$_GET[m_from]'";
								$headNameQuery = $conn->query($headName);
								$headNameQueryCount = mysqli_num_rows($headNameQuery);
								$headEmployeeName = "SELECT * FROM employee WHERE email = '$_GET[m_from]'";
								$headEmployeeNameQuery = $conn->query($headEmployeeName);
								$headEmployeeNameQueryCount = mysqli_num_rows($headEmployeeNameQuery);
								if($headNameQueryCount > 0){
								while ($headNameQueryCount = mysqli_fetch_array($headNameQuery)) {
								echo $headNameQueryCount['fullName'];
								}
								}
								elseif($headEmployeeNameQueryCount > 0){
								while ($headEmployeeNameRow = mysqli_fetch_array($headEmployeeNameQuery)) {
								echo $headEmployeeNameRow['fullName'];
								}
								}
								else{
								echo $_GET['m_from'];
								}
								?>
							</div>
							<div class="card-body cardBody">
								<?php
								$updateMessage = "UPDATE managermessage SET status = 'Yes' WHERE m_from = '$_GET[m_from]' and m_to = '$manager'";
								$updateRun = $conn->query($updateMessage);
								$selectMessage = "SELECT * FROM managermessage";
								$run = $conn->query($selectMessage);
								while ($messageRow = mysqli_fetch_array($run)) {
									
								if ($messageRow['m_from'] == $_GET['m_from'] && $messageRow['m_to'] == $manager) {
								?>
								<div class="row">
									
									<div class="col-md-6">
										<label style="background-color: #075e54; color: white; border-radius: 10%; padding: 2%;">
											<?php
												echo $messageRow['message'];
											
											?>
											
										</label>
									</div>
									<div class="col-md-6"></div>
								</div>
								<?php
								}
								elseif ($messageRow['m_from'] == $manager && $messageRow['m_to'] == $_GET['m_from'])
								{
								?>
								<div class="row">
									<div class="col-md-6"></div>
									<div class="col-md-6">
										<label style="float: right; background-color: #34b7f1; color: white; border-radius: 10%; padding: 2%;">
											<?php
											echo $messageRow['message'];
											?>
										</label>
									</div>
								</div>
								<?php
								}
								}
								?>
								
								
								
								<form method="post">
									<b><label for="reply" style="margin-top: 4%;">Enter a Reply</label></b>
									<div class="form-group">
										<textarea class="form-control" rows="5" id="reply" placeholder="Reply.." name="reply" style="float: left; width: 80%;"></textarea>
										<input class="btn btn-primary submit" type="submit" name="submit" value="Submit" style="float: right; width: 18%; margin-top: 9.3%;">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- The Modal -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Add Message</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<!-- Modal body -->
			<div class="modal-body">
				<form method="post">
					
					<div class="form-group">
						<label for="replyEmail">Enter Email</label>
						<input class="form-control" type="email" id="replyEmail" placeholder="Enter email" name="replyEmail">
					</div>
					<div class="form-group">
						<label for="replyMessage">Enter your message</label>
						<textarea class="form-control" rows="5" id="replyMessage" placeholder="Enter Message" name="replyMessage"></textarea>
					</div>
					<div class="form-group">
						<input class="btn btn-primary submit" type="submit" name="replyBtn" value="Submit" style="float: right; margin-top: 4%;">
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
<?php
	
if (isset($_POST['submit'])) {
	if ($_POST['reply']!=null) {
	$quInsert = "INSERT INTO managermessage(message_id, m_to, m_from, message, sentDate, status) VALUES ('','$_GET[m_from]','$manager','$_POST[reply]',CURDATE(),'No')";
	$runQuery = $conn->query($quInsert);
	if ($runQuery) {
?>
<script type="text/javascript">
var val = "<?php echo $_GET['m_from'] ?>";
window.location="managerReply.php?m_from="+val;
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
if (isset($_POST['replyBtn'])) {
if ($_POST['replyEmail']!=null && $_POST['replyMessage']!=null) {
$quInsert = "INSERT INTO managermessage(message_id, m_to, m_from, message, sentDate, status) VALUES ('','$_POST[replyEmail]','$manager','$_POST[replyMessage]',CURDATE(),'No')";
$runQuery = $conn->query($quInsert);
if ($runQuery) {
?>
<script type="text/javascript">
	alert("Sent");
	window.location="managerReply.php";
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
	alert("Empty fields");
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