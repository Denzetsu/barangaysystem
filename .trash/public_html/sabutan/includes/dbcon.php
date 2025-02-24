<?php

$host = "localhost";
$uname = "u664069117_dauntless";
$password = "DauntlessBM2024";
$database = "u664069117_barangaysystem";

$conn = mysqli_connect($host, $uname, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
