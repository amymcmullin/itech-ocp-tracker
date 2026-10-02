<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>All Skills</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>View All Skills</h1>
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

$sql = "SELECT * FROM skills";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Description</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['skillID'] . "</td>";
                echo "<td>" . $row['skillDesc'] . "</td>";
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
