<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
require_once "../../config.php";

// get the post records
$date = $_POST['date'];
$s_time = $_POST['s_time'];
$e_time = $_POST['e_time'];
$id = $_POST['std_id'];
$teamname = $_POST['team_name'];

// Turn autocommit off
mysqli_autocommit($link,FALSE);

$hours = abs((int)$s_time - (int)$e_time);
if ((int)$s_time > (int)$e_time){				// test case for checking start time > end time	
	echo mysqli_error($link);
}
else {
	$sql = "SELECT * FROM duration, reservation as e WHERE Date = '$date' AND ('$s_time' < end_time OR '$e_time' > start_time) AND e.reservation_id = duration.reservation_id;";
	if($rs = mysqli_query($link, $sql))
	{
		if(mysqli_num_rows($rs) > 0)
		{
			echo "Team Reservation failed";
		}
		else
		{
			$team_id = 0;
			$sql0 = "SELECT team_id from team WHERE team_name = '$teamname'";
			$rs0 = mysqli_query($link, $sql0);

			if($rs0){
				if(mysqli_num_rows($rs0) > 0){
					while($row = mysqli_fetch_array($rs0)){
						$team_id = $row['team_id'];
					}
				}
			}

			// database insert SQL code
			$sql1 = "INSERT INTO `reservation` (`Date`, `start_time`, `team_id`, `stadium_id`) VALUES ('$date', '$s_time', '$team_id', '$id')";
			$rs1 = mysqli_query($link, $sql1);

			$res_id = 0;

			$sql2 = "SELECT reservation_id FROM `reservation` WHERE Date = '$date' AND `start_time` = '$s_time'";
			$rs2 = mysqli_query($link, $sql2);

			if($rs2){
				if(mysqli_num_rows($rs2) > 0){
					while($row = mysqli_fetch_array($rs2)){
						$res_id = $row['reservation_id'];
					}
				}
			}

			$sql3 = "INSERT INTO `duration` (`reservation_id`, `end_time`, `no_of_reservation_hours`) VALUES ('$res_id','$e_time', '$hours')";
			// insert in database 
			$rs3 = mysqli_query($link, $sql3);
			
			$total_cost = $hours * 5000;
			$sql4 = "INSERT INTO `billing` (`total_cost`, `team_id`) VALUES ('$total_cost', '$team_id')";
			$rs4 = mysqli_query($link, $sql4);

			if($rs0 && $rs1 && $rs2 && $rs3 && $rs4) {
				mysqli_commit($link);				// commiting changes
				echo "Team Reserved Successfully";
			}
			else {
				// Rollback transaction
				mysqli_rollback($con);
				echo mysqli_error($link);
			}
		}
	}	
}

?>