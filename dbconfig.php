<?php
// Database configuration
$servername = "http://sql12.freesqldatabase.com/";  
$username = "sql12774326";          
$password = "M4RIyvlia2";              
$dbname = "sql12774326";      

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
