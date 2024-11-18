<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "lpk";

$konek = mysqli_connect($servername, $username, $password, $database);
if (!$konek) {
 
    die("Connection failed: " . mysqli_connect_error());
 
};
// mysqli_close($konek);


?>