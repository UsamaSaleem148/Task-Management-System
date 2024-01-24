<?php
session_start();
	include'include/developerSidebar.php';
	$devel = $_SESSION['loginsession'];
	$squery1 = "SELECT * FROM employee WHERE email = '$devel'";
			$result1 = mysqli_query($conn, $squery1);
			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2['emp_id'];
			}
?>
<div class="container">
	<label style="font-size: 2em; margin-top: 2%; margin-bottom: 2%;">All Your Projects</label>
	<br>
	<label for="myInput">Search Here</label>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
	<br>
	<?php
	$info = "SELECT * FROM project WHERE emp_id ='$mid' AND completed = '0'";
	$squery = $conn->query($info);
	echo "<table class='table table-bordered table-hover'>";
		echo "<thead class=thead-dark>";
			echo "<tr>";
				echo "<th>"; echo "Title"; echo "</th>";
				echo "<th>"; echo "Priority"; echo "</th>";
				echo "<th>"; echo "Due Date"; echo "</th>";
				echo "<th>"; echo "Attached Files"; echo "</th>";
			echo "</tr>";
		echo "</thead>";
		while ($row = mysqli_fetch_array($squery)) {
		echo "<tbody id=myTable>";
			echo "<tr>";
				echo "<td>"; echo $row["title"]; echo "</td>";
				echo "<td>"; echo $row["priority"]; echo "</td>";
				echo "<td>"; echo $row["endDate"]; echo "</td>";
				$sqli = "SELECT * from project WHERE id = '$row[id]'";
				
				$resultSelect = mysqli_query($conn, $sqli);
				
				while($rowS = mysqli_fetch_array($resultSelect)){
				$path = $rowS[11];
				}
								if ($path == null) {
									echo "<td class=table-danger>";    echo "<br>No Attached Files"; echo "</td>";
								}
								else{
									echo "<td>";    echo "<br><a href='download.php?dow=$path'>Download Attached Files</a>"; echo "</td>";
								}
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