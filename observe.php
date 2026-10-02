<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>Result</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>Continue</h1>
 <br>
</div>
</head>
<body>
<br>
<br>
    <?php

include ("conn.php");  //SQL connector
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// get the post records for 

$txtdate = $_POST['txtdate'];
$txtstuID = $_POST['txtstuID'];
$txtstandardID = $_POST['txtstandardID'];
$txtlevelID = $_POST['txtlevelID'];
$txtObservation = $_POST['txtObservation'];
$earnID = rand(1, 999999999);
$txtassignmentID = rand(1, 9999999999);

 
// insert assignment
$sql = "INSERT INTO assignments (assignmentID, standardID, levelID, assignmentName) VALUES ('$txtassignmentID','$txtstandardID', '$txtlevelID', '$txtObservation')";
if(mysqli_query($link, $sql)){
//    echo "Records added successfully.";
//    echo "<a href='fullprogresscheck.php?selected=$txtstuID'>  View student progress</a>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// insert earned OCP
$sql = "INSERT INTO earnedOCP (earnID, date, stuID, assignmentID, Observation) VALUES ('$earnID','$txtdate', '$txtstuID','$txtassignmentID', '$txtObservation')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
    echo "<a href='fullprogresscheck.php?stuIDfromForm=$txtstuID'>  View student progress</a>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>
</body>
</html>
