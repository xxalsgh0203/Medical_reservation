<?php
$servername = "34.133.173.227";
$username = "root";
$password = "rootPassword";
$database = "medical_clinic";

// Create connection
$db = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
// echo "Connected successfully";
?>