<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>Skills by Standard</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>View Skills in a Standard</h1>
 <br>
</div>
</head>
<body>
<br>
<br>
<form action="" method="post">
 <select name="$standard">
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
    if(!empty($_POST['$standard'])) {
        $selected = $_POST['$standard'];
        echo 'You have chosen: ' . $selected;
	
    } else {
        echo 'Please select the value.';
    }
    }

$sql = "SELECT * FROM skills WHERE standardID='$selected'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Skill</th>";
                echo "<th>Description</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['skillID'] . "</td>";
                echo "<td>" . $row['standardID'] . "</td>";
                echo "<td>" . $row['skillDesc'] . "</td>";            
     echo "</tr>";
        }
        echo "</table>";
		echo "<a href='skillslist.php'>See all Skills.</a><br>";
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


