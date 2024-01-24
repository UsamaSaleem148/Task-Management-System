<?php

	session_start();
	include'include/adminSidebar.php';
	$admin = $_SESSION['adminLogin'];
	$query = "SELECT * from admin where email = '$admin'";
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
	$adminI = $row['admin_id'];

	$squery = "SELECT * FROM managermessage WHERE m_to = '$admin' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$count = mysqli_num_rows($resulty);
?>



<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
		<div class="card bg-secondary cardAddTask" style=" border: none; color: white;">
			<div class="card-header header-heading">
				Update Your Account
			</div>
			<div class="card-body">
				
					<form method="post" onsubmit="return passwordCheck()">
						<div class="form-group">
							<label for="name">Enter Full Name</label>

							<?php echo "<input type='text' class='form-control' id='name' name='name' value='". $row['fullName'] ."' onkeyup='onlyLetters(this)' maxlength='50'>"; ?>
						</div>
						<div class="form-group">
							<label for="contact">Enter Contact</label>
							<input type="text" maxlength="11" class="form-control" id="contact" name="contact" value=<?php echo $row['contact'];?>>
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" value=<?php echo $row['email'];?>>
						</div>

						<div class="form-group form-inline">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" name="pwd" style="width: 88%;" value=<?php echo $row['password'];?>>
							<button class="btn btn-danger" id="togglePasswordField" type="button" value="Show password" style="margin-left: 2.4%;"><i class="fas fa-eye"></i></button>
						</div>

						<div>
							<input class="btn btn-info submit" type="submit" name="submit" value="Submit" style="float: right; margin-top: 4%;">
						</div>
					</form>
				</div>
			</div>
		</div>
			<div class="col-md-3"></div>
		</div>
	</div>
<?php



if (isset($_POST["submit"])) {
$email = $_POST['email'];
$sql_e = "SELECT * FROM admin WHERE email = '$email' AND email !='$admin'";

$res_e  = $conn->query($sql_e);

if(mysqli_num_rows($res_e) > 0){
	echo '<script language="javascript">';
			echo 'alert("Sorry... email already taken")';
			echo '</script>';
  	}

else{

	if ($_POST['name'] != "" && $_POST['contact'] != "" && $_POST['email'] != "" && $_POST['pwd'] != "") {



	$sql = "UPDATE admin SET fullName= '$_POST[name]',contact= '$_POST[contact]',email= '$_POST[email]',password= '$_POST[pwd]' WHERE admin_id = $adminI";



$squery = $conn->query($sql);


$messageToQuery = "UPDATE managermessage SET m_to = '$_POST[email]' WHERE m_to = '$admin'";

$mQ = $conn->query($messageToQuery);


$messageFromQuery = "UPDATE managermessage SET m_from = '$_POST[email]' WHERE m_from = '$admin'";

$mFrom = $conn->query($messageFromQuery);

if ($squery && $mQ && $mFrom) {

			echo '<script language="javascript">';
			echo 'alert("Updated Successfully")';
			echo '</script>';
			$user = $_POST['email'];
			$_SESSION['adminLogin'] = $user;

			?>

			<script type="text/javascript">
				window.location="adminDashboard.php";
			</script>

			<?php

}
else
{
echo("Error description: " . mysqli_error($conn));
}
$conn->close();
}
else{
	echo '<script language="javascript">';
			echo 'alert("Fields cannot be empty")';
			echo '</script>';
}
}
}
}
include"include/footer.php";
?>













<script type="text/javascript">



function onlyLetters(input){
		var regex = /[^a-z ]+$/gi;
		input.value = input.value.replace(regex, "");
	}

	
	(function() {

	try {

		// switch the password field to text, then back to password to see if it supports
		// changing the field type (IE9+, and all other browsers do). then switch it back.
		var passwordField = document.getElementById('pwd');
		passwordField.type = 'text';
		passwordField.type = 'password';
		
		// if it does support changing the field type then add the event handler and make
		// the button visible. if the browser doesn't support it, then this is bypassed
		// and code execution continues in the catch() section below
		var togglePasswordField = document.getElementById('togglePasswordField');
		togglePasswordField.addEventListener('click', togglePasswordFieldClicked, false);
		togglePasswordField.style.display = 'inline';
		
	}
	catch(err) {

	}

})();

function togglePasswordFieldClicked() {

	var passwordField = document.getElementById('pwd');
	var value = passwordField.value;

	if(passwordField.type == 'password') {
		passwordField.type = 'text';
	}
	else {
		passwordField.type = 'password';
	}
	
	passwordField.value = value;

}


function passwordCheck(){
		var pass = document.getElementById("pwd").value;
		if (pass.length < 8) {
			alert("Password must be atleast 8 letters");
			return false;
		}
		var pass = document.getElementById("contact").value;
		if (pass.length < 11) {
			alert("Enter right phone number");
			return false;
		}
	}

	$('#contact').keydown(function(){

  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
  if((event.keyCode < 48 || event.keyCode > 57))
   event.preventDefault();

 });
	
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>