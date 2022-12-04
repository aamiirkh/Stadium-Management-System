<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
require_once "../../config.php";

// get the post records
$date = $_POST['date'];
$s_time = $_POST['s_time'];
$e_time = $_POST['e_time'];
$id = $_POST['std_id'];
$teamid = $_POST['team_id'];

$hours = abs((int)$s_time - (int)$e_time);
echo "$s_time <br> $date";
if ((int)$s_time > (int)$e_time){			
	echo "no success";
}
else {
	// database insert SQL code
	$sql1 = "INSERT INTO `reservation` (`reservation_id`, `Date`, `start_time`, `team_id`, `stadium_id`) VALUES ('0','$date', '$s_time', '$teamid', '$id')";
	$result = mysqli_query($link, $sql1);
	if(!$result){
		echo mysqli_error($link);
	}
	$res_id = 0;
	$reserve_id = "SELECT reservation_id FROM reservation WHERE Date = $date AND start_time = $s_time";
	$res = mysqli_query($link, $reserve_id);
	if($res){
		echo "1";
		if(mysqli_num_rows($res) > 0){
			echo "2";
		    while($row = mysqli_fetch_array($res)){
				$res_id = $row['reservation_id'];
				echo "$res_id";
			}
		}
	}
	echo "$res_id";

	$sql2 = "INSERT INTO `duration` (`reservation_id`, `end_time`, `no_of_reservation_hours`) VALUES ('$res_id','$e_time', '$hours')";
	// insert in database 
	$rs2 = mysqli_query($link, $sql2);

	if($rs2) {
		echo "Team Reserved Successfully";
	}
	else {
		echo mysqli_error($link);
	}
}

?>