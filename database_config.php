<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "airline_system";

$con = mysqli_connect($servername , $username , $password , $database);

if(!$con)
{
    die("Connection failed: " .mysqli_connect_error());
}

?>