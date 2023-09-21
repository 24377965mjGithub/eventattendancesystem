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
                        $countStudents_wait = query("SELECT * FROM students WHERE status = 'waiting for approval'");
                        $countStudents_wait_ = counter($countStudents_wait);
                    ?>
        <h3 class="mont">Incoming Accounts <span class="red"><?php echo $countStudents_wait_?></span></h3>
        <a href="./Auth/logout.php">
            <button class="btn btn-danger">Logout as Admin</button>
        </a>
    </div>
</section>

<section class="staffs">
    <div class="container">
        <h3 class="mont">List of students who registered (waiting for admin's approval):</h3>

        <!-- filter search -->
        <div class="form-group">
            <input type="text" class="form-control search" placeholder="Search for students, courses or levels...">
        </div>

        <?php
            $students = query("SELECT * FROM students WHERE status = 'waiting for approval' ORDER BY id DESC");
            while ($students_ = fetch($students)) {
                ?>
                    <div class="row student">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <img src="../Uploads/Profile/<?php echo $students_['profilepic']?>" alt="">
                            <p>
                                <b><?php echo $students_['firstname']." ".$students_['lastname']?></b>
                            </p>
                            <p>
                                <b class="mont">Course: <span class="red"><?php echo $students_['course']?></span></b><br>
                                <b class="mont">Level: <span class="red"><?php echo $students_['level']?></span></b><br>
                                <b class="mont">Address: <span class="red"><?php echo $students_['address']?></span></b>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <p>
                                <b><?php echo $students_['email']?></b>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <p>
                                <b><?php echo $students_['phonenumber']?></b>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 icons">
                            <i class="fa fa-thumbs-up" data-toggle="modal" data-target="#approve<?php echo $students_['id']?>student"></i>
                            <i class="fa fa-trash" data-toggle="modal" data-target="#del<?php echo $students_['id']?>student"></i>

                            <!-- The Modal -->
                            <div class="modal fade" id="approve<?php echo $students_['id']?>student">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Approve this Student?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <a href="./_backend_approve_student.php?student=<?php echo $students_['id']?>">
                                            <button class="btn btn-success">Yes</button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                    </div>
                                </div>
                            </div>

                            <!-- The Modal -->
                            <div class="modal fade" id="del<?php echo $students_['id']?>student">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete Account?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h6 class="mont">Are you sure you want to remove this account?<br>This action cannot be undone.</h6>
                                        <a href="./_backend_remove_student.php?remove=<?php echo $students_['id']?>">
                                            <button class="btn btn-danger">Yes, Remove this account</button>
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