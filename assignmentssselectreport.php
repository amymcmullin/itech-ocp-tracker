<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>Assignments by Standard</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>View Assignments for a Standard</h1>
 <br>
</div>
</head>
<body>
<br>
<br>
<form action="" method="post">
 <select name="$assignments">
     <option disabled selected>-- Select standard --</option>
    <?php

include ("conn.php");  //SQL connector
//echo $link;

      $records = mysqli_query($link, "SELECT standardID, standardDesc FROM Standards");  
        while($data = mysqli_fetch_array($records))

        {
            echo "<option value='". $data['standardID'] ."'>" .$data['standardDesc'] ."</option>";  //pulls standard id's
        }	

    ?>  
  </select>

<input type="submit" name="submit" vlaue="Choose options">  

<?php
    if(isset($_POST['submit'])){
    if(!empty($_POST['$assignments'])) {
        $selected = $_POST['$assignments'];
        echo 'You have chosen: ' . $selected;
	
    } else {
        echo 'Please select the value.';
    }
    }

$sql = "SELECT * FROM assignments WHERE standardID='$selected'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Standard</th>";
                echo "<th>Assignment</th>";
                echo "<th>Level</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['assignmentID'] . "</td>";
                echo "<td>" . $row['standardID'] . "</td>";
                echo "<td>" . $row['assignmentName'] . "</td>";  
                echo "<td>" . $row['levelID'] . "</td>";            
     echo "</tr>";
        }
        echo "</table>";
		echo "<a href='assignmentlist.php'>See all assignments.</a><br>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


$mysqli->close();
?>

</form>

</body>
</html>


