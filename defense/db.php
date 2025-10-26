<?php
$servername = "localhost";
$username = "root";  // default WAMP username
$password = "";      // default WAMP password is empty
$dbname = "mywebsite"; // 👈 must match your phpMyAdmin database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
