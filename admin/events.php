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
                        $countEvents = query("SELECT * FROM events");
                        $countEvents_ = counter($countEvents);
                    ?>
        <h3 class="mont">Events <span class="red"><?php echo $countEvents_?></span></h3>
        <a href="./Auth/logout.php">
            <button class="btn btn-danger">Logout as Admin</button>
        </a>
    </div>
</section>

<section class="staffs">
    <div class="container">
        <h3 class="mont">Events:</h3>

        <!-- filter search -->
        <div class="form-group">
            <input type="text" class="form-control search" placeholder="Search for events, event status, etc...">
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
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</section>

<?php
include './Includes/foot.php';