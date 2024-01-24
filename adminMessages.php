
<?php

	session_start();

	$admin = $_SESSION['adminLogin'];


	
	include'include/init.php';
	include'include/head.php';
	include'include/navAdmin.php';

			$squery = "SELECT * FROM managermessage WHERE m_to = '$admin' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$count = mysqli_num_rows($resulty);


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

<div class="d-flex" id="wrapper">
<div class="bg-light" id="sidebar-wrapper">

      <div class="list-group list-group-flush">
        <a href="adminAddProject.php" class="list-group-item list-group-item-action bg-light">Add Project</a>
        <a href="adminAllProjects.php" class="list-group-item list-group-item-action bg-light">All Projects</a>
        <a href="adminmessage.php" class="list-group-item list-group-item-action bg-light">Messages <span class="badge badge-danger">

					<?php
							echo $count;
					?>

				</span>
			</a>

      </div>
    </div>


    <div id="page-content-wrapper">


<div class="container">
	<h1 style="text-align: center;">All Messages</h1>
	<a href="adminCompose.php"><button type="submit" class="btn btn-primary" style="float: right; margin-bottom: 1%;">Compose a message</button></a>
	<label for="myInput">Search Here</label>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>


<?php


	$squery1 = "SELECT * FROM admin WHERE email = '$admin'";
			$result1 = mysqli_query($conn, $squery1);

			while ($row2 = mysqli_fetch_array($result1)){
				$mid = $row2[0];
			}


			$info = "SELECT * FROM managermessage WHERE m_to = '$admin' ORDER BY status ASC LIMIT " . $this_page_first_result . ',' .  $results_per_page;
			$squery = $conn->query($info);

echo "<table class='table table-condensed'>";
echo "<thead class=thead-dark>";
echo "<tr>";
echo "<th>"; echo "From"; echo "</th>";
echo "<th>"; echo "Message"; echo "</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($squery)) {
	$empll = $row["m_from"];
				
echo "<tbody id=myTable>";
if ($row['status'] == "No") {
	echo "<tr style= background-color:#E5E5E5;>";

echo "<td width=20%;>"; echo "<b>"; echo $row["m_from"]; echo "</b>"; echo "</td>";

echo "<td width=70%;>"; ?> <b> <a style="text-decoration:none;" href="adminReply.php?message_id=<?php echo $row["message_id"]; ?>"> <?php echo $row["message"];  ?></a> </b> <?php echo "</td>";

echo "</tr>";
}

else{
	echo "<tr>";

echo "<td width=20%>"; echo $row["m_from"]; echo "</td>";

echo "<td width=70% style=color:white;>"; ?> <a style="text-decoration:none;" href="adminReply.php?message_id=<?php echo $row["message_id"]; ?>"> <?php echo $row["message"];  ?></a> <?php echo "</td>";


echo "</tr>";
}

echo "</tbody>";
}
echo "</table>";
echo '<div class=text-center>';
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
	
	echo '<ul class=pagination style=margin-right:10px>';
 	echo '<li class=page-item>'; echo '<a class=page-link href="adminMessages.php?page=' . $page . '">' . $page . '</a> '; echo '</li>';
 	echo '</ul>';
}
echo '</div>';


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