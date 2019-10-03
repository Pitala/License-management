
<!DOCTYPE html>
<!-- Template by Quackit.com -->
<!-- Images by various sources under the Creative Commons CC0 license and/or the Creative Commons Zero license.
Although you can use them, for a more unique website, replace these images with your own. -->
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Index</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>

    <!-- Navigation -->
    <nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navcontainer">
                <!-- Logo and responsive toggle -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <span class="glyphicon glyphicon-fire"></span>
                        license-management
                    </a>
                </div>

            </div>
    </nav>

	<!-- Header -->
    <header>
        <div class="header-content">
            <div class="header-content-inner">

                <?php
                // Initialize the session
                session_start();

                // Check if the user is logged in, if not then redirect to login page
                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                    header("location: login.php");
                    exit;
                }

                // Include config file
                require_once "config.php";

                // Define variables and initialize with empty values
                $new_password = $confirm_password = "";
                $new_password_err = $confirm_password_err = "";

                // Processing form data when form is submitted
                if($_SERVER["REQUEST_METHOD"] == "POST"){

                    // Validate new password
                    if(empty(trim($_POST["new_password"]))){
                        $new_password_err = "Please enter the new password.";
                    } elseif(strlen(trim($_POST["new_password"])) < 6){
                        $new_password_err = "Password must have atleast 6 characters.";
                    } else{
                        $new_password = trim($_POST["new_password"]);
                    }

                    // Validate confirm password
                    if(empty(trim($_POST["confirm_password"]))){
                        $confirm_password_err = "Please confirm the password.";
                    } else{
                        $confirm_password = trim($_POST["confirm_password"]);
                        if(empty($new_password_err) && ($new_password != $confirm_password)){
                            $confirm_password_err = "Password did not match.";
                        }
                    }

                    // Check input errors before updating the database
                    if(empty($new_password_err) && empty($confirm_password_err)){
                        // Prepare an update statement
                        $sql = "UPDATE users SET password = ? WHERE id = ?";

                        if($stmt = mysqli_prepare($link, $sql)){
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

                            // Set parameters
                            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                            $param_id = $_SESSION["id"];

                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                // Password updated successfully. Destroy the session, and redirect to login page
                                session_destroy();
                                header("location: index.php");
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


                <body>
                    <div class="container">
                        <h2>Reset Password</h2>
                        <p>Please fill out this form to reset your password.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                                <span class="help-block"><?php echo $new_password_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control">
                                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a class="btn btn-link" href="main.php">Cancel</a>
                            </div>
                        </form>
                    </div>
                </body>

            </div>
        </div>
    </header>


</body>

</html>
