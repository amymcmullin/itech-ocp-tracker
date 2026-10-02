<html>
<head>
<link rel="stylesheet" href="styles.css">
<title>Observations</title>
</head>
<div>
<br>
<a href="index.php">
<img src="images/logo.png" height="75" style="float:right">
</a>
<h1>Enter Observations of Student Work</h1>
 <br>
</div>
<body>
<fieldset>
<legend>Observation Form</legend>
Enter Observed Student Skills Here
<form name="frmTerms" method="post" action="observe.php">
<label for="ID"> Date (YYYY-MM-DD)</label><br>
<input type="text" name="txtdate" id="txtdate"><br>
<label for="ID">Student ID Number</label><br>

<select name="txtstuID" id="txtstuID">
     <option disabled selected>-- Select Student --</option>
    <?php

include ("conn.php");  //SQL connector
//echo $link;

      $records1 = mysqli_query($link, "SELECT stuID, stuNameLast FROM students");  
        while($data1 = mysqli_fetch_array($records1))

        {
            echo "<option value='". $data1['stuID'] ."'>" .$data1['stuNameLast'] ."</option>";  //pulls student id's
        }	

    ?>  
  </select><br>

<label for="Skill">Standard Observed</label><br>
<select name="txtstandardID" id="txtstandardID">
     <option disabled selected>-- Select Standard --</option>
    <?php

      $records2 = mysqli_query($link, "SELECT standardID, standardDesc FROM Standards");  
        while($data2 = mysqli_fetch_array($records2))

        {
            echo "<option value='". $data2['standardID'] ."'>" .$data2['standardDesc'] ."</option>";  //pulls standard id's
        }	

    ?>  
  </select><br>


<label for="Skill">Skill Level</label><br>
<select name="txtlevelID" id="txtlevelID">
     <option disabled selected>-- Select level --</option>
    <?php

      $records3 = mysqli_query($link, "SELECT levelID FROM levels");  
        while($data3 = mysqli_fetch_array($records3))

        {
            echo "<option value='". $data3['levelID'] ."'>" .$data3['levelID'] ."</option>";  //pulls level id's
        }	

    ?>  
  </select><br>
<label for="Observation">Observation Notes</label><br>
<textarea type="text" name="txtObservation" id="txtObservation"></textarea><br><br>
<p>&nbsp;</p>
<p>
<input type="submit" name="Submit" id="Submit" value="Submit">
</p>
</form>
</fieldset>
</body>
</html>
