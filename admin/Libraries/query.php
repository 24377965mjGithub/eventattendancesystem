<?php

// time ago
function timeAgo($time){
    $diff = time() - $time;

    $sec = $diff;
    $min = round($diff / 60);
    $hrs = round($diff / 3600);
    $days = round($diff / 86400);
    $weeks = round($diff / 604800);
    $mnths = round($diff / 2600640);
    $yrs = round($diff / 31207680);

    if ($sec <= 60){
        if ($sec == 1){
            return "1 second ago";
        } else {
            return "$sec seconds ago";
        }
    }
    else if ($min <= 60) {
        if ($min == 1){
            return "1 minute ago";
        } else {
            return "$min minutes ago";
        }
    }
    else if ($hrs <= 24) {
        if ($hrs == 1){
            return "1 hour ago";
        } else {
            return "$hrs hours ago";
        }
    }
    else if ($days <= 7) {
        if ($days == 1){
            return "1 day ago";
        } else {
            return "$days days ago";
        }
    }
    else if ($weeks <= 4.3) {
        if ($weeks == 1){
            return "1 week ago";
        } else {
            return "$weeks weeks ago";
        }
    }
    else if ($mnths <= 12) {
        if ($mnths == 1){
            return "1 month ago";
        } else {
            return "$mnths months ago";
        }
    }
    else {
        if ($yrs == 1){
            return "1 year ago";
        } else {
            return "$yrs years ago";
        }
    }
}

// file upload
function upload($filename_input, $file_path, $filename_valid_extension){
    $filename_input = $filename_input;
    $file_path = $file_path;
    $filename_valid_extension = $filename_valid_extension;
    if(empty($filename_input)||empty($file_path)||empty($filename_valid_extension)){
        echo "Invalid or incomplete argument.";
    } else { // CHECKING FILE PATH
        $check_file_path_if_valid = str_split($file_path);
        if(end($check_file_path_if_valid) != '/'){
            $file_path = $file_path.'/'; // IF END OF FILE IS NOT /, INSERT /
        }
        $filename_upload_extension = explode('.', $filename_input['name']);
        $filename_upload_extension_lowercase = strtolower(end($filename_upload_extension));
        if($filename_input['error'] === 0){
            if(!in_array($filename_upload_extension_lowercase, $filename_valid_extension)){
                echo "Invalid file extension";
            } else {
                $new_filename_generated = uniqid('file', true).'.'.$filename_upload_extension_lowercase;
                $new_file_upload_path = $file_path.$new_filename_generated;
                $filename = $new_filename_generated; // SET FILENAME TO BE ACCESSIBLE
                return move_uploaded_file($filename_input['tmp_name'], $new_file_upload_path); // SUCCESSFULLY UPLOADED
            }
        } else {
            echo "There was an error uploading the file";
        }
    }
}

// query
function query($query) {
    include './Libraries/Default/DatabaseConnection.php';
    return mysqli_query($conn, $query);
}
function get($query) {
    include './Libraries/Default/DatabaseConnection.php';
    return mysqli_query($conn, $query);
}
function update($query) {
    include './Libraries/Default/DatabaseConnection.php';
    return mysqli_query($conn, $query);
}
function delete($query) {
    include './Libraries/Default/DatabaseConnection.php';
    return mysqli_query($conn, $query);
}
function insert($query) {
    include './Libraries/Default/DatabaseConnection.php';
    return mysqli_query($conn, $query);
}

// fetch
function fetch($query) {
    include './Libraries/Default/DatabaseConnection.php';
    return mysqli_fetch_assoc($query);
}

// count
function counter($query) {
    include './Libraries/Default/DatabaseConnection.php';
    return mysqli_num_rows($query);
}

// api
function api_1($query, $key_1, $value_1) {
    include './Libraries/Default/DatabaseConnection.php';
    $response = array();
    $result = mysqli_query($conn, $query);
    header ('Content-Type: JSON');
    $i = 0;
    while ($result_ = mysqli_fetch_assoc($result)) {
        $response[$i][$key_1] = $result_[$value_1];
        $i++;
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}
function api_2($query, $key_1, $value_1, $key_2, $value_2) {
    include './Libraries/Default/DatabaseConnection.php';
    $response = array();
    $result = mysqli_query($conn, $query);
    header ('Content-Type: JSON');
    $i = 0;
    while ($result_ = mysqli_fetch_assoc($result)) {
        $response[$i][$key_1] = $result_[$value_1];
        $response[$i][$key_2] = $result_[$value_2];
        $i++;
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}
function api_3($query, $key_1, $value_1, $key_2, $value_2, $key_3, $value_3) {
    include './Libraries/Default/DatabaseConnection.php';
    $response = array();
    $result = mysqli_query($conn, $query);
    header ('Content-Type: JSON');
    $i = 0;
    while ($result_ = mysqli_fetch_assoc($result)) {
        $response[$i][$key_1] = $result_[$value_1];
        $response[$i][$key_2] = $result_[$value_2];
        $response[$i][$key_3] = $result_[$value_3];
        $i++;
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}
function api_4($query, $key_1, $value_1, $key_2, $value_2, $key_3, $value_3, $key_4, $value_4) {
    include './Libraries/Default/DatabaseConnection.php';
    $response = array();
    $result = mysqli_query($conn, $query);
    header ('Content-Type: JSON');
    $i = 0;
    while ($result_ = mysqli_fetch_assoc($result)) {
        $response[$i][$key_1] = $result_[$value_1];
        $response[$i][$key_2] = $result_[$value_2];
        $response[$i][$key_3] = $result_[$value_3];
        $response[$i][$key_4] = $result_[$value_4];
        $i++;
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}
function api_5($query, $key_1, $value_1, $key_2, $value_2, $key_3, $value_3, $key_4, $value_4, $key_5, $value_5) {
    include './Libraries/Default/DatabaseConnection.php';
    $response = array();
    $result = mysqli_query($conn, $query);
    header ('Content-Type: JSON');
    $i = 0;
    while ($result_ = mysqli_fetch_assoc($result)) {
        $response[$i][$key_1] = $result_[$value_1];
        $response[$i][$key_2] = $result_[$value_2];
        $response[$i][$key_3] = $result_[$value_3];
        $response[$i][$key_4] = $result_[$value_4];
        $response[$i][$key_5] = $result_[$value_5];
        $i++;
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}
function api_6($query, $key_1, $value_1, $key_2, $value_2, $key_3, $value_3, $key_4, $value_4, $key_5, $value_5, $key_6, $value_6) {
    include './Libraries/Default/DatabaseConnection.php';
    $response = array();
    $result = mysqli_query($conn, $query);
    header ('Content-Type: JSON');
    $i = 0;
    while ($result_ = mysqli_fetch_assoc($result)) {
        $response[$i][$key_1] = $result_[$value_1];
        $response[$i][$key_2] = $result_[$value_2];
        $response[$i][$key_3] = $result_[$value_3];
        $response[$i][$key_4] = $result_[$value_4];
        $response[$i][$key_5] = $result_[$value_5];
        $response[$i][$key_6] = $result_[$value_6];
        $i++;
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}