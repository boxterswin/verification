<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In</title>

    
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

        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="nav-bar">
        <div class="title">
            <h3>Welcome to my website</h3>
        </div>
    </div>

    <div class="container">
        <div class="alert alert-success" role="alert">
            Logged in successfully! Redirecting to home page...
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                window.location.replace("profile.php");
            }, 3000);
        });
    </script>
</body>

</html>
