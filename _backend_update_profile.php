<?php
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Student Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

// getCurrent profie

$oldprofile = query("SELECT * FROM students WHERE id = $id");
while ($oldprofile_ = fetch($oldprofile)) {
    if ($oldprofile_['profilepic'] != 'profile.jpg') {
        unlink ('./Uploads/Profile/'.$oldprofile_['profilepic']);
    }
}

$file = $_FILES['profile'];

if (FILE::upload($file, './Uploads/Profile', ['jpg', 'jpeg', 'png'])) {
    $filename = FILE::$filename;
    if (query("UPDATE students SET profilepic = '$filename' WHERE id = $id")) {
        header ('location: ./index.php');
    } else {
        echo "ERROR";
    }
}

include './Includes/foot.php';