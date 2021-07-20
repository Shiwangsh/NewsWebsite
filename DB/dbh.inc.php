<?php
// SQL CONNECTION
$serverName = "localhost";
$dbUsername = "admin";
$dbPassword = "admin";
$dbName = "news_website";

// mysqli
$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die("Connection to database failed.");
}
