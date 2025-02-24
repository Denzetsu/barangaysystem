<?php 

define("HOSTNAME", "localhost");
define("USERNAME", "u664069117_dauntless");
define("PASSWORD", "DauntlessBM2024");
define("DATABASE", "u664069117_barangaysystem");

$conn = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);


if(!$conn){
    die("Connection Failed");
}

?>