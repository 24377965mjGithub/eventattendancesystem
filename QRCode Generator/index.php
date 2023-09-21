<form method="post">
    <input type="text" name="input" placeholder="Enter data"><br>
    <button type="submit" name="qrcode_generator">Generate QR Code</button>
</form>
<?php
    if(isset($_REQUEST['qrcode_generator'])){
        ?>
            <span style="font-family: arial">
                <b>Data:</b> <?php echo $_REQUEST['input']?>
            </span><br><br>
            <span style="font-family: arial">
                <b>QR Code:</b>
            </span><br>
        <?php
        include 'phpqrcode/qrlib.php';
        $text = $_REQUEST['input'];
        $path = 'images/';
        $file = $path.uniqid('', true).'.png';
        $ecc = 'L';
        $pixel_size = 5;
        $frame_size = 5;
        QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
        echo "<img src=".$file.">";
    }
?>