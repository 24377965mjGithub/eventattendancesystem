<?php

$hostName = "localhost";
$dbUser = "pma";
$dbPassword = "";
$dbName = "event_attendance_system";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>