<?php
// Database credentials
$host = 'localhost';
$dbname = 'ratnatray_traders';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}?>