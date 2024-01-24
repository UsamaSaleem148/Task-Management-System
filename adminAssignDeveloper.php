<?php

	session_start();
	include'include/adminSidebar.php';

	$admin = $_SESSION['adminLogin'];
	$squery1 = "SELECT * FROM manager WHERE email = '$admin'";
			$result1 = mysqli_query($conn, $squery1);
			

			$squery = "SELECT * FROM managermessage WHERE m_to = '$admin' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$count = mysqli_num_rows($resulty);



			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2[0];
			}
?>

<div class="container">
	<label style="font-size: 2em; margin-top: 2%; margin-bottom: 2%;">Assign Manager</label>
<br>
	<label for="myInput">Search Here</label>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
	<br>
<?php

$info = "SELECT * FROM employee WHERE m_id = 0";

$squery = $conn->query($info);
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>"; echo "Name"; echo "</th>";
echo "<th>"; echo "Contact"; echo "</th>";
echo "<th>"; echo "Skills"; echo "</th>";
echo "<th>"; echo "Unit"; echo "</th>";
echo "<th>"; echo "Assign"; echo "</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($squery)) {

echo "<tbody id=myTable>";
echo "<tr>";


echo "<td>"; echo $row["fullName"]; echo "</td>";
echo "<td>"; echo $row["contact"]; echo "</td>";
echo "<td>"; echo $row["skills"]; echo "</td>";
echo "<td>"; echo $row["unit"]; echo "</td>";
echo "<td>"; ?> <a style="text-decoration:none;" href="assignManager.php?id=<?php echo $row["emp_id"]; ?>"><button class="btn btn-info btn-xs view_data">Assign Manager</button></a> <?php echo "</td>";

echo "</tr>";
echo "</tbody>";
}
echo "</table>";


?>

</div>
</div>
</div>


<?php

include'include/footer.php';

?>










<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>




<!-- <script type="text/javascript">
	
	var checker = document.getElementById('checkme');
 var sendbtn = document.getElementById('sendNewSms');
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}

</script> -->