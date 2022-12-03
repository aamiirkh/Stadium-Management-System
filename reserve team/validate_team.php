<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
require_once "../config.php";

// get the post records
$date = $_POST['date'];
$s_time = $_POST['s_time'];
$e_time = $_POST['e_time'];
$std_id = $_POST['std_id'];
$team_id = $_POST['team_id'];

// database insert SQL code
$sql = "INSERT INTO `reservation` ('id', `date`, `stime`, `etime`, `std_id`, `team_id`) VALUES ('0' ,'$date', '$s_time', '$e_time', '$std_id', '$team_id')";

// insert in database 
$rs = mysqli_query($link, $sql);

if($rs)
{
	echo "Contact Records Inserted";
}
else
{
	echo "no success";
}

?>