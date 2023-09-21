<?php

include './Libraries/all.php';
include './Libraries/query.php';

$reportid = $_REQUEST['report'];

$getEventDetails = query("SELECT * FROM events WHERE id = $reportid");
while ($getEventDetails_ = fetch($getEventDetails)) {
    $getEventName = $getEventDetails_['event_name'];
    $getEventDate = $getEventDetails_['date'];
}


header('Content-Type: application/xls');
header('Content-Disposition: attachment;filename='.$getEventName.'.xls');

?>
<table style="width:100%" border="1">
  <tr>
    <th>ID</th>
    <th>Student ID</th>
    <th>Student Name</th>
    <th>Student Course</th>
    <th>Student Level</th>
    <th>Date</th>
    <th>Time-In</th>
    <th>Time-Out</th>
    <th>Status</th>
  </tr>
  <?php
    $event = query("SELECT * FROM ongoing_events WHERE event_id = $reportid");
    while ($event_ = fetch($event)) {
        $studentDetailsId = $event_['student_id'];
        $getstudentDetails = query("SELECT * FROM students WHERE id = $studentDetailsId");
        while ($getstudentDetails_ = fetch($getstudentDetails)) {
            ?>
                <tr>
                    <td><?php echo $event_['id']?></td>
                    <td><?php echo $getstudentDetails_['student_id']?></td>
                    <td><?php echo $getstudentDetails_['firstname']." ".$getstudentDetails_['lastname']?></td>
                    <td><?php echo $getstudentDetails_['course']?></td>
                    <td><?php echo $getstudentDetails_['level']?></td>
                    <td><?php echo $event_['date']?></td>
                    <td><?php echo $event_['timein']?></td>
                    <td><?php echo $event_['timeout']?></td>
                    <td>Present</td>
                </tr>
            <?php
        }
    }
  ?>
</table>
<?php