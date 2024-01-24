<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
  
<form method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title">
    <label>File Upload</label>
    <input type="File" name="file">
    <input type="submit" name="submit">
    <input type="submit" name="submit1">
  
  
</form>
  
</body>
</html>
  
<?php
include('include/init.php');
  
if (isset($_POST["submit"]))
 {
    #retrieve file title
    $title = $_POST["title"];
      
    #file name with a random number so that similar dont get replaced
     $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
  
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
    
    #upload directory path
    $uploads_dir = 'images';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);
  
    #sql query to insert into database
    $sql = "UPDATE project SET file = '$pname' WHERE id = '9'";
  
    if(mysqli_query($conn,$sql)){
  
    echo "File Sucessfully uploaded";
    }
    else{
        echo "Error";
    }
}
    $sqli = "SELECT * from project WHERE id = '9'";
  
    $resultSelect = mysqli_query($conn, $sqli);
  
    while($rowS = mysqli_fetch_array($resultSelect)){
                    $path = $rowS[11];
                }
    echo "<br><a href='download.php?dow=$path'>Download</a>";

  
  
?>