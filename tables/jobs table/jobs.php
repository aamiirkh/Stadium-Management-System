<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 800px;
            margin: 0 auto;
        }
	#dashboard {
	    padding-left: 80px;
	    padding-top: 50px;
	}

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <h1 id='dashboard' class="text-inverse-secondary bg-secondary">Admin Dashboard</h1>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Job Details</h2>
                    </div>
                    <?php
                    // Include config file
                    require_once "../../config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM jobs";
                    if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                    echo '<table class="table table-bordered table-striped">
                        ';
                        echo "
                        <thead>
                            ";
                            echo "
                            <tr>
                                ";
                                echo "
                                <th>Job ID</th>";
                                echo "
                                <th>Job title</th>";
                                echo "
                                <th>Salary</th>";
                                echo "
                            </tr>";
                            echo "
                        </thead>";
                        echo "
                        <tbody>
                            ";
                            while($row = mysqli_fetch_array($result)){
                            echo "
                            <tr>
                                ";
                                echo "
                                <td>" . $row['job_id'] . "</td>";
                                echo "
                                <td>" . $row['job_title'] . "</td>";
                                echo "
                                <td>" . $row['salary'] . "</td>";
                                echo "
                                <td>
                                    ";
                                    echo '<a href="read.php?job_id='. $row['job_id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                    echo '<a href="update.php?job_id='. $row['job_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                    echo '<a href="delete.php?job_id='. $row['job_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "
                                </td>";
                                echo "
                            </tr>";
                            }
                            echo "
                        </tbody>";
                        echo "
                    </table>";
                    // Free result set
                    mysqli_free_result($result);
                    } else{
                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                    } else{
                    echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>