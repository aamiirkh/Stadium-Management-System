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
         
        if(($user['username'] == $username)) {
            $flag = 1;
		    echo "Username Already Taken";
        }
	}
	if ($flag == 0){
        
	    $query2 = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$password')";
	    $rs = mysqli_query($link, $query2);
	    if ($rs){
	        header("location: login.php");
	    }
        else{
            echo "Error.";
        }
	}
}
?>

