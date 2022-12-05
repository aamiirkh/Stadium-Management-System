<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<title>Contact Form - PHP/MySQL Demo Code</title>
</head>

<body>
<fieldset>
<legend>Ticket Booking Form</legend>
<form name="frmContact" method="post" action="validate_booking.php" class="form">
<p>
<label>Matches</label>
<select name="match" class="form-control">
<?php
// Include config file
    require_once "../../config.php";

    // Attempt select query execution
    $sql = "SELECT Date, start_time, team.team_name, reservation_id FROM reservation inner join team on reservation.team_id = team.team_id";
    if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
		    while($row = mysqli_fetch_array($result)){
				echo "<option value=". $row["reservation_id"] .">". $row['Date'] . " | " . $row['start_time'] . " | " . $row["team_name"] ."</option>";
			}
		}
	}

?>
</select>
</p>
<p>
<label>Seat Type</label>
<select id="seat" name="seat" class="form-control">
	<option>Lower</option>
	<option>Economy</option>
	<option>First Class</option>
</select>
</p>
<p>&nbsp;</p>
<p>
<input type="submit" name="Submit" class="btn btn-primary" id="Submit" value="Submit">
</p>
</form>
</fieldset>
</body>
</html>