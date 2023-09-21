<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Student Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

$fullname = $_REQUEST['fullname'];
$phone = $_REQUEST['phonenumber'];
$email = $_REQUEST['email'];

$staffemail = query("SELECT * FROM staff WHERE email = '$email'");
$staffphone = query("SELECT * FROM staff WHERE phonenumber = '$phone'");

$staffemailcounter = counter($staffemail);
$staffphonecounter = counter($staffphone);

if ($staffemailcounter >= 1 || $staffphonecounter >= 1) {
    ?>
        <p class="alert alert-danger">Email or phone number already exist.</p>
    <?php
} else {
    if (query("INSERT INTO `staff` (`fullname`, `email`, `phonenumber`, `status`) VALUES ('$fullname', '$email', '$phone', 'active')")) {
        header ('location: ./index.php');
    }
}

include './Includes/foot.php';