<?php
include './Libraries/all.php';
include './Libraries/query.php';

$getstudent = $_REQUEST['student_id'];
$getDate = $_REQUEST['date'];
$getTime = $_REQUEST['time'];
$timeAgo = time();

$getEvent = query("SELECT * FROM events WHERE status = 'Happening Now'");
while ($getEvent_ = fetch($getEvent)) {
    $event = $getEvent_['id'];
}

$ifTimed_in = query("SELECT * FROM ongoing_events WHERE event_id = $event AND student_id = $getstudent");

// if no record
if (counter($ifTimed_in) === 0) {
    if (query("INSERT INTO `ongoing_events` (`event_id`, `student_id`, `date`, `timein`, `timeout`, `timeago`) VALUES ('$event', '$getstudent', '$getDate', '$getTime', '---', '$timeAgo')")) {
        $response = array();
        $sql = "SELECT * FROM students WHERE student_id = $getstudent";
        $result = mysqli_query($conn, $sql);
        header ('Content-Type: JSON');
        $i = 0;
        while ($result_ = mysqli_fetch_assoc($result)) {
            $response[$i]['id'] = $result_['id'];
            $response[$i]['firstname'] = $result_['firstname'];
            $response[$i]['lastname'] = $result_['lastname'];
            $response[$i]['profilepic'] = $result_['profilepic'];
            $response[$i]['qrcodestats'] = "timein";
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
} else {
    while ($ifTimed_in_ = fetch($ifTimed_in)) {
        // if timed out already
        if ($ifTimed_in_['timeout'] != '---') {
            $response = array();
            $sql = "SELECT * FROM students WHERE student_id = $getstudent";
            $result = mysqli_query($conn, $sql);
            header ('Content-Type: JSON');
            $i = 0;
            while ($result_ = mysqli_fetch_assoc($result)) {
                $response[$i]['id'] = $result_['id'];
                $response[$i]['firstname'] = $result_['firstname'];
                $response[$i]['lastname'] = $result_['lastname'];
                $response[$i]['profilepic'] = $result_['profilepic'];
                $response[$i]['qrcodestats'] = "finished";
                $i++;
            }
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            if (query("UPDATE `ongoing_events` SET `timeout` = '$getTime' WHERE event_id = $event AND student_id = $getstudent")) {
                $response = array();
                $sql = "SELECT * FROM students WHERE student_id = $getstudent";
                $result = mysqli_query($conn, $sql);
                header ('Content-Type: JSON');
                $i = 0;
                while ($result_ = mysqli_fetch_assoc($result)) {
                    $response[$i]['id'] = $result_['id'];
                    $response[$i]['firstname'] = $result_['firstname'];
                    $response[$i]['lastname'] = $result_['lastname'];
                    $response[$i]['profilepic'] = $result_['profilepic'];
                    $response[$i]['qrcodestats'] = "timeout";
                    $i++;
                }
                echo json_encode($response, JSON_PRETTY_PRINT);
            }
        }
    }
}


    // $response = array();
    // $sql = "SELECT * FROM students WHERE student_id = $getstudent";
    // $result = mysqli_query($conn, $sql);
    // header ('Content-Type: JSON');
    // $i = 0;
    // while ($result_ = mysqli_fetch_assoc($result)) {
    //     $response[$i]['id'] = $result_['id'];
    //     $response[$i]['firstname'] = $result_['firstname'];
    //     $response[$i]['lastname'] = $result_['lastname'];
    //     $response[$i]['profilepic'] = $result_['profilepic'];
    //     $i++;
    // }
    // echo json_encode($response, JSON_PRETTY_PRINT);