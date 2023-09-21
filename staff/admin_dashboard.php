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

<header>
    <div class="container">
        Welcome
        <a href="./Auth/logout.php">Logout</a>
    </div>
</header>

<?php
include './Includes/foot.php';