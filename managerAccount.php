<?php
	session_start();
	include'include/managerSidebar.php';

	$query = "SELECT * from manager where email = '$manager'";
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result)){
	$managerAccId = $row['m_id'];
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" >
		<div class="card border-secondary cardAddTask">
			<div class="card-heading header-heading">
				Update Your Account
			</div>
			<div class="card-body text-secondary ">
				
					<form method="post" onsubmit="return passwordCheck()">
						<div class="form-group">
							<label for="name">Enter Full Name</label>

							<?php echo "<input type='text' class='form-control' id='name' name='name' value='". $row['fullName'] ."' onkeyup='onlyLetters(this)' maxlength='50'>"; ?>
						</div>
						<div class="form-group">
							<label for="contact">Enter Contact</label>
							<input type="text" class="form-control" id="contact" name="contact" maxlength="11" value=<?php echo $row['contact'];?>>
						</div>
						<div class="form-group">
							<label for="address">Enter Address</label>
							<textarea  class="form-control" rows="5" id="address" name="address" ><?php echo trim($row['address']); ?> </textarea>
						</div>
						<div class="form-group">
							<label for="cnic">CNIC</label>
							<input type="text" class="form-control" id="cnic" name="cnic" maxlength="15" value=<?php echo $row['cnic'];?>>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" value=<?php echo $row['email'];?>>
						</div>

						<label for="pwd">Password:</label>
						<div class="form-group form-inline">
							
							<input type="password" class="form-control" id="pwd" name="pwd" style="width: 88%;" value=<?php echo $row['password'];?>>
							<button class="btn btn-primary" id="togglePasswordField" type="button" value="Show password" style="margin-left: 2.4%;"><i class="fas fa-eye"></i></button>
						</div>
						
						<div>
							<input class="btn btn-outline-secondary submit" type="submit" name="submit" value="Register">
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



if (isset($_POST["submit"])) {
$email = $_POST['email'];
$sql_e = "SELECT * FROM manager WHERE email = '$email' AND email !='$manager'";

$res_e  = $conn->query($sql_e);

if(mysqli_num_rows($res_e) > 0){
	echo '<script language="javascript">';
			echo 'alert("Sorry... email already taken")';
			echo '</script>';
  	}

else{

	if ($_POST['name'] != "" && $_POST['contact'] != "" && $_POST['address'] != "" && $_POST['cnic'] != "" && $_POST['email'] != "" && $_POST['pwd'] != "") {



	$sql = "UPDATE manager SET fullName= '$_POST[name]',contact= '$_POST[contact]',address= '$_POST[address]',cnic= '$_POST[cnic]',email= '$_POST[email]',password= '$_POST[pwd]' WHERE m_id = $managerAccId";



$squery = $conn->query($sql);


$messageToQuery = "UPDATE managermessage SET m_to = '$_POST[email]' WHERE m_to = '$manager'";

$mQ = $conn->query($messageToQuery);


$messageFromQuery = "UPDATE managermessage SET m_from = '$_POST[email]' WHERE m_from = '$manager'";

$mFrom = $conn->query($messageFromQuery);

if ($squery && $mQ && $mFrom) {

			echo '<script language="javascript">';
			echo 'alert("Updated Successfully")';
			echo '</script>';
			$user = $_POST['email'];
			$_SESSION['managerLogin'] = $user;

			?>

			<script type="text/javascript">
				window.location="managerDashboard.php";
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
		var pass = document.getElementById("cnic").value;
		if (pass.length < 15) {
			alert("Enter right cnic");
			return false;
		}
	}

	$('#cnic').keydown(function(){

  //allow  backspace, tab, ctrl+A, escape, carriage return
  if (event.keyCode == 8 || event.keyCode == 9 
                    || event.keyCode == 27 || event.keyCode == 13 
                    || (event.keyCode == 65 && event.ctrlKey === true) )
                        return;
  if((event.keyCode < 48 || event.keyCode > 57))
   event.preventDefault();

  var length = $(this).val().length; 
              
  if(length == 5 || length == 13)
   $(this).val($(this).val()+'-');

 });


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