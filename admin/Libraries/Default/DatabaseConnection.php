<?php

$databaseCredentialJsonFile = file_get_contents('./Database/databaseCredentials.json');
$decodeDatabaseCredentials = json_decode($databaseCredentialJsonFile, true);

foreach ($decodeDatabaseCredentials as $key => $value):
    try {
        $conn = mysqli_connect(
            $value['server_name'],
            $value['server_username'],
            $value['server_password'],
            $value['database_name']
        );
        if(!$conn):
            throw new Exception("Database Connection Error");
        endif;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
endforeach;