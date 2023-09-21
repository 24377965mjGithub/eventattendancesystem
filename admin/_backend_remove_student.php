<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Admin Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

$studentid = $_REQUEST['remove'];

$getStudentid = query("SELECT * FROM students WHERE id = $studentid");
while ($getStudentid_ = fetch($getStudentid)) {
    $studentschoolid = $getStudentid_['student_id'];
}


if (query("DELETE FROM `ongoing_events` WHERE student_id = $studentschoolid")) {
    if (query("DELETE FROM `students` WHERE `students`.`id` = $studentid")) {
        echo "<p class='alert alert-success'>Account Deleted</p>";
    }
} else {
    if (query("DELETE FROM `students` WHERE `students`.`id` = $studentid")) {
        echo "<p class='alert alert-success'>Account Deleted</p>";
    }
}

include './Includes/foot.php';