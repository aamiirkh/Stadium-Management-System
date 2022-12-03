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
<input  type="date" value="2017-06-01" name="date" id="date">
</p>
<p>
<label >Start time</label>
<input type="time" name="s_time" id="s_time">
</p>
<p>
<label >End time</label>
<input type="time" name="e_time" id="e_time">
</p>
<p>
<label >Stadium ID</label>
<input type="text" name="std_id" id="std_id">
</p>
<p>
<label >Team ID</label>
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