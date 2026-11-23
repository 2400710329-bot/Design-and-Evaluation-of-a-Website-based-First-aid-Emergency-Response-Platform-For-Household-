<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "first_aid_emergency_response";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>