<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "waterwork";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . ".<br> ENTER CORRECT DATABASE");
}

// Start Session
session_start();
