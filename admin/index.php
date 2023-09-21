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
        <h3 class="mont">Hi, Admin!</h3>
        <a href="./Auth/logout.php">
            <button class="btn btn-danger">Logout as Admin</button>
        </a>
    </div>
</section>

<section class="boxes">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-4 col-md-4 box">
                <div data-aos="fade-left" data-aos-duration="1000">
                    <?php
                        $countStudents_app = query("SELECT * FROM students WHERE status = 'approved'");
                        $countStudents_app_ = counter($countStudents_app);
                    ?>
                    <h4 class="mont"><i class="fa fa-users"></i> Registered Students <span class="red"><?php echo $countStudents_app_?></span></h4>
                    <a href="./registered_accounts.php">
                        <button class="btn btn-info">Details</button>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 col-md-4 box">
                <div data-aos="fade-up" data-aos-duration="1500">
                    <?php
                        $countStudents_wait = query("SELECT * FROM students WHERE status = 'waiting for approval'");
                        $countStudents_wait_ = counter($countStudents_wait);
                    ?>
                    <h4 class="mont"><i class="fa fa-users"></i> Incoming Accounts <span class="red"><?php echo $countStudents_wait_?></span></h4>
                    <a href="./incoming_accounts.php">
                        <button class="btn btn-info">Details</button>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 col-md-4 box">
                <div data-aos="fade-right" data-aos-duration="2000">
                    <?php
                        $staffnumber = query("SELECT * FROM staff");
                        $countstaff = counter($staffnumber)
                    ?>
                    <h4 class="mont"><i class="fa fa-users"></i> Staffs <span class="red"><?php echo $countstaff?></span></h4>
                    <button class="btn btn-info" data-toggle="modal" data-target="#addstaff"><i class="fa fa-plus"></i> Add Staff</button>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 col-md-4 box">
                <div data-aos="fade-down" data-aos-duration="2500">
                    <h4 class="mont"><i class="fa fa-smile"></i> Event Attendance (NOW)</h4>
                    <a href="./event_attendance.php">
                        <button class="btn btn-info">Details</button>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 col-md-4 box">
                <div data-aos="flip-right" data-aos-duration="3000">
                    <?php
                        $countEvents = query("SELECT * FROM events");
                        $countEvents_ = counter($countEvents);
                    ?>
                    <h4 class="mont"><i class="fa fa-clock"></i> Events History <span class="red"><?php echo $countEvents_?></span></h4>
                    <a href="./events.php">
                        <button class="btn btn-info">Details</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="addstaff">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Staff</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="./_backend_addstaff.php" method="post">
                        <div class="form-group">
                            <input type="text" name="fullname" placeholder="Staff Fullname" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Staff Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="phonenumber" placeholder="Staff Phone Number" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-info"><i class="fa fa-plus"></i> Add</button>
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
    </div>
</section>

<section class="staffs">
    <div class="container">
        <h3 class="mont">Staff List:</h3>

        <!-- filter search -->
        <div class="form-group">
            <input type="text" class="form-control search" placeholder="Search for staff...">
        </div>

        <?php
            $staffs = query("SELECT * FROM staff ORDER BY id DESC");
            while ($staffs_ = fetch($staffs)) {
                ?>
                    <div class="row staff">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <p>
                                <b><?php echo $staffs_['fullname']?></b>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <p>
                                <b><?php echo $staffs_['email']?></b>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <p>
                                <b><?php echo $staffs_['phonenumber']?></b>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 icons">
                            <i class="fa fa-edit" data-toggle="modal" data-target="#edit<?php echo $staffs_['id']?>staff"></i>
                            <i class="fa fa-trash" data-toggle="modal" data-target="#del<?php echo $staffs_['id']?>staff"></i>

                            <!-- The Modal -->
                            <div class="modal fade" id="edit<?php echo $staffs_['id']?>staff">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Staff</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="./_backend_editstaff.php?staffid=<?php echo $staffs_['id']?>" method="post">
                                            <div class="form-group">
                                                <input type="text" name="fullname" placeholder="Staff Fullname" class="form-control" value="<?php echo $staffs_['fullname']?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Staff Email" class="form-control" value="<?php echo $staffs_['email']?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" name="phonenumber" placeholder="Staff Phone Number" class="form-control" value="<?php echo $staffs_['phonenumber']?>">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="form-control btn btn-info"><i class="fa fa-check"></i> Edit</button>
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

                            <!-- The Modal -->
                            <div class="modal fade" id="del<?php echo $staffs_['id']?>staff">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete Staff?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h6 class="mont">Are you sure you want to remove this staff?<br>This action cannot be undone.</h6>
                                        <a href="./_backend_remove_staff.php?remove=<?php echo $staffs_['id']?>">
                                            <button class="btn btn-danger">Yes, Remove this staff</button>
                                        </a>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</section>

<?php
include './Includes/foot.php';