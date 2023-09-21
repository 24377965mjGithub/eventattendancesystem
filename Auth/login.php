<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../Libraries/Bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../Libraries/Bootstrap/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../Libraries/Bootstrap/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="../Libraries/Font_Awesome/css/all.min.css">
    <link rel="stylesheet" href="../Libraries/Font_Awesome/css/brands.min.css">
    <link rel="stylesheet" href="../Libraries/Font_Awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../Libraries/Font_Awesome/css/regular.min.css">
    <link rel="stylesheet" href="../Libraries/Font_Awesome/css/solid.min.css">
    <link rel="stylesheet" href="../Libraries/Font_Awesome/css/svg-with-js.min.css">
    <link rel="stylesheet" href="../Libraries/Font_Awesome/css/v4-shims.min.css">
    <!-- aos -->
    <link rel="stylesheet" href="./aos-master/dist/aos.css">
    <link rel="stylesheet" href="../Libraries/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h1>Event Attendance System</h1>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 menus">
                    <ul>
                        <a href="./login.php" class="active mont">
                            <li>Home</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
        <?php
                        if (isset($_POST["submit"])) {
                        $studentID = $_POST["studentid"];
                        $firstname = $_POST["firstname"];
                        $lastname = $_POST["lastname"];
                        $course = $_POST["course"];
                        $level = $_POST["level"];
                        $address = $_POST["address"];
                        $phonenumber = $_POST["phone"];
                        $email = $_POST["email"];
                        $profilepic = 'profile.jpg';
                        $status = 'waiting for approval';

                        $errors = array();
                        
                        if (empty($email)) {
                            array_push($errors,"All fields are required");
                        }
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            array_push($errors, "Email is not valid");
                        }

                        require_once "database.php";
                        $sql = "SELECT * FROM students WHERE student_id = $studentID";
                        $result = mysqli_query($conn, $sql);
                        $rowCount = mysqli_num_rows($result);
                        if ($rowCount>0) {
                            array_push($errors,"Student ID already exists!");
                        }

                        
                        if (count($errors)>0) {
                            foreach ($errors as  $error) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        }else{

                            $sql = "INSERT INTO students (student_id, firstname, lastname, course, level, address, phonenumber, email, profilepic, status) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
                            $stmt = mysqli_stmt_init($conn);
                            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                            if ($prepareStmt) {
                                mysqli_stmt_bind_param($stmt,"ssssssssss",$studentID, $firstname, $lastname, $course, $level, $address, $phonenumber, $email, $profilepic, $status);
                                mysqli_stmt_execute($stmt);
                                echo "<div class='alert alert-success'>You are registered successfully. Please wait for Admin's approval to validate your account.</div>";
                            }else{
                                die("Something went wrong");
                            }
                        }
                        }
                        ?>

