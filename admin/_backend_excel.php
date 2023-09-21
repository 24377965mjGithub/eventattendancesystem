<?php
$title = "Installation";
include './Includes/head.php';
include './Libraries/all.php';
include './Libraries/query.php';

header('Content-Type: application/xls');
header('Content-Disposition: attachment;filename=report.xls');

?>
<table style="width:100%">
  <tr>
    <th>ID</th>
    <th>Title</th>
    <th>File</th>
    <th>Caption</th>
    <th>Status</th>
    <th>User</th>
  </tr>
  <?php
    $thevoicepost = query('SELECT * FROM post');
    while ($thevoicepost_ = fetch($thevoicepost)) {
        ?>
            <tr>
                <td><?php echo $thevoicepost_['id']?></td>
                <td><?php echo $thevoicepost_['title']?></td>
                <td><?php echo $thevoicepost_['file']?></td>
                <td><?php echo $thevoicepost_['caption']?></td>
                <td><?php echo $thevoicepost_['status']?></td>
                <td><?php echo $thevoicepost_['user']?></td>
            </tr>
        <?php
    }
  ?>
</table>
<?php

include './Includes/foot.php';