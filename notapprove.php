<?php
include'include/init.php';

$id = $_GET["id"];
$query = "UPDATE registration set status='no' where id=$id";
$squery = $dbconnect->query($query);
?>

<script type="text/javascript">
	window.location = "display_student_info.php";
</script>