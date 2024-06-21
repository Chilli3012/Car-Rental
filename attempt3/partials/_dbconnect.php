<?php
$server="localhost";
$username="root";
$password="";
$database="CarRental";


$conn=mysqli_connect($server, $username, $password, $database);  //establish a connection to the server 


if(!($conn))
{
    die("Error: ".mysqli_connect_error());;
}

?>