<html>
<head>
<link rel="stylesheet" href="styles.css">
  <title>Your Progress</title>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>Track Your Progress</h1>
 <br>
</div>

</head>
<body>



    <?php


include ("conn.php");  //SQL connector

/* Attempt MySQL server connection. 
$link = mysqli_connect("REDACTED_HOST", "REDACTED_USER", "REDACTED_PASS", "REDACTED_DB");


 
\\ Check connection
if($link === false){
    die("ERROR: Well, this is embarrassing. We can't connect to our data. Sorry to say, OUR WWEBSITE IS DOWN. Contact Support for the Magical OCP Tracker, NOT the IT for your company" . mysqli_connect_error());
}*/

      $records = mysqli_query($link, "SELECT stuID FROM students");  
        while($data = mysqli_fetch_array($records))

    ?>  


<br> 
<br> 

<?php
   if(isset($_GET['stuIDfromForm'])){
   if(!empty($_GET['stuIDfromForm'])) {
       $selected = $_GET['stuIDfromForm'];
//   } else {
//    if(isset($_POST['submit'])){
//    if(!empty($_POST['$stuID'])) {
 //       $selected = $_POST['$stuID'];
		echo '<h4>Your Student Number Is: ' . $selected;
		echo '</h4>';
    } else {
        echo 'Please enter your Student ID.';
//    }
  //  }
}
}

$sql = "SELECT earnedOCP.date, Standards.standardID, Standards.standardDesc, levels.levelID, levels.levelDescription FROM Standards JOIN assignments ON assignments.standardID=Standards.standardID JOIN levels ON levels.levelID=assignments.levelID INNER JOIN earnedOCP ON assignments.assignmentID=earnedOCP.assignmentID WHERE stuID='$selected'";


if($records2 = mysqli_query($link, $sql)){
echo "<h4>     Out of 50 standards you have achieved the following levels of mastery in " . mysqli_num_rows($records2);
echo ":</h4>";
    if(mysqli_num_rows($records2) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Date</th>";
                echo "<th>ID</th>";
                echo "<th>Standard</th>";
                echo "<th>Level</th>";
                echo "<th>Level Description</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($records2)){
            echo "<tr>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['standardID'] . "</td>";
                echo "<td>" . $row['standardDesc'] . "</td>";            
                echo "<td>" . $row['levelID'] . "</td>";            
                echo "<td>" . $row['levelDescription'] . "</td>";            
     echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($results);
        mysqli_free_result($results2);
    } else{
        echo "No records found.";
    }
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}

//start part2----------------------------------------------------------------------------------------------------------------------
echo "<br><br><br><br><br>";

$sql2 = "SELECT * FROM Standards EXCEPT (SELECT Standards.standardID, Standards.ocpID, Standards.standardDesc FROM Standards JOIN assignments ON assignments.standardID=Standards.standardID INNER JOIN earnedOCP ON assignments.assignmentID=earnedOCP.assignmentID WHERE stuID='$selected')";


if($records3 = mysqli_query($link, $sql2)){
echo "<h4>     You have " . mysqli_num_rows($records3);
echo " left to achieve.</h4>";
echo "<br>";
    if(mysqli_num_rows($records3) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Standard ID</th>";
                echo "<th>OCP/Course</th>";
                echo "<th>Standard</th>";
            echo "</tr>";
        while($row2 = mysqli_fetch_array($records3)){
            echo "<tr>";
                echo "<td>" . $row2['standardID'] . "</td>";
                echo "<td>" . $row2['ocpID'] . "</td>"; 
                echo "<td>" . $row2['standardDesc'] . "</td>";                   
     echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($results);
        mysqli_free_result($results2);
		mysqli_free_result($results3);
    } else{
        echo "No records found.";
    }
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}


//start part3----------------------------------------------------------------------------------------------------------------------
echo "<br><br><br><br><br>";

$sql3 = "SELECT earnedOCP.date, assignments.assignmentName, Standards.standardDesc, levels.levelID FROM Standards JOIN assignments ON assignments.standardID=Standards.standardID JOIN levels ON levels.levelID=assignments.levelID INNER JOIN earnedOCP ON assignments.assignmentID=earnedOCP.assignmentID WHERE stuID='$selected'";


if($records4 = mysqli_query($link, $sql3)){
echo "<h4>     You have completed " . mysqli_num_rows($records4);
echo " assignments.</h4>";
echo "<br>";
    if(mysqli_num_rows($records4) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Date</th>";
                echo "<th>Assignment</th>";
                echo "<th>Standard</th>";
                echo "<th>Level</th>";
            echo "</tr>";
        while($row3 = mysqli_fetch_array($records4)){
            echo "<tr>";
                echo "<td>" . $row3['date'] . "</td>";
                echo "<td>" . $row3['assignmentName'] . "</td>"; 
                echo "<td>" . $row3['standardDesc'] . "</td>";                   
                echo "<td>" . $row3['levelID'] . "</td>";
     echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($results);
        mysqli_free_result($results2);
		mysqli_free_result($results3);
		mysqli_free_result($results4);
    } else{
        echo "No records found.";
    }
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}
$mysqli->close();
?>

</form>

</body>
</html>


