<?php
// uncomment this code this app requires user authentication
require './Auth/auth.php';
$id = $_SESSION['id'];
$title = "Staff Dashboard";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

?>

<!-- This is the default home page -->

<section class="info">
    <div class="container">
        <?php
            $user = query("SELECT * FROM staff WHERE id = $id");
            while ($user_ = fetch($user)) {
                ?>
                    <h3 class="mont">Hi <?php echo $user_['fullname']?> - Staff</h3>
                <?php
            }
        ?>
        <button class="btn btn-info" data-toggle="modal" data-target="#addevent">Add Event</button>
        <a href="../reporting.php">
            <button class="btn btn-success">Generate Report</button>
        </a>
        <a href="./Auth/logout.php">
            <button class="btn btn-danger">Logout as Staff</button>
        </a>

                        <!-- The Modal -->
                        <div class="modal fade" id="addevent">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Event</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="./_backend_add_event.php" method="post">
                                            <div class="form-group">
                                                <label for="">Event Name</label>
                                                <input type="text" name="eventname" class="form-control" placeholder="Event Name: ">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Event Description</label>
                                                <input type="text" name="eventdesc" class="form-control" placeholder="Event Description: ">
                                            </div>
                                            <!-- date -->
                                            <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="">Month</label>
                                                        <select name="month" id="" class="form-control">
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="">Day</label>
                                                        <select name="day" id="" class="form-control">
                                                            <?php
                                                                for ($day=1; $day <= 31 ; $day++) {
                                                                    ?>
                                                                        <option value="<?php echo $day?>"><?php echo $day?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="">Year</label>
                                                        <select name="year" id="" class="form-control">
                                                            <?php
                                                                for ($year=2023; $year <=  2050; $year++) {
                                                                    ?>
                                                                        <option value="<?php echo $year?>"><?php echo $year?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- hour -->
                                            <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="">Hour</label>
                                                        <select name="hour" id="" class="form-control">
                                                            <?php
                                                                for ($hour=1; $hour <=  12; $hour++) {
                                                                    ?>
                                                                        <option value="<?php echo $hour?>"><?php echo $hour?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="">Minutes</label>
                                                        <select name="min" id="" class="form-control">
                                                            <option value="00">00</option>
                                                            <option value="01">01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <?php
                                                                for ($min=10; $min <=  59; $min++) {
                                                                    ?>
                                                                        <option value="<?php echo $min?>"><?php echo $min?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="">Session</label>
                                                        <select name="ampm" id="" class="form-control">
                                                            <option value="AM">AM</option>
                                                            <option value="PM">PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info">Create</button>
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
        <h3 class="mont">Events:</h3>

        <!-- filter search -->
        <div class="form-group">
                        <input type="text" class="form-control search" placeholder="Search for events...">
                    </div>

        <?php
            $events = query("SELECT * FROM events ORDER BY id DESC");
            while ($events_ = fetch($events)) {
                ?>
                    <div class="row student">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <p>
                                <b class="mont"><?php echo $events_['event_name']?></b><br>
                                <b class="mont"><?php echo $events_['date']?></b><br>
                                <?php echo $events_['eventdesc']?>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <p>
                                <?php
                                    if ($events_['status'] === "Not happening") {
                                        ?>
                                            <b class="mont nothappening"><?php echo $events_['status']?></b>
                                        <?php
                                    }
                                    if ($events_['status'] === "Happening now") {
                                        ?>
                                            <b class="mont happeningnow"><?php echo $events_['status']?></b><br>
                                            (currently recording attendance...)
                                        <?php
                                    }
                                    if ($events_['status'] === "Finished") {
                                        ?>
                                            <b class="mont finished"><?php echo $events_['status']?></b>
                                        <?php
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <b class="mont">Added <?php echo timeAgo($events_['timeago'])?></b>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3 icons">
                            <?php
                                    if ($events_['status'] === "Not happening") {
                                        ?>
                                            <a href="./_backend_happening_now.php?event=<?php echo $events_['id']?>">
                                                <button class="btn btn-success mark">Mark as "Happening Now"</button>
                                            </a>
                                            <a href="./_backend_remove_event.php?event=<?php echo $events_['id']?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        <?php
                                    }
                                    if ($events_['status'] === "Happening now") {
                                        ?>
                                            <a href="./_backend_not_happening.php?event=event=<?php echo $events_['id']?>">
                                                <button class="btn btn-warning mark">Mark as "Not Happening"</button>
                                            </a>
                                            <a href="./_backend_finished.php?event=<?php echo $events_['id']?>">
                                                <button class="btn btn-danger mark">Mark as "Finished"</button>
                                            </a>
                                            <a href="./_backend_remove_event.php?event=<?php echo $events_['id']?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        <?php
                                    }
                                    if ($events_['status'] === "Finished") {
                                        ?>
                                            <a href="./_backend_remove_event.php?event=<?php echo $events_['id']?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        <?php
                                    }
                            ?>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</section>

<?php
include './Includes/foot.php';