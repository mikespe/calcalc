<?php
session_start();
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$servername = "127.0.0.1";
$username = "weighool_mikespe";
$password = "Calvin0192!";
$dbname = "weighool_weightlog";
/* Attempt to connect to MySQL database */
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
