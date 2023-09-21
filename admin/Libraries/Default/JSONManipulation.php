<?php

class JSON {
    public static $json_filename = null;
    public static $data_to_be_inserted = null;
    public static $data_key_to_be_deleted = null;
    public static $data_value_to_be_deleted = null;
    public static $data_key_to_be_updated = null;
    public static $data_value_to_be_updated = null;
    public static $key_to_insert_new_updated_data = null;
    public static $new_updated_data = null;

    // READ JSON FILE

    public static function read($json_filename){
        self::$json_filename = $json_filename;
        if(file_exists(self::$json_filename)){
            $check_if_the_file_extension_is_json = explode('.', self::$json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                echo "File extension error. It must be a .json file.";
            } else {
                return json_decode(file_get_contents(self::$json_filename), true);
            }
        } else {
            echo "File doesn't exists or filename extension error";
        }
    }

    // PUSH DATA TO JSON FILE

    public static function push($json_filename, $data_to_be_inserted){
        self::$json_filename = $json_filename;
        self::$data_to_be_inserted = $data_to_be_inserted;
        if(file_exists(self::$json_filename)){ // IF JSON FILE ALREADY EXIST
            $check_if_the_file_extension_is_json = explode('.', self::$json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                echo "File extension error. It must be a .json file.";
            } else {
                if(empty(file_get_contents(self::$json_filename))){ // IF THE CONTENT OF JSON FILE IS EMPTY
                    file_put_contents(self::$json_filename, '[]');
                    $json_file_decoded = json_decode(file_get_contents(self::$json_filename), true);
                    // INSERTION
                    array_push($json_file_decoded, self::$data_to_be_inserted);
                    $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                    return file_put_contents(self::$json_filename, $json_file_encoded);
                } else {
                    $json_file_decoded = json_decode(file_get_contents(self::$json_filename), true);
                    // INSERTION
                    array_push($json_file_decoded, self::$data_to_be_inserted);
                    $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                    return file_put_contents(self::$json_filename, $json_file_encoded);
                }
            }
        } else {
            $check_if_the_file_extension_is_json = explode('.', self::$json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){
                echo "File extension error. It must be a .json file.";
            } else {
                file_put_contents(self::$json_filename, '[]');
                $json_file_decoded = json_decode(file_get_contents(self::$json_filename), true);
                // INSERTION
                array_push($json_file_decoded, self::$data_to_be_inserted);
                $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                return file_put_contents(self::$json_filename, $json_file_encoded);
            }
        }
    }

    // UNSHIFT DATA TO JSON FILE

    public static function unshift($json_filename, $data_to_be_inserted){
        self::$json_filename = $json_filename;
        self::$data_to_be_inserted = $data_to_be_inserted;
        if(file_exists(self::$json_filename)){ // IF JSON FILE ALREADY EXIST
            $check_if_the_file_extension_is_json = explode('.', self::$json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                echo "File extension error. It must be a .json file.";
            } else {
                if(empty(file_get_contents(self::$json_filename))){ // IF THE CONTENT OF JSON FILE IS EMPTY
                    file_put_contents(self::$json_filename, '[]');
                    $json_file_decoded = json_decode(file_get_contents(self::$json_filename), true);
                    // INSERTION
                    array_unshift($json_file_decoded, self::$data_to_be_inserted);
                    $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                    return file_put_contents(self::$json_filename, $json_file_encoded);
                } else {
                    $json_file_decoded = json_decode(file_get_contents(self::$json_filename), true);
                    // INSERTION
                    array_unshift($json_file_decoded, self::$data_to_be_inserted);
                    $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                    return file_put_contents(self::$json_filename, $json_file_encoded);
                }
            }
        } else {
            $check_if_the_file_extension_is_json = explode('.', self::$json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){
                echo "File extension error. It must be a .json file.";
            } else {
                file_put_contents(self::$json_filename, '[]');
                $json_file_decoded = json_decode(file_get_contents(self::$json_filename), true);
                // INSERTION
                array_unshift($json_file_decoded, self::$data_to_be_inserted);
                $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                return file_put_contents(self::$json_filename, $json_file_encoded);
            }
        }
    }

    // DELETE DATA TO JSON FILE

    public static function delete($json_filename, $data_key_to_be_deleted, $data_value_to_be_deleted){
        self::$json_filename = $json_filename;
        self::$data_key_to_be_deleted = $data_key_to_be_deleted;
        self::$data_value_to_be_deleted = $data_value_to_be_deleted;
        if(file_exists(self::$json_filename)){
            $check_if_the_file_extension_is_json = explode('.', self::$json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                echo "File extension error. It must be a .json file.";
            } else {
                $json_file_decoded = json_decode(file_get_contents(self::$json_filename), true);
                foreach ($json_file_decoded as $key => $value) {
                    if($value[self::$data_key_to_be_deleted] === self::$data_value_to_be_deleted){
                        // DELETION
                        array_splice($json_file_decoded, $key, 1);
                        $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                        return file_put_contents(self::$json_filename, $json_file_encoded);
                    }
                }
            }
        } else {
            echo "File doesn't exists or filename extension error";
        }
    }

    // UPDATE DATA TO JSON FILE

    public static function update($json_filename, $data_key_to_be_updated, $data_value_to_be_updated, $key_to_insert_new_updated_data, $new_updated_data){
        self::$json_filename = $json_filename;
        self::$data_key_to_be_updated = $data_key_to_be_updated;
        self::$data_value_to_be_updated = $data_value_to_be_updated;
        self::$key_to_insert_new_updated_data = $key_to_insert_new_updated_data;
        self::$new_updated_data = $new_updated_data;
        if(file_exists(self::$json_filename)){
            $check_if_the_file_extension_is_json = explode('.', self::$json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                echo "File extension error. It must be a .json file.";
            } else {
                $json_file_decoded = json_decode(file_get_contents(self::$json_filename), true);
                foreach ($json_file_decoded as $key => $value) {
                    if($value[self::$data_key_to_be_updated] === self::$data_value_to_be_updated){
                        // UPDATION
                        $json_file_decoded[$key][self::$key_to_insert_new_updated_data] = self::$new_updated_data;
                        $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                        return file_put_contents(self::$json_filename, $json_file_encoded);
                    }
                }
            }
        } else {
            echo "File doesn't exists or filename extension error";
        }
    }
}