<?php

class FILE {
    public static $filename_input = null;
    public static $filename = null;
    public static $file_path = null;
    public static $filename_valid_extension = null;
    public static function upload($filename_input, $file_path, $filename_valid_extension){
        self::$filename_input = $filename_input;
        self::$file_path = $file_path;
        self::$filename_valid_extension = $filename_valid_extension;
        if(empty(self::$filename_input)||empty(self::$file_path)||empty(self::$filename_valid_extension)){
            echo "Invalid or incomplete argument.";
        } else { // CHECKING FILE PATH
            $check_file_path_if_valid = str_split(self::$file_path);
            if(end($check_file_path_if_valid) != '/'){
                self::$file_path = $file_path.'/'; // IF END OF FILE IS NOT /, INSERT /
            }
            $filename_upload_extension = explode('.', self::$filename_input['name']);
            $filename_upload_extension_lowercase = strtolower(end($filename_upload_extension));
            if(self::$filename_input['error'] === 0){
                if(!in_array($filename_upload_extension_lowercase, self::$filename_valid_extension)){
                    echo "Invalid file extension";
                } else {
                    $new_filename_generated = uniqid('file', true).'.'.$filename_upload_extension_lowercase;
                    $new_file_upload_path = self::$file_path.$new_filename_generated;
                    self::$filename = $new_filename_generated; // SET FILENAME TO BE ACCESSIBLE
                    return move_uploaded_file(self::$filename_input['tmp_name'], $new_file_upload_path); // SUCCESSFULLY UPLOADED
                }
            } else {
                echo "There was an error uploading the file";
            }
        }
    }
}