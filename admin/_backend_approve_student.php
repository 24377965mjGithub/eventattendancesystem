<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Student Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

$studentid = $_REQUEST['student'];


if (query("UPDATE `students` SET `status` = 'approved' WHERE `students`.`id` = $studentid")) {
    header ('location: ./incoming_accounts.php');
}

include './Includes/foot.php';