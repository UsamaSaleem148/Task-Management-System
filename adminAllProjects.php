<?php

  session_start();
  include'include/adminSidebar.php';

	$admin = $_SESSION['adminLogin'];
			$squery = "SELECT * FROM managermessage WHERE m_to = '$admin' AND status = 'No'";
			$resulty = mysqli_query($conn, $squery);
			$count = mysqli_num_rows($resulty);

	$results_per_page = 10;

// find out the number of results stored in database

$sql='SELECT * FROM project';
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

<div class="container-fluid">
	<label style="font-size: 2em; margin-top: 2%; margin-bottom: 2%;">All Your Projects</label>
<br>
	<label for="myInput">Search Here</label>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
	<br>


	<ul class="nav nav-tabs nav-fill" id="tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link" href="#new" id="newProjects" role="tab" data-toggle="tab" onclick="myNewProject()">New Projects</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#progress" id="progressProject" role="tab" data-toggle="tab" onclick="myInProgressProject()">In Progress</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#completed" id="completedProject" role="tab" data-toggle="tab" onclick="myCompletedProject()">Completed</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="new">

  	<?php

$info = "SELECT * from project WHERE completed = 0 LIMIT " . $this_page_first_result . ',' .  $results_per_page;

$squery = $conn->query($info);
echo "<table class='table table-bordered'>";
echo "<thead class=thead-dark>";
echo "<tr>";
echo "<th>"; echo "Developer"; echo "</th>";
echo "<th>"; echo "Manager"; echo "</th>";
echo "<th>"; echo "Title"; echo "</th>";
echo "<th>"; echo "Priority"; echo "</th>";
echo "<th>"; echo "Due Date"; echo "</th>";
echo "<th>"; echo "Percentage Completed"; echo "</th>";
echo "<th>"; echo "Last Modified"; echo "</th>";
echo "<th>"; echo "Edit Project"; echo "</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($squery)) {

echo "<tbody id=myTable>";
echo "<tr>";


$qq = $row['emp_id'];

if ($qq == '0') {
	echo "<td class=bg-danger>"; echo "No Assigned Developer"; echo "</td>";
}
else{
$queryw = "SELECT * FROM employee WHERE emp_id = $qq";

$squery1 = $conn->query($queryw);

while ($row1 = mysqli_fetch_array($squery1)) {



echo "<td>"; echo $row1["fullName"]; echo "</td>";
}

}


$manage = $row['m_id'];


$queryManager = "SELECT * FROM manager WHERE m_id = $manage";

$resManager = $conn->query($queryManager);

while ($rowManager = mysqli_fetch_array($resManager)) {


echo "<td>"; echo $rowManager["fullName"]; echo "</td>";




}


echo "<td>"; echo $row["title"]; echo "</td>";
echo "<td>"; echo $row["priority"]; echo "</td>";
if (date("Y-m-d") > $row["endDate"]) {
	echo "<td class=bg-danger>"; echo $row["endDate"]; echo "</td>";
}
else{
echo "<td>"; echo $row["endDate"]; echo "</td>";
}
echo "<td>"; echo $row["completed"]; ?>

<div class="progress">
    <div class="progress-bar" style="width:<?php echo $row["completed"]; ?>%">
    </div>
  </div>

  <?php
  echo "</td>";
echo "<td>"; echo $row["modified"]; echo "</td>";

echo "<td>"; ?> <a style="text-decoration:none;" href="adminEditProject.php?id=<?php echo $row["id"]; ?>"><button class="btn btn-outline-success btn-sm">Edit Project</button></a> <?php echo "</td>";
echo "</tr>";
echo "</tbody>";
}
echo "</table>";



echo '<div class=text-center>';
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
	
	echo '<ul class=pagination style=margin-right:10px>';
 	echo '<li class=page-item>'; echo '<a class=page-link href="adminAllProjects.php?page=' . $page . '">' . $page . '</a> '; echo '</li>';
 	echo '</ul>';
}
echo '</div>';

?>


  </div>




  <div role="tabpanel" class="tab-pane fade" id="progress">


  	  	<?php

$info = "SELECT * from project WHERE completed > 0 AND completed < 100 LIMIT " . $this_page_first_result . ',' .  $results_per_page;

$squery = $conn->query($info);
echo "<table class='table table-bordered'>";
echo "<thead class=thead-dark>";
echo "<tr>";
echo "<th>"; echo "Developer"; echo "</th>";
echo "<th>"; echo "Manager"; echo "</th>";
echo "<th>"; echo "Title"; echo "</th>";
echo "<th>"; echo "Priority"; echo "</th>";
echo "<th>"; echo "Due Date"; echo "</th>";
echo "<th>"; echo "Percentage Completed"; echo "</th>";
echo "<th>"; echo "Last Modified"; echo "</th>";
echo "<th>"; echo "Edit Project"; echo "</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($squery)) {

echo "<tbody id=myTable>";
echo "<tr>";


$qq = $row['emp_id'];

if ($qq == '0') {
	echo "<td class=bg-danger>"; echo "No Assigned Developer"; echo "</td>";
}
else{
$queryw = "SELECT * FROM employee WHERE emp_id = $qq";

$squery1 = $conn->query($queryw);

while ($row1 = mysqli_fetch_array($squery1)) {



echo "<td>"; echo $row1["fullName"]; echo "</td>";
}

}


$manage = $row['m_id'];


$queryManager = "SELECT * FROM manager WHERE m_id = $manage";

$resManager = $conn->query($queryManager);

