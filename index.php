<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login</title> 

     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 

    <style> 
        .nav-bar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .form-login {
            max-width: 400px;
            margin: 0 auto;
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
        <form class="form-login" action="index.php" method="POST"> 
            <div class="form-group"> 
                <label for="username">Username</label> 
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required> 
            </div> 

            <div class="form-group"> 
                <label for="Password">Password</label> 
                <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" required> 
            </div> 

            <button type="submit" class="btn btn-primary btn-lg">Login</button> 
            <button type="button" class="btn btn-warning btn-lg" id="register-button">Create Account</button> 
        </form> 
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script> 
        $(document).ready(function() {
            $("#register-button").click(function () { 
                window.location.replace("register.php"); 
            }); 
        });
    </script> 
</body> 

</html>

<?php 
    $message = "logged in successfully...redirecting to home page"; 

    session_start(); 
    if(isset($_SESSION["logged_in"])){ 
        header("Location:profile.php"); 
    } 

    if($_SERVER["REQUEST_METHOD"]=="POST"){ 
        $con = mysqli_connect('localhost', 'root', '', 'usersdb'); 

        if($con) {
            $username1=$_POST['username']; 
            $prefix="_"; 
            $username=$prefix.$username1; 
            $password=$_POST['Password']; 

            $sql = "SELECT id,username, password FROM users"; 
            $result = $con->query($sql); 

            if ($result->num_rows > 0) { 
                $fnd=0; 
                while($row = $result->fetch_assoc()) { 
                    if($row["username"]==$username and $row["password"]==$password) {	 
                        $_SESSION["username"] = $username; 
                        $_SESSION["registration-going-on"] = "0"; 
                        $fnd=1; 
                        $_SESSION["logged_in"]="1"; 
                        echo '<div class="alert alert-success" role="alert">'.$message.'</div>'; 

                        echo "<script>setTimeout(\"location.href = 'profile.php';\",3000);</script>"; 
                    } 
                } 
                if($fnd==0) {
                    echo "<script>alert('Username password not matches')</script>"; 
                }
            } else { 
                echo "<script>alert('Username password not matches')</script>"; 
            } 
        } else {
            echo "Failed to connect to database";
        }

        $con->close(); 
    } 
?>
