<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', '[USERNAME]');
define('DB_PASSWORD', '[PASSWORT]');
define('DB_NAME', 'licenses');

/* Verbinden mit MYSQL Database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verbindung überprüfen
if($link === false){
    die("ERROR: Konnte nicht verbinden " . mysqli_connect_error());
}

?>