while ($rowManager = mysqli_fetch_array($resManager)) {


echo "<td>"; echo $rowManager["fullName"]; echo "</td>";




}


echo "<td>"; echo $row["title"]; echo "</td>";
echo "<td>"; echo $row["priority"]; echo "</td>";
if (date("Y-m-d") > $row["endDate"]) {
	echo "<td class=bg-danger>"; echo $row["endDate"]; echo "</td>";
}
else{
echo "<td>"; echo $row["endDate"]; echo "</td>";
}
echo "<td>"; echo $row["completed"]; ?>

<div class="progress">
    <div class="progress-bar" style="width:<?php echo $row["completed"]; ?>%">
    </div>
  </div>

  <?php
  echo "</td>";
echo "<td>"; echo $row["modified"]; echo "</td>";

echo "<td>"; ?> <a style="text-decoration:none;" href="adminEditProject.php?id=<?php echo $row["id"]; ?>"><button class="btn btn-outline-success btn-sm">Edit Project</button></a> <?php echo "</td>";

echo "</tr>";
echo "</tbody>";
}
echo "</table>";



echo '<div class=text-center>';
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
	
	echo '<ul class=pagination style=margin-right:10px>';
 	echo '<li class=page-item>'; echo '<a class=page-link href="adminAllProjects.php?page=' . $page . '">' . $page . '</a> '; echo '</li>';
 	echo '</ul>';
}
echo '</div>';

?>

  </div>
  <div role="tabpanel" class="tab-pane fade" id="completed">

  	  	<?php

$info = "SELECT * from project WHERE completed = 100 LIMIT " . $this_page_first_result . ',' .  $results_per_page;

$squery = $conn->query($info);
echo "<table class='table table-bordered'>";
echo "<thead class=thead-dark>";
echo "<tr>";
echo "<th>"; echo "Developer"; echo "</th>";
echo "<th>"; echo "Manager"; echo "</th>";
echo "<th>"; echo "Title"; echo "</th>";
echo "<th>"; echo "Priority"; echo "</th>";
echo "<th>"; echo "Due Date"; echo "</th>";
echo "<th>"; echo "Percentage Completed"; echo "</th>";
echo "<th>"; echo "Last Modified"; echo "</th>";
echo "<th>"; echo "Edit Project"; echo "</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($squery)) {

echo "<tbody id=myTable>";
echo "<tr>";


$qq = $row['emp_id'];

if ($qq == '0') {
	echo "<td class=bg-danger>"; echo "No Assigned Developer"; echo "</td>";
}
else{
$queryw = "SELECT * FROM employee WHERE emp_id = $qq";

$squery1 = $conn->query($queryw);

while ($row1 = mysqli_fetch_array($squery1)) {



echo "<td>"; echo $row1["fullName"]; echo "</td>";
}

}


$manage = $row['m_id'];


$queryManager = "SELECT * FROM manager WHERE m_id = $manage";

$resManager = $conn->query($queryManager);

while ($rowManager = mysqli_fetch_array($resManager)) {


echo "<td>"; echo $rowManager["fullName"]; echo "</td>";




}


echo "<td>"; echo $row["title"]; echo "</td>";
echo "<td>"; echo $row["priority"]; echo "</td>";
if (date("Y-m-d") > $row["endDate"]) {
	echo "<td class=bg-danger>"; echo $row["endDate"]; echo "</td>";
}
else{
echo "<td>"; echo $row["endDate"]; echo "</td>";
}
echo "<td>"; echo $row["completed"]; ?>

<div class="progress">
    <div class="progress-bar" style="width:<?php echo $row["completed"]; ?>%">
    </div>
  </div>

  <?php
  echo "</td>";
echo "<td>"; echo $row["modified"]; echo "</td>";

echo "<td>"; ?> <a style="text-decoration:none;" href="adminEditProject.php?id=<?php echo $row["id"]; ?>"><button class="btn btn-outline-success btn-sm">Edit Project</button></a> <?php echo "</td>";

echo "</tr>";
echo "</tbody>";
}
echo "</table>";



echo '<div class=text-center>';
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
	
	echo '<ul class=pagination style=margin-right:10px>';
 	echo '<li class=page-item>'; echo '<a class=page-link href="adminAllProjects.php?page=' . $page . '">' . $page . '</a> '; echo '</li>';
 	echo '</ul>';
}
echo '</div>';

?>
  	

  </div>
</div>















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





function myNewProject() {	
document.getElementById("newProjects").style.backgroundColor  = "#3d72b4";
document.getElementById("newProjects").style.color  = "White";
document.getElementById("progressProject").style.backgroundColor  = "";
document.getElementById("progressProject").style.color  = "";
document.getElementById("completedProject").style.backgroundColor  = "";
document.getElementById("completedProject").style.color  = "";
}


function myInProgressProject() {	
document.getElementById("progressProject").style.backgroundColor  = "#00bf8f";
document.getElementById("progressProject").style.color  = "White";
document.getElementById("completedProject").style.backgroundColor  = "";
document.getElementById("completedProject").style.color  = "";
document.getElementById("newProjects").style.backgroundColor  = "";
document.getElementById("newProjects").style.color  = "";
}

function myCompletedProject() {	
document.getElementById("progressProject").style.backgroundColor  = "";
document.getElementById("progressProject").style.color  = "";
document.getElementById("completedProject").style.backgroundColor  = "#dc2430";
document.getElementById("completedProject").style.color  = "White";
document.getElementById("newProjects").style.backgroundColor  = "";
document.getElementById("newProjects").style.color  = "";
}

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