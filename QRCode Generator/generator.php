<?php
    include 'phpqrcode/qrlib.php';
    $text = $_REQUEST['value'];
    $path = 'images/';
    $file = $path.uniqid('', true).'.png';
    $ecc = 'L';
    $pixel_size = 5;
    $frame_size = 5;
    QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
    // echo "<img src=".$file.">";

    echo $file;
?>