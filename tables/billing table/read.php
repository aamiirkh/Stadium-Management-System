<?php
// Check existence of id parameter before processing further
if(isset($_GET["invoice_number"]) && !empty(trim($_GET["invoice_number"]))){
    // Include config file
    require_once "../../config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM billing";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        #mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["invoice_number"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $inv_no = $row["invoice_number"];
                $total_cost = $row["total_cost"];
                $team_id = $row["team_ID"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Invoice Number</label>
                        <p><b><?php echo $row["invoice_number"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Total Cost</label>
                        <p><b><?php echo $row["total_cost"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Team ID</label>
                        <p><b><?php echo $row["team_ID"]; ?></b></p>
                    </div>
                    <p><a href="billing.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>