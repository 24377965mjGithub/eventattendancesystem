<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Student Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

$staffid = $_REQUEST['remove'];


if (query("DELETE FROM `staff` WHERE `staff`.`id` = $staffid")) {
    header ('location: ./index.php');
}

include './Includes/foot.php';