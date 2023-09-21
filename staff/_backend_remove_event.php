<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Staff Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

$event = $_REQUEST['event'];

if (query("DELETE FROM `events` WHERE `events`.`id` = $event")) {
    header('location: ./index.php');
}

include './Includes/foot.php';