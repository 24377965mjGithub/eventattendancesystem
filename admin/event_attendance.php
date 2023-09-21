<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Admin Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

?>

<!-- This is the default home page -->

<section class="info">
    <div class="container">
        <?php
            $getEvent = query("SELECT * FROM events WHERE status = 'Happening now'");
            while ($getEvent_ = fetch($getEvent)) {
                ?>
                    <h3 class="mont">Event Attendance: Current (<?php echo $getEvent_['event_name']?>)</h3>
                <?php
            }
        ?>
        <a href="./Auth/logout.php">
            <button class="btn btn-danger">Logout as Admin</button>
        </a>
    </div>
</section>

<section class="staffs">
    <div class="container">
        <h3 class="mont">Attendance:</h3>

        <!-- filter search -->
        <div class="form-group">
            <input type="text" class="form-control search" placeholder="Search for events, students or dates...">
        </div>

        <?php
            $events = query("SELECT * FROM ongoing_events  ORDER BY id DESC");
            while ($events_ = fetch($events)) {
                $studid = $events_['student_id'];
                $eventid = $events_['event_id'];
                ?>
                    <div class="row student">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <?php
                                $getStudent = query("SELECT * FROM students WHERE student_id = $studid");
                                while ($getStudent_ = fetch($getStudent)) {
                                    ?>
                                    
                                        <a href="../Uploads/Profile/<?php echo $getStudent_['profilepic']?>">
                                            <img src="../Uploads/Profile/<?php echo $getStudent_['profilepic']?>" alt="">
                                        </a>
                                        <p>
                                            <b><?php echo $getStudent_['firstname']." ".$getStudent_['lastname']?></b>
                                        </p>
                                        <p>
                                            <b class="mont">Course: <span class="red"><?php echo $getStudent_['course']?></span></b><br>
                                            <b class="mont">Level: <span class="red"><?php echo $getStudent_['level']?></span></b><br>
                                            <b class="mont">Address: <span class="red"><?php echo $getStudent_['address']?></span></b>
                                        </p>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <?php
                                
                                $getCurrentEvent = query("SELECT * FROM events WHERE id = $eventid");
                                while ($getCurrentEvent_ = fetch($getCurrentEvent)) {
                                    ?>
                                        <p>
                                            <b><?php echo $getCurrentEvent_['event_name']?></b><br>
                                            <b><?php echo $getCurrentEvent_['date']?></b><br>
                                            <i>Time In: <?php echo $events_['timein']?></i><br>
                                            <i>Time Out: <?php echo $events_['timeout']?></i><br>
                                        </p>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 icons">
                            <p>
                                <b class="mont">PRESENT/ATTENDED</b>
                            </p>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</section>

<?php
include './Includes/foot.php';