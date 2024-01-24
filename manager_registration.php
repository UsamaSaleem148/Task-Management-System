<?php
	include'include/init.php';
	include'include/head.php';
	include'include/navHead.php';
?>



<div class="container-fluid" id="gradient-manager">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
		<div class="card border-dark cardAddTask">


			<div class="card-body text-secondary ">
				<label id="label-heading">CREATE ACCOUNT</label>
					<form method="post" onsubmit="return passwordCheck()">
						<div class="form-group">
							<label for="name">Enter Full Name</label>
							<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" onkeyup="onlyLetters(this)" maxlength="50">
						</div>
						<div class="form-group">
							<label for="contact">Enter Contact</label>
							<input type="text" class="form-control" id="contact" placeholder="Enter Contact" name="contact" maxlength="11">
						</div>

						<div class="form-group">
							<label for="address">Enter Address</label>
							<textarea class="form-control" rows="3" id="address" placeholder="Enter Address" name="address" maxlength="1000"></textarea>
						</div>
						<div class="form-group">
							<label for="cnic">CNIC</label>
							<input type="text" class="form-control" id="cnic" placeholder="Enter CNIC" name="cnic" maxlength="15">
						</div>
						<div class="form-group">
							<label for="unit">Enter Unit</label>
							<input type="text" class="form-control" id="unit" placeholder="Enter Unit" name="unit" onkeyup="onlyLetters(this)" maxlength="100">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
						</div>
						
						<div id="label-login">
						<button class="btn btn-outline-dark" type="submit" id="submit" name="submit" >Register</button>
						<p id="login-label">Already have an account?<a href="managerLogin.php" style="text-decoration:none;"> Login Here</a></p>
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

   	if ($_POST['name'] != null && $_POST['contact'] != null && $_POST['address'] != null && $_POST['cnic'] != null && $_POST['unit'] != null && $_POST['email'] != null && $_POST['pwd'] != null) {

   		$email = $_POST['email'];

   		$sql_e = "SELECT * FROM manager WHERE email = '$email'";

$res_e  = $conn->query($sql_e);

if(mysqli_num_rows($res_e) > 0){
	echo '<script language="javascript">';
			echo 'alert("Sorry... email already taken")';
			echo '</script>';
  	}

else{
   		

   	$query = "INSERT INTO manager (m_id, fullName, contact, address, cnic, email, password,m_unit) VALUES ('','$_POST[name]','$_POST[contact]','$_POST[address]', '$_POST[cnic]','$_POST[email]','$_POST[pwd]','$_POST[unit]')";
	$squery = $conn->query($query);
	if ($squery) {
		?>
			<script type="text/javascript">
				alert("Successfully Registered");
			</script>

			<?php
	}
	else
	{
	echo("Error description: " . mysqli_error($conn));
	}
}
}
else{
	?>
		<script type="text/javascript">
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
