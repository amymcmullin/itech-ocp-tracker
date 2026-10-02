<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>Students</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>Student List</h1>
 <br>
</div>
</head>
<body>
<br>
<br>
<?php

include ("conn.php");  //SQL connector
//echo $link;
 
// attempt select query execution

$sql = "SELECT * FROM students";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Student ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Start Date</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['stuID'] . "</td>";
                echo "<td>" . $row['stuNameFirst'] . "</td>";
                echo "<td>" . $row['stuNameLast'] . "</td>";
                echo "<td>" . $row['termID'] . "</td>";

            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
$mysqli->close();


?>
</body>
</html>
