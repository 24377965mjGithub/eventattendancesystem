<?php

// Core Functions

require './Libraries/Default/DatabaseConnection.php';
require './Libraries/Default/FileUpload.php';
require './Libraries/Default/JSONManipulation.php';
// require './Libraries/Default/TimeAgo.php';

// PHPMailer Classes

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;