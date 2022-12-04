<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Form - PHP/MySQL Demo Code</title>
</head>

<body>
<fieldset>
<legend>Team reservation Form</legend>
<form name="frmContact" method="post" action="validate_team.php">
<p>
<label>Date</label>
<input  type="text" name="date" id="date" placeholder="yyyy-mm-dd">
</p>
<p>
<label >Start time</label>
<input type="text" name="s_time" id="s_time" placeholder="hh:mm:ss">
</p>
<p>
<label >End time</label>
<input type="text" name="e_time" id="e_time" placeholder="hh:mm:ss">
</p>
<p>
<label>Stadium Name</label>
<select name="std_id">
<?php
// Include config file
    require_once "../../config.php";

    // Attempt select query execution
    $sql = "SELECT stadium_name, stadium_id FROM stadium";
    if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
		    while($row = mysqli_fetch_array($result)){
				echo "<option value=". $row["stadium_id"] .">". $row['stadium_name'] ."</option>";
			}
		}
	}
?>
</select>
</p>
<p>
<label>Team ID</label>
<input type="text" name="team_id" id="team_id">
</p>
<p>&nbsp;</p>
<p>
<input type="submit" name="Submit" id="Submit" value="Submit">
</p>
</form>
</fieldset>
</body>
</html>