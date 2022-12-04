<?php
// Include config file
require_once "../../config.php";
 
// Define variables and initialize with empty values
$stadium_name = $stadium_type = $stadium_capacity = $location_id = $std_id = "";
$std_name_err = $std_type_err = $std_capacity_err = $loc_id_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["stadium_name"]);
    if(empty($input_name)){
        $std_name_err = "Please enter a stadium name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $std_name_err = "Please enter a valid name.";
    } else{
        $stadium_name = $input_name;
    }
    
    // Validate type
    $input_std_type = trim($_POST["stadium_type"]);
    if(empty($input_std_type)){
        $std_type_err = "Please enter a stadium type.";     
    } else{
        $stadium_type = $input_std_type;
    }
    
    // Validate capacity
    $input_capacity = trim($_POST["stadium_capacity"]);
    if(empty($input_capacity)){
        $std_capacity_err = "Please enter the stadium capacity.";     
    } elseif(!ctype_digit($input_capacity)){
        $std_capacity_err = "Please enter a positive integer value.";
    } else{
        $stadium_capacity = $input_capacity;
    }

    // Validate location id
    $input_loc_id = trim($_POST["location_id"]);
    if(empty($input_loc_id)){
        $loc_id_err = "Please enter the location ID.";     
    } elseif(!ctype_digit($input_loc_id)){
        $loc_id_err = "Please enter a valid location ID.";
    } else{
        $location_id = $input_loc_id;
    }

    // Validate stadium id
    /*$input_std_id = trim($_POST["stadium_id"]);
    if(empty($input_std_id)){
        $std_id_err = "Please enter the stadium ID.";     
    } elseif(!ctype_digit($input_std_id)){
        $std_id_err = "Please enter a valid stadium ID.";
    } else{
        $std_id = $input_std_id;
    }*/

    // Check input errors before inserting in database
    if(empty($std_name_err) && empty($std_type_err) && empty($std_capacity_err) && empty($loc_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO stadium (stadium_name, stadium_type, stadium_capacity, location_id) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_std_name, $param_std_type, $param_capacity, $param_loc_id);
            
            // Set parameters
            //$param_std_id = $std_id;
            $param_std_name = $stadium_name;
            $param_std_type = $stadium_type;
            $param_capacity = $stadium_capacity;
            $param_loc_id = $location_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: stadium.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add stadium record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Stadium Name</label>
                            <input type="text" name="stadium_name" class="form-control <?php echo (!empty($std_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $stadium_name; ?>">
                            <span class="invalid-feedback"><?php echo $std_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Stadium Type</label>
                            <textarea name="stadium_type" class="form-control <?php echo (!empty($std_type_err)) ? 'is-invalid' : ''; ?>"><?php echo $stadium_type; ?></textarea>
                            <span class="invalid-feedback"><?php echo $std_type_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Stadium Capacity</label>
                            <input type="text" name="stadium_capacity" class="form-control <?php echo (!empty($std_capacity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $stadium_capacity; ?>">
                            <span class="invalid-feedback"><?php echo $std_capacity_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Location ID</label>
                            <textarea name="location_id" class="form-control <?php echo (!empty($loc_id_err)) ? 'is-invalid' : ''; ?>"><?php echo $location_id; ?></textarea>
                            <span class="invalid-feedback"><?php echo $loc_id_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="stadium.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
