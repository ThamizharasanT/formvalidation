<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "myproject1";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
} else {
    // echo " connection success";
}
echo "<br>";