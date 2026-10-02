<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>Student Lookup</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>Lookup Student Information</h1>
 <br>
</div>


</head>
<body>
<p></p>
<h4>Enter any of the following information to search students.</h4>
<form action="" method="post">
  <label for="stuid">Student ID:</label><br>
<input type="text" name="$stuID",  id="stuid"><br>
  <label for="stufn">First Name:</label><br>
<input type="text" name="$stuFName" id="stufn"><br>
<label for="stuln">Last Name:</label><br>
<input type="text" name="$stuLName" id="stuln"><br><br>



    <?php

//$stuIDs = filter_var($stuID, FILTER_SANITIZE_NUMBER_INT);

include ("conn.php");  //SQL connector
//echo $link;


      $records = mysqli_query($link, "SELECT * FROM students");  
        while($data = mysqli_fetch_array($records))

    ?>  

<input type="submit" name="submit" value="Search">

Or <a href=studentlist.php>Show All</a>

<br><br><br>

<?php
    if(isset($_POST['submit'])){
    if(!empty($_POST['$stuID'])) {
        $selectedID = $_POST['$stuID'];
        echo 'You entered: ' . $selectedID;
    }
    elseif(!empty($_POST['$stuFName'])) {
        $selectedF = $_POST['$stuFName'];
        echo 'You entered: ' . $selectedF;
    }
    elseif(!empty($_POST['$stuLName'])) {
        $selectedL = $_POST['$stuLName'];
        echo 'You entered: ' . $selectedL;
    } else {
        echo 'Please enter your Name or Student ID';
    }
    }

$sql = "SELECT * FROM students WHERE stuID='$selectedID' OR stuNameFirst='$selectedF'OR stuNameLast='$selectedL'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Student ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
//                echo "<th>Start Date</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['stuID'] . "</td>";
                echo "<td>" . $row['stuNameFirst'] . "</td>";
                echo "<td>" . $row['stuNameLast'] . "</td>";  
 //               echo "<td>" . $row['termID'] . "</td>";            
     echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "  No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


$mysqli->close();
?>

</form>
</body>
</html>


