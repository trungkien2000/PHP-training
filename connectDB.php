<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "my_db";

// Create connection
$conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
