<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>

    
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
    </style>
</head>

<body>
    <div class="nav-bar">
        <div class="title">
            <h3>Welcome to my website</h3>
        </div>
    </div>

    <?php
    session_start();
    // Retrieving otp
    $otp = $_SESSION["OTP"];
    ?>

    <form class="form-login">
        <div class="form-group">
            <input type="text" class="form-control" name="otp" id="OTP" aria-describedby="emailHelp"
                placeholder="Enter OTP" required>
        </div>

        <button type="button" class="btn btn-primary btn-lg" id="verify-otp">
            Verify OTP
        </button>
    </form>

    <!--jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $("#verify-otp").click(function () {
                var otp1 = $("#OTP").val();
                var otp2 = "<?php echo $otp; ?>";

                if (otp1 == otp2) {
                    window.location.replace("logged-in.php");
                } else {
                    alert("OTP does not match");
                }
            });
        });
    </script>
</body>

</html>
