<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login Form</title>
    <link rel="stylesheet" href="../Libraries/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $phone = $_POST["phone"];
            require_once "database.php";
            $sql = "SELECT * FROM staff WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if ($user["phonenumber"] === $phone) {
                    session_start();
                    $user_query = "SELECT * FROM staff WHERE email = '$email'";
                    $user_queried = mysqli_query($conn, $user_query);
                    while ($user_q = mysqli_fetch_assoc($user_queried)) {
                        $_SESSION['id'] = $user_q['id'];
                        $_SESSION["user"] = "yes";
                        header("Location: ../index.php");
                    }
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Phone number does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
      <form action="login.php" method="post">
        <h1>Staff</h1>
        <div class="form-group">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="number" placeholder="Enter Phone Number:" name="phone" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-danger">
        </div>
      </form>
    </div>
</body>
</html>