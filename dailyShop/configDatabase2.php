<?php
    
$siteurl="http://localhost/training/PHP";
$dbhost="localhost";
$dbuser="root";
$dbpass="root";
$dbname="project";
$dbport=3307;

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>