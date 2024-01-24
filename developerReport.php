<?php


	session_start();
	include'include/managerSidebar.php';

	$manag = $_SESSION['managerLogin'];
	$squery1 = "SELECT * FROM manager WHERE email = '$manag'";
			$result1 = mysqli_query($conn, $squery1);

			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2[0];
			}
?>


<div class="container">
	<label style="font-size: 2em; margin-top: 2%; margin-bottom: 2%;">All Your Projects</label>
<br>
	<label for="myInput">Search Here</label>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
	<br>
<?php

$info = "SELECT * from project WHERE m_id = '$mid' and emp_id != 0";

$squery = $conn->query($info);
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>"; echo "Developer"; echo "</th>";
echo "<th>"; echo "Title"; echo "</th>";
echo "<th>"; echo "Priority"; echo "</th>";
echo "<th>"; echo "Due Date"; echo "</th>";
echo "<th>"; echo "Percentage Completed"; echo "</th>";
echo "<th>"; echo "Attached Files"; echo "</th>";
echo "<th>"; echo "Last Modified On"; echo "</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($squery)) {

echo "<tbody id=myTable>";
echo "<tr>";


$qq = $row['emp_id'];


$queryw = "SELECT * FROM employee WHERE emp_id = $qq";

$squery1 = $conn->query($queryw);

while ($row1 = mysqli_fetch_array($squery1)) {


echo "<td>"; echo $row1["fullName"]; echo "</td>";




}


echo "<td>"; echo $row["title"]; echo "</td>";
echo "<td>"; echo $row["priority"]; echo "</td>";
echo "<td>"; echo $row["endDate"]; echo "</td>";
echo "<td>"; echo $row["completed"];
 ?>

<div class="progress">
    <div class="progress-bar" style="width:<?php echo $row["completed"]; ?>%">
    </div>
  </div>

  <?php

echo "</td>";
$sqli = "SELECT * from project WHERE id = '$row[id]'";
  
    $resultSelect = mysqli_query($conn, $sqli);
  
    while($rowS = mysqli_fetch_array($resultSelect)){
                    $path = $rowS[11];
                }
 echo "<td>";    echo "<br><a href='download.php?dow=$path'>Download Attached Files</a>"; echo "</td>";
echo "<td>"; echo $row["modified"]; echo "</td>";
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