<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Staff Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

$eventname = $_REQUEST['eventname'];
$eventdesc = $_REQUEST['eventdesc'];
$date = $_REQUEST['month']." ".$_REQUEST['day'].", ".$_REQUEST['year']." on ".$_REQUEST['hour'].":".$_REQUEST['min']." ".$_REQUEST['ampm'];

$status = "Not happening";
$timeago = time();

// echo $eventname."<br>";
// echo $eventdesc."<br>";
// echo $date."<br>";
// echo $time."<br>";
// echo $status."<br>";
// echo $timeago."<br>";

if (query("INSERT INTO `events` (`event_name`, `date`, `eventdesc`, `status`, `timeago`) VALUES ('$eventname', '$date', '$eventdesc', '$status', '$timeago')")) {
    header ('location: ./index.php');
}

include './Includes/foot.php';