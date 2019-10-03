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
    <!-- Custom Fonts from Google -->
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
                // Include config file
                require_once "config.php";

                // Define variables and initialize with empty values
                $username = $password = $confirm_password = "";
                $username_err = $password_err = $confirm_password_err = "";

                // Processing form data when form is submitted
                if($_SERVER["REQUEST_METHOD"] == "POST"){

                    // Validate username
                    if(empty(trim($_POST["username"]))){
                        $username_err = "Please enter a username.";
                    } else{
                        // Prepare a select statement
                        $sql = "SELECT id FROM users WHERE username = ?";

                        if($stmt = mysqli_prepare($link, $sql)){
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "s", $param_username);

                            // Set parameters
                            $param_username = trim($_POST["username"]);

                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                /* store result */
                                mysqli_stmt_store_result($stmt);

                                if(mysqli_stmt_num_rows($stmt) == 1){
                                    $username_err = "This username is already taken.";
                                } else{
                                    $username = trim($_POST["username"]);
                                }
                            } else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);
                    }

                    // Validate password
                    if(empty(trim($_POST["password"]))){
                        $password_err = "Please enter a password.";
                    } elseif(strlen(trim($_POST["password"])) < 6){
                        $password_err = "Password must have atleast 6 characters.";
                    } else{
                        $password = trim($_POST["password"]);
                    }

                    // Validate confirm password
                    if(empty(trim($_POST["confirm_password"]))){
                        $confirm_password_err = "Please confirm password.";
                    } else{
                        $confirm_password = trim($_POST["confirm_password"]);
                        if(empty($password_err) && ($password != $confirm_password)){
                            $confirm_password_err = "Password did not match.";
                        }
                    }

                    // Check input errors before inserting in database
                    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

                        // Prepare an insert statement
                        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

                        if($stmt = mysqli_prepare($link, $sql)){
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

                            // Set parameters
                            $param_username = $username;
                            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                // Redirect to login page
                                header("location: main.php");
                            } else{
                                echo "Something went wrong. Please try again later.";
                            }
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);
                    }

                    // Close connection
                    mysqli_close($link);
                }
                ?>

                    <div class="container">
                        <h2>Sign Up</h2>
                        <p>Please fill this form to create an account.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                <span class="help-block"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                                <span class="help-block"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn btn-default" value="Reset">
                            </div>
                            <p>Already have an account? <a href="login.php">Login here</a>.
                        </form>
                    </div>

            </div>
        </div>
    </header>

</body>

</html>
