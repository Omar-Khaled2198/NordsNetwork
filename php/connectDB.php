<?php

$servername = "localhost:3306";
$username = "root";
$password = "123456789";
$dbname = "NordsNetwork";

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

