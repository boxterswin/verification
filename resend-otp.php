<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <style>
        .nav-bar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .title {
            margin: 0;
        }

        .form {
            margin-top: 50px;
            text-align: center;
        }

        .form input {
            width: 300px;
        }

        .first {
            width: 50%;
            margin: auto;
        }

        .float-left1 {
            float: left;
        }
    </style>
</head>

<body>
    <div class="nav-bar">
        <div class="title">
            <h3>Welcome to coer library</h3>
        </div>
    </div>

    <?php
    session_start();
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);
    $from = "gaglanijeet@gmail.com";
    $to = $_SESSION["Email"];
    $subject = "verify-account-otp";
    $otp = rand(100000, 999999);
    $message = strval($otp);
    $headers = "From:" . $from;

    // PHPMailer autoloader
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gaglanijeet@gmail.com';
    $mail->Password = 'hvthptqfwjnadkbq';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('gaglanijeet@gmail.com', 'Your Name');
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        $_SESSION["OTP"] = $otp;
        header("Location: verify-otp.php");
        exit;
    } else {
        echo ("mail send failed");
    }

    ?>

    <div class="form">
        <form action="register.php" method="POST">
            <label><b>Register To MY website</b></label>
            <hr class="first">
            <label><b>Coer-ID</b></label>
            <input type="text" name="Coer-ID" placeholder="Coer-ID" required id="Coer-ID" class="float-left1">
            <br><br>

            <label><b>Email</b></label>
            <input type="email" name="Email" placeholder="Email" required id="Email" class="float-left1">
            <br><br>

            <label><b>Password </b> </label>
            <input type="password" name="Password" placeholder="Password" required id="Password" class="float-left1">
            <br><br>

            <label><b>RePassword </b> </label>
            <input type="password" name="RePassword" placeholder=" Re Type Password" required id="Repassword"
                class="float-left1">
            <br><br>

            <button type="submit" name="login" value="login" id="register-button">
                Create Account
            </button>
            <br><br>
        </form>
    </div>
</body>

</html>
