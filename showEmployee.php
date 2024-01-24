<?php
	include'include/init.php';
	include'include/head.php';
	include'include/navLogin.php';
?>

<div class="container">
<?php

$info = "SELECT * from employee";

$squery = $dbconnect->query($info);
echo "<table class='table table-bordered'>";
echo "<tr>";
echo "<th>"; echo "Name"; echo "</th>";
echo "<th>"; echo "Registration Number"; echo "</th>";
echo "<th>"; echo "Phone No"; echo "</th>";
echo "<th>"; echo "Email"; echo "</th>";
echo "<th>"; echo "Status"; echo "</th>";
echo "<th>"; echo "Approve"; echo "</th>";
echo "<th>"; echo "Not Approve"; echo "</th>";
echo "</tr>";
while ($row = mysqli_fetch_array($squery)) {

echo "<tr>";
echo "<td>"; echo $row["name"]; echo "</td>";
echo "<td>"; echo $row["regNo"]; echo "</td>";
echo "<td>"; echo $row["phone"]; echo "</td>";
echo "<td>"; echo $row["email"]; echo "</td>";
echo "<td>"; echo $row["status"]; echo "</td>";

echo "<td>"; ?> <a style="text-decoration:none;" href="approve.php?id=<?php echo $row["id"]; ?>">Approve</a> <?php echo "</td>";
echo "<td>"; ?> <a style="text-decoration:none;" href="notapprove.php?id=<?php echo $row["id"]; ?>">Not Approve</a> <?php echo "</td>";

echo "</tr>";

}
echo "</table>";


?>

</div>

<?php

include'include/footer.php';

?>