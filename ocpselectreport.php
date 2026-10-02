<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>Program Standards</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>View Standards For Your Program</h1>
 <br>
</div>
</head>
<body>
<br>
<br>
<form action="" method="post">
 <select name="$ocp">
     <option disabled selected>-- Select OCP --</option>
    <?php

include ("conn.php");  //SQL connector
//echo $link;

      $records = mysqli_query($link, "SELECT ocpID, ocpName FROM OCPs");  
        while($data = mysqli_fetch_array($records))

        {
            echo "<option value='". $data['ocpID'] ."'>" .$data['ocpName'] ."</option>";  //pulls ocp id's
        }	

    ?>  
  </select>

<input type="submit" name="submit" vlaue="Choose options">  

<?php
    if(isset($_POST['submit'])){
    if(!empty($_POST['$ocp'])) {
        $selected = $_POST['$ocp'];
        echo 'You have chosen: ' . $selected;

    } else {
        echo 'Please select the value.';
    }
    }

$sql = "SELECT * FROM Standards WHERE ocpID='$selected'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>OCP</th>";
                echo "<th>Description</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['standardID'] . "</td>";
                echo "<td>" . $row['ocpID'] . "</td>";
                echo "<td>" . $row['standardDesc'] . "</td>";            
     echo "</tr>";
        }
        echo "</table>";
		echo "<a href='standardsselectreport.php'>See the skills for a specific standard.</a><br>";
		echo "<a href='assignmentssselectreport.php'>See the assignments for a specific standard.</a>";
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


