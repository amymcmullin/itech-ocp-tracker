<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>Terms</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>View All Terms</h1>
 <br>
</div>
</head>
<body>
<br>
<br>
    <?php

include ("conn.php");  //SQL connector
//echo $link;

$sql = "SELECT * FROM terms";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Term</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['termID'] . "</td>";
                echo "<td>" . $row['termName'] . "</td>";
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
