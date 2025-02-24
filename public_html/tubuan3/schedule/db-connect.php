<?php
$host     = 'localhost';
$username = 'u664069117_dauntless';
$password = 'DauntlessBM2024';
$dbname   ='u664069117_barangaysystem';

$conn = new mysqli($host, $username, $password, $dbname);
if(!$conn){
    die("Cannot connect to the database.". $conn->error);
}