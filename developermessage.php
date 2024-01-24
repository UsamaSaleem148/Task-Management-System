
<?php

	session_start();

	$devel = $_SESSION['loginsession'];
	
	include'include/init.php';
	include'include/head.php';
	include'include/navLogin.php';




$results_per_page = 10;

// find out the number of results stored in database

$sql='SELECT * FROM managermessage';
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

// determine number of total pages available

$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on

if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
// retrieve selected results from database and display them on page
			
?>

<div class="container">
	<h1 style="text-align: center;">All Messages</h1>

	<label for="myInput">Search Here</label>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>


<?php


	$squery1 = "SELECT * FROM employee WHERE email = '$devel'";
			$result1 = mysqli_query($conn, $squery1);

			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2[0];
			}


			$info = "SELECT * FROM managermessage WHERE m_to = '$devel' LIMIT " . $this_page_first_result . ',' .  $results_per_page;
			$squery = $conn->query($info);

echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>"; echo "From"; echo "</th>";
echo "<th>"; echo "Message"; echo "</th>";
echo "<th>"; echo "Reply"; echo "</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($squery)) {
	$empll = $row["m_from"];
				
echo "<tbody id=myTable>";
echo "<tr>";
$info1 = "SELECT * FROM manager WHERE email = '$empll'";
				$squery99 = $conn->query($info1);
				while ($rowemp = mysqli_fetch_array($squery99))
				{
echo "<td width=20%>"; echo $rowemp["fullName"]; echo "</td>";
}
echo "<td width=70%>"; echo $row["message"]; echo "</td>";
echo "<td>"; ?> <a style="text-decoration:none;" href="developerReply.php?message_id=<?php echo $row["message_id"]; ?>">Reply</a> <?php echo "</td>";

echo "</tr>";
echo "</tbody>";
}
echo "</table>";
echo '<div class=text-center>';
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
	
	echo '<ul class=pagination style=margin-right:10px>';
 	echo '<li class=page-item>'; echo '<a href="developermessage.php?page=' . $page . '">' . $page . '</a> '; echo '</li>';
 	echo '</ul>';
}
echo '</div>';


?>

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