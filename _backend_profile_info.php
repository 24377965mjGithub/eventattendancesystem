<?php
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Student Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

                        $firstname = $_POST["firstname"];
                        $lastname = $_POST["lastname"];
                        $course = $_POST["course"];
                        $level = $_POST["level"];
                        $address = $_POST["address"];
                        $phonenumber = $_POST["phone"];
                        $email = $_POST["email"];
                        $profilepic = 'profile.jpg';
                        $status = 'waiting for approval';

                        $errors = array();
                        
                        if (empty($email)) {
                            array_push($errors,"All fields are required");
                        }
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            array_push($errors, "Email is not valid");
                        }
                 
                        if (count($errors)>0) {
                            foreach ($errors as  $error) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        }else{

                            // $sql = "INSERT INTO students (student_id, firstname, lastname, course, level, address, phonenumber, email, profilepic, status) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
                            // $stmt = mysqli_stmt_init($conn);
                            // $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                            // if ($prepareStmt) {
                            //     mysqli_stmt_bind_param($stmt,"ssssssssss",$studentID, $firstname, $lastname, $course, $level, $address, $phonenumber, $email, $profilepic, $status);
                            //     mysqli_stmt_execute($stmt);
                            //     echo "<div class='alert alert-success'>You are registered successfully. Please wait for Admin's approval to validate your account.</div>";
                            // }else{
                            //     die("Something went wrong");
                            // }

                            if (query("UPDATE students SET firstname = '$firstname', lastname = '$lastname', course = '$course', level = '$level', address = '$address', phonenumber = '$phonenumber', email = '$email' WHERE id = $id")) {
                                header ('location: ./index.php');
                            }
                        }

include './Includes/foot.php';