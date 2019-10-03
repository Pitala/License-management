<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to index page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Servus, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> dies ist eine tolle Testseite!</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Password reset</a>
        <a href="logout.php" class="btn btn-danger">Ausloggen</a>
    </p>
</body>
</html>
