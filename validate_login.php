<?php
 
include_once('config.php');
  
function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = 0;
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $query = "SELECT * FROM users";
    $result= mysqli_query($link, $query);
    while($user = mysqli_fetch_assoc($result)) {
         
        if(($user['username'] == $username) && ($user['password'] == $password)) {
		$flag=1; 
		if(($user['username'] == "admin") && ($user['password'] == "admin")) {
               		header("location: admin_dashboard.php");
		}
		else{
			header("location: user_dashboard.php");
		}
        }
	}
	if ($flag == 0){
	    echo "<script language='javascript'>";
            echo "alert('WRONG INFORMATION')";
            echo "</script>";
            die();
	}
}
?>