<?php
                            if (isset($_POST["login"])) {
                            $email = $_POST["email"];
                            $student_id = $_POST["studentid"];
                                require_once "database.php";
                                $sql = "SELECT * FROM students WHERE email = '$email'";
                                $result = mysqli_query($conn, $sql);

                                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                if ($user) {
                                    if ($user["status"] === "waiting for approval") {
                                        echo "<div class='alert alert-success'>Please wait for Admin's approval to validate your account.</div>";
                                        die();
                                    } else if ($student_id === $user["student_id"] ) {
                                        session_start();
                                        $user_query = "SELECT * FROM students WHERE student_id = '$student_id'";
                                        $user_queried = mysqli_query($conn, $user_query);
                                        while ($user_q = mysqli_fetch_assoc($user_queried)) {
                                            $_SESSION['id'] = $user_q['id'];
                                            $_SESSION["user"] = "yes";
                                            header("Location: ../index.php");
                                        }
                                        die();
                                    }else{
                                        echo "<div class='alert alert-danger'>Password does not match</div>";
                                    }
                                }else{
                                    echo "<div class='alert alert-danger'>Email does not match</div>";
                                }
                            }
                            ?>

            <div class="row">
                <?php
                    require_once "database.php";
                    $current_event = mysqli_query($conn, "SELECT * FROM events WHERE status = 'Happening now'");
                    if (mysqli_num_rows($current_event) < 1) {
                        ?>
                            <div class="col-sm-12 col-md-6 col-lg-6 txt">
                                <h1 class="mont" data-aos="fade-right" data-aos-duration="1000">No event today <i class="fa fa-sad-tear"></i></h1>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 menus">
                            </div>
                        <?php
                    } else {
                        while ($current_event_ = mysqli_fetch_assoc($current_event)) {
                            ?>
                                <div class="col-sm-12 col-md-6 col-lg-6 txt">
                                    <h1 class="mont" data-aos="fade-right" data-aos-duration="1000">Wanna attend on <?php echo $current_event_['event_name']?>? <span class="red">Scan your QR Code Now!</span> <i class="fa fa-grin-stars"></i></h1>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 menus">
                                    <div class="user">
                                        <div class="loading">
                                            <h3 class="mont">Please wait...</h3>
                                            <div class="spinner-border" style="width: 100px; height: 100px; margin: auto !important"></div>
                                        </div>
                                        <div class="reveal"></div>
                                    </div>
                                    <div class="qrcodedetector" data-aos="fade-left" data-aos-duration="2000">
                                        <video id="qr-video"></video>
                                        <br>
                                            <b>Detected QR code: </b>
                                            <span id="cam-qr-result">None</span>
                                        <b>Last detected at: </b>
                                        <span id="cam-qr-result-timestamp"></span>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>
    </section>

    <section class="forms">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 welcome">
                    <h2 class="mont" data-aos="fade-right" data-aos-duration="1000">Welcome to Our Event Attendance System</h2>
                    <p data-aos="fade-up" data-aos-duration="1000">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga officiis aliquid aliquam perferendis doloribus maxime blanditiis exercitationem, accusantium velit ad labore eius, delectus ipsa sint quisquam rerum? Velit, nihil labore?</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="formcontainer" data-aos="fade-right" data-aos-duration="1000">
                       
                        <form action="login.php" method="post">
                            <h2 class="mont">Student Dashboard</h2>
                            <div class="form-group">
                                <label for="" class="mont">Student Email</label>
                                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class="mont">Student ID Number</label>
                                <input type="number" placeholder="Enter Student ID:" name="studentid" class="form-control">
                            </div>
                            <div class="form-btn">
                                <button type="submit" name="login" class="btn btn-info formbtn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="formcontainer" data-aos="fade-left" data-aos-duration="1000">
                        <form action="login.php" method="post">
                            <h2 class="mont">Student Registration</h2>
                            <div class="form-group">
                                <label for="" class="mont">Student ID</label>
                                <input type="number" class="form-control" name="studentid" placeholder="Student ID:">
                            </div>
                            <div class="form-group">
                                <label for="" class="mont">Firstname</label>
                                <input type="text" class="form-control" name="firstname" placeholder="First Name:">
                            </div>
                            <div class="form-group">
                                <label for="" class="mont">Lastname</label>
                                <input type="text" class="form-control" name="lastname" placeholder="Last Name:">
                            </div>
                            <div class="form-group">
                                <label for="" class="mont">Course</label>
                                <input type="text" class="form-control" name="course" placeholder="Course:">
                            </div>
                            <div class="form-group">
                                <label for="" class="mont">Level</label>
                                <input type="text" class="form-control" name="level" placeholder="Level:">
                            </div>
                            <div class="form-group">
                                <label for="" class="mont">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Address:">
                            </div>
                            <div class="form-group">
                                <label for="" class="mont">Phone Number</label>
                                <input type="number" class="form-control" name="phone" placeholder="Phone Number:">
                            </div>
                            <div class="form-group">
                                <label for="" class="mont">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email:">
                            </div>

                            <div class="form-btn">
                                <button type="submit" name="submit" class="btn btn-info formbtn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>Event Attendance System Copyright 2023</p>
        </div>
    </footer>

    <script src="../Libraries/JQuery/jquery.js"></script>
    <script src="./aos-master/dist/aos.js"></script>
        <script src="../Libraries/Default/Timestamp.js"></script>
        <script src="../Libraries/Default/LocalStorage.js"></script>

    <script>

        AOS.init();
        setInterval(() => {
            
            result_ = document.getElementById("cam-qr-result").innerText;

            if (result_ === "No QR code found" || result_ === "None") {
                $('.reveal').hide() // reveal hide
                $('.qrcodedetector').show();  // detector show
                $('.loading').hide(); // loading hide
            } else {
                $('.qrcodedetector').hide();
                $('.loading').show();
                $.post('../_backend_attend.php', {
                    student_id: result_,
                    date: complete_date(),
                    time: complete_time()
                }, function(data) {
                    $('.loading').hide();

                    console.log(JSON.parse(data)[0].firstname);

                    // if time in
                    if (JSON.parse(data)[0].qrcodestats === "timein") {
                        $('.reveal').show().html(`
                            <img src="../Uploads/Profile/${JSON.parse(data)[0].profilepic}" alt=""><br>
                            <h2 class="mont">${JSON.parse(data)[0].firstname} ${JSON.parse(data)[0].lastname}</h2>
                            <h1>Congratulations! you have now TIMED IN on this event</h1>
                        `);
                    } else if (JSON.parse(data)[0].qrcodestats === "finished") {
                        $('.reveal').show().html(`
                            <img src="../Uploads/Profile/${JSON.parse(data)[0].profilepic}" alt=""><br>
                            <h2 class="mont">${JSON.parse(data)[0].firstname} ${JSON.parse(data)[0].lastname}</h2>
                            <h1>You have finished this event.</h1>
                        `);
                    } else {
                        $('.reveal').show().html(`
                            <img src="../Uploads/Profile/${JSON.parse(data)[0].profilepic}" alt=""><br>
                            <h2 class="mont">${JSON.parse(data)[0].firstname} ${JSON.parse(data)[0].lastname}</h2>
                            <h1>Thank you! you have now TIMED OUT on this event</h1>
                        `);
                    }
                    
                    console.log(data);
                })
            }
        }, 3000);


    </script>
    <script type="module">
        import QrScanner from "./qrcodescanner/qr-scanner.min.js";
        QrScanner.WORKER_PATH = './qrcodescanner/qr-scanner-worker.min.js';

        const video = document.getElementById('qr-video');
        const camHasCamera = document.getElementById('cam-has-camera');
        const camList = document.getElementById('cam-list');
        const camHasFlash = document.getElementById('cam-has-flash');
        const flashToggle = document.getElementById('flash-toggle');
        const flashState = document.getElementById('flash-state');
        const camQrResult = document.getElementById('cam-qr-result');
        const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
        const fileSelector = document.getElementById('file-selector');
        const fileQrResult = document.getElementById('file-qr-result');

        function setResult(label, result) {
            label.textContent = result;
            camQrResultTimestamp.textContent = complete_date() + " " + complete_time();
            label.style.color = 'teal';
            clearTimeout(label.highlightTimeout);
            label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
        }

        // ####### Web Cam Scanning #######

        const scanner = new QrScanner(video, result => setResult(camQrResult, result), error => {
            camQrResult.textContent = error;
            camQrResult.style.color = 'inherit';
        });

        const updateFlashAvailability = () => {
            scanner.hasFlash().then(hasFlash => {
                camHasFlash.textContent = hasFlash;
                flashToggle.style.display = hasFlash ? 'inline-block' : 'none';
            });
        };

        scanner.start().then(() => {
            updateFlashAvailability();
            // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
            // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
            // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
            // start the scanner earlier.
            QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
                const option = document.createElement('option');
                option.value = camera.id;
                option.text = camera.label;
                camList.add(option);
            }));
        });

        QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

        // for debugging
        window.scanner = scanner;

        document.getElementById('show-scan-region').addEventListener('change', (e) => {
            const input = e.target;
            const label = input.parentNode;
            label.parentNode.insertBefore(scanner.$canvas, label.nextSibling);
            scanner.$canvas.style.display = input.checked ? 'block' : 'none';
        });

        document.getElementById('inversion-mode-select').addEventListener('change', event => {
            scanner.setInversionMode(event.target.value);
        });

        camList.addEventListener('change', event => {
            scanner.setCamera(event.target.value).then(updateFlashAvailability);
        });

        flashToggle.addEventListener('click', () => {
            scanner.toggleFlash().then(() => flashState.textContent = scanner.isFlashOn() ? 'on' : 'off');
        });

        document.getElementById('start-button').addEventListener('click', () => {
            scanner.start();
        });

        document.getElementById('stop-button').addEventListener('click', () => {
            scanner.stop();
        });

        // ####### File Scanning #######

        fileSelector.addEventListener('change', event => {
            const file = fileSelector.files[0];
            if (!file) {
                return;
            }
            QrScanner.scanImage(file)
                .then(result => setResult(fileQrResult, result))
                .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
        });

        

    </script>
</body>
</html>