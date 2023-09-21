<?php
$title = "Generate Report";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

?>

<section class="staffs">
<div class="container">
    <h4 class="mont">Generate Report</h4>
    <!-- filter search -->
    <div class="form-group">
                        <input type="text" class="form-control search" placeholder="Search for events and or dates...">
                    </div>
<?php
            $events = query("SELECT * FROM events ORDER BY id DESC");
            while ($events_ = fetch($events)) {
                ?>
                    <div class="row staff">
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
                            <a href="./_backend_generate_excel.php?report=<?php echo $events_['id']?>">
                                <button class="btn btn-success">Export as Excel</button>
                            </a>
                        </div>
                    </div>
                <?php
            }
        ?>
</div>
</section>

<?php

include './Includes/foot.php';