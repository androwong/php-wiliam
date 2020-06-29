<?php
$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "wiliam";

//connection to the database
$mysqli = new mysqli($hostname, $username, $password, $dbname);
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>
