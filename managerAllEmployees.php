<?php


	session_start();
	include'include/managerSidebar.php';

	$manag = $_SESSION['managerLogin'];
	$squery1 = "SELECT * FROM manager WHERE email = '$manag'";
			$result1 = mysqli_query($conn, $squery1);

			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2[0];
				$unit = $row2['m_unit'];
			}
?>


<div class="container">
	<label style="font-size: 2em; margin-top: 2%; margin-bottom: 2%;">All Your Developers</label>
<br>
	<label for="myInput">Search Here</label>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
	<br>
<?php

$info = "SELECT * from employee WHERE m_id = '$mid' and unit = '$unit'";

$squery = $conn->query($info);
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>"; echo "Developer Name"; echo "</th>";
echo "<th>"; echo "Contact"; echo "</th>";
echo "<th>"; echo "Address"; echo "</th>";
echo "<th>"; echo "CNIC"; echo "</th>";
echo "<th>"; echo "Skills"; echo "</th>";
echo "<th>"; echo "Unit"; echo "</th>";
echo "<th>"; echo "Assign a Project"; echo "</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($squery)) {

echo "<tbody id=myTable>";
echo "<tr>";

echo "<td>"; echo $row["fullName"]; echo "</td>";
echo "<td>"; echo $row["contact"]; echo "</td>";
echo "<td>"; echo $row["address"]; echo "</td>";
echo "<td>"; echo $row["cnic"]; echo "</td>";
echo "<td>"; echo $row["skills"]; echo "</td>";
echo "<td>"; echo $row["unit"]; echo "</td>";
echo "<td>"; ?> <a style="text-decoration:none;" href="managerAssignDeveloper.php?id=<?php echo $row["emp_id"]; ?>"><button class="btn btn-outline-success btn-sm">Assign Project</button></a> <?php echo "</td>";
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