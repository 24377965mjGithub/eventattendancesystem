<?php
    $conn = mysqli_connect('localhost', 'pma', '', 'school_publication');
    $response = array();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    header ('Content-Type: JSON');
    $i = 0;
    while ($result_ = mysqli_fetch_assoc($result)) {
        $response[$i]['id'] = $result_['id'];
        $response[$i]['firstname'] = $result_['firstname'];
        $i++;
    }
    echo json_encode($response, JSON_PRETTY_PRINT);
?>