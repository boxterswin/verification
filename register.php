<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Adding Bootstrap -->
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
    </style>
</head>

<body>
    <div class="nav-bar">
        <div class="title">
            <h3>Welcome to my website</h3>
        </div>
    </div>

    <?php
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    session_start();
    if (!isset($_SESSION["OTP"])) {
        $_SESSION["OTP"] = ""; // Initialize OTP session variable
    }

    if (!isset($_SESSION["Email"])) {
        $_SESSION["Email"] = ""; // Initialize Email session variable
    }

    $otp = $_SESSION["OTP"];
    if (isset($_SESSION["logged-in"])) {
        header("Location:profile.php");
        exit; // Stop further execution
    }

    $username = "sign up";
    $login_btn = "Login";
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        $login_btn = "Logout";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $con = mysqli_connect('localhost','root','','usersdb');

        if (!$con) {
            echo ("failed to connect to database");
            exit; // Stop further execution
        }

        $username1 = $_POST['username'];
        $prefix = "_";
        $username = $prefix . $username1;
        $password = $_POST['Password'];
        $repassword = $_POST['RePassword'];
        $email1 = $_POST['Email'];
        $email = strval($email1);

        if ($password != $repassword) {
            echo ("<script>alert('password not matches')</script>");
        } else {
            if (strlen($password) < 8) {
                echo ("<script>alert('password length must be at least 8')</script>");
            } else {
                $query = "insert into users(username,email,password) 
                            values('$username','$email','$password')";

                $sql = "SELECT id,username, password FROM users";
                $result = $con->query($sql);
                $username_already_exist = false;
                $email_already_exist = false;

                // Checking if user already exists
                if (($result->num_rows) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row["username"] == $username) {
                            $username_already_exist = true;
                            break;
                        }
                        if ($row["email"] == $email) {
                            $email_already_exist = true;
                            break;
                        }
                    }
                }

                if ($username_already_exist == false) {
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'gaglanijeet@gmail.com';
                    $mail->Password = 'hvthptqfwjnadkbq';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('gaglanijeet@gmail.com', 'Your Name');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'verify-account-otp';
                    $otp = rand(100000, 999999);
                    $mail->Body = strval($otp);

                    if ($mail->send()) {
                        $_SESSION["username"] = $username;
                        $_SESSION["OTP"] = $otp;
                        $_SESSION["Email"] = $email;
                        $_SESSION["Password"] = $password;
                        $_SESSION["registration-going-on"] = "1";
                        header("Location:verify-otp.php");
                        exit; // Stop further execution
                    } else {
                        echo ("mail send failed");
                    }
                } else {
                    echo ("<script>alert('username already taken')</script>");
                }
            }
        }
    }
    ?>

    <form class="form-register" action="register.php" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp"
                placeholder="Username" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="Email" id="Email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="Password" id="Password" placeholder="Password"
                required>
        </div>
        <div class="form-group">
            <label>Re-enter Password</label>
            <input type="password" class="form-control" name="RePassword" id="RePassword" placeholder="Re-enter Password"
                required>
        </div>

        <button type="submit" class="btn btn-primary btn-lg">
            Register
        </button>

        <button type="button" class="btn btn-warning btn-lg" id="login-button">
            Already Registered
        </button>
    </form>

    <!-- Adding jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $("#login-button").click(function () {
            window.location.replace("index.php");
        }); 
    </script>
</body>

</html>
