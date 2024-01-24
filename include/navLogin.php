<?php
$devel = $_SESSION['loginsession'];

$info = "SELECT * FROM employee where email = '$devel'";
$squery1 = $conn->query($info);
while ($rowemp = mysqli_fetch_array($squery1))
{
$employee = $rowemp['fullName'];
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="developerDashboard.php">Task Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" style="float: right; margin-left: 86%;">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          echo $employee;
          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><img src="images/manager.png" class="img-fluid" ></a>
          
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="developerAccount.php"  style="text-decoration: none; color: black;">My Account</a>
          <a class="dropdown-item" href="logout.php"  style="text-decoration: none; color: black;">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>