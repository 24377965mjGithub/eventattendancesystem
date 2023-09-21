<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Student Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

?>

<!-- This is the default home page -->

<section class="info">
    <div class="container">
        <?php
            $getUser = query("SELECT * FROM students WHERE id = $id");
            while ($getUser_ = fetch($getUser)) {
                ?>
                
                    <img src="./Uploads/Profile/<?php echo $getUser_['profilepic']?>" alt="" data-toggle="modal" data-target="#uploadprofile">
                    <h3 class="mont">Hi, <?php echo $getUser_['firstname']?>!</h3>
                    <button class="btn btn-warning generateqrcode" qrcodevalue="<?php echo $getUser_['student_id']?>" data-toggle="modal" data-target="#qrgen">Generate QR Code</button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#editprofile">Change Info</button>
                    <a href="./Auth/logout.php">
                        <button class="btn btn-danger">Logout</button>
                    </a>
                    <p class="mont currenttoday">Today is <span class="datetime"></span></p>
            
                    <!-- filter search -->
                    <div class="form-group">
                        <input type="text" class="form-control search" placeholder="Search for events, attended or not attended...">
                    </div>


                    <!-- qr code modal -->
            
                            <!-- The Modal -->
                    <div class="modal fade" id="qrgen">
                        <div class="modal-dialog">
                            <div class="modal-content">
            
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title qrcodetitle"></h4>
                                <button type="button" class="close delqrcode" data-dismiss="modal">&times;</button>
                            </div>
            
                            <!-- Modal body -->
                            <div class="modal-body qrcodegenerated">
                                <div class="spinner-border loadinggen"></div>
                                <div class="generatedqrcode"></div>
                            </div>
            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger delqrcode" data-dismiss="modal">Close</button>
                            </div>
            
                            </div>
                        </div>
                    </div>

                    <!-- profilepic modal -->
            
                    <!-- The Modal -->
                    <div class="modal fade" id="uploadprofile">
                        <div class="modal-dialog">
                            <div class="modal-content">
            
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Upload Profile Picture</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
            
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="./_backend_update_profile.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="file" name="profile" id="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">Upload</button>
                                    </div>
                                </form>
                            </div>
            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger delqrcode" data-dismiss="modal">Close</button>
                            </div>
            
                            </div>
                        </div>
                    </div>

                    <!-- info modal -->
            
                    <!-- The Modal -->
                    <div class="modal fade" id="editprofile">
                        <div class="modal-dialog">
                            <div class="modal-content">
            
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Your Profile Info</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
            
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="./_backend_profile_info.php" method="post">
                                    <div class="form-group">
                                        <label for="" class="mont">Firstname</label>
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name:" value="<?php echo $getUser_['firstname']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mont">Lastname</label>
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name:" value="<?php echo $getUser_['lastname']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mont">Course</label>
                                        <input type="text" class="form-control" name="course" placeholder="Course:" value="<?php echo $getUser_['course']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mont">Level</label>
                                        <input type="text" class="form-control" name="level" placeholder="Level:" value="<?php echo $getUser_['level']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mont">Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Address:" value="<?php echo $getUser_['address']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mont">Phone Number</label>
                                        <input type="number" class="form-control" name="phone" placeholder="Phone Number:" value="<?php echo $getUser_['phonenumber']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mont">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email:" value="<?php echo $getUser_['email']?>">
                                    </div>

                                    <div class="form-btn">
                                        <button type="submit" name="submit" class="btn btn-info formbtn">Update</button>
                                    </div>
                                </form>
                            </div>
            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
            
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</section>

<section class="eventlist">
    <div class="container">
        <h2 class="mont">Here are the lists of events.</h2>
            <?php
                $all_events_finished = query("SELECT * FROM events WHERE status = 'Finished' OR status='Happening now'");
                while ($all_events_finished_ = fetch($all_events_finished)) {
                    // see if attended
                    $eventid = $all_events_finished_['id'];
                    // get stdent id
                    $studentid = query("SELECT * FROM students WHERE id = $id");
                    while ($studentid_ = fetch($studentid)) {
                        $current_student_id = $studentid_['student_id'];
                    }

                    $all_events_attend = query("SELECT * FROM ongoing_events WHERE event_id = $eventid AND student_id = $current_student_id");
                    
                    if (counter($all_events_attend) === 0) {
                        ?>
                        <div class="event">
                            <div class="row">
                                <div class="col-4">
                                    <p class="mont"><b><?php echo $all_events_finished_['date']?></b></p>
                                </div>
                                <div class="col-4">
                                    <p><?php echo $all_events_finished_['event_name']?></p>
                                </div>
                                <div class="col-4">
                                    <p class="red"><i class="fa fa-times"></i> Not Attended</p>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                            <div class="event">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="mont"><b><?php echo $all_events_finished_['date']?></b></p>
                                    </div>
                                    <div class="col-4">
                                        <p><?php echo $all_events_finished_['event_name']?></p>
                                    </div>
                                    <div class="col-4">
                                        <p class="green"><i class="fa fa-check"></i> Attended</p>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    
                }
                $all_events = query("SELECT * FROM events WHERE status = 'Not Happening'");
                while ($all_events_ = fetch($all_events)) {
                    ?>
                        <div class="event">
                            <div class="row">
                                <div class="col-4">
                                    <p class="mont"><b><?php echo $all_events_['date']?></b></p>
                                </div>
                                <div class="col-4">
                                    <p><?php echo $all_events_['event_name']?></p>
                                </div>
                                <div class="col-4">
                                    <p class="yellow"><i class="fa fa-clock"></i> Not Happening</p>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>

        <!-- <div class="event">
            <div class="row">
                <div class="col-4">
                    <p class="mont"><b>June 12, 2023</b></p>
                </div>
                <div class="col-4">
                    <p>Alumni</p>
                </div>
                <div class="col-4">
                    <p class="green"><i class="fa fa-check"></i> Attended</p>
                </div>
            </div>
        </div>

        <div class="event">
            <div class="row">
                <div class="col-4">
                    <p class="mont"><b>June 12, 2023</b></p>
                </div>
                <div class="col-4">
                    <p>Alumni</p>
                </div>
                <div class="col-4">
                    <p class="green"><i class="fa fa-check"></i> Attended</p>
                </div>
            </div>
        </div>

        <div class="event">
            <div class="row">
                <div class="col-4">
                    <p class="mont"><b>June 12, 2023</b></p>
                </div>
                <div class="col-4">
                    <p>Alumni</p>
                </div>
                <div class="col-4">
                    <p class="green"><i class="fa fa-check"></i> Attended</p>
                </div>
            </div>
        </div>

        <div class="event">
            <div class="row">
                <div class="col-4">
                    <p class="mont"><b>June 12, 2023</b></p>
                </div>
                <div class="col-4">
                    <p>Alumni</p>
                </div>
                <div class="col-4">
                    <p class="red"><i class="fa fa-check"></i> Not Attended</p>
                </div>
            </div>
        </div>

        <div class="event">
            <div class="row">
                <div class="col-4">
                    <p class="mont"><b>June 12, 2023</b></p>
                </div>
                <div class="col-4">
                    <p>Alumni</p>
                </div>
                <div class="col-4">
                    <p class="yellow"><i class="fa fa-clock"></i> Not Happening</p>
                </div>
            </div>
        </div>

        <div class="event">
            <div class="row">
                <div class="col-4">
                    <p class="mont"><b>June 12, 2023</b></p>
                </div>
                <div class="col-4">
                    <p>Alumni</p>
                </div>
                <div class="col-4">
                    <p class="yellow"><i class="fa fa-clock"></i> Not Happening</p>
                </div>
            </div>
        </div> -->

    </div>
</section>

<?php
include './Includes/foot.php';