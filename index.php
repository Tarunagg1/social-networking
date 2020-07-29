<?php
session_start();
   if(isset($_SESSION['friendbook'])){
       echo "<script>location.href='home.php'</script>";
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>

<body>
    <div class="header">
        <div class="first-half">
            <h1>FriendBook</h1>
        </div>
        <div class="second-half">
            <span>Email Or Username</span>
            <div class="sm-view">
                <form action="" id="loginform" method="post">
                    <input type="text" placeholder="Enter Email" name="logusername" id="logid" required>
                    <span>Password</span>
                    <input type="text" placeholder="Enter Password" name="logpassword" id="logpass" required>
                    <input type="submit" name="login" class="" id="login" value="Login">
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col small-hide">
            <div class="hide-md-lg">
                <p>Login an account:</p>
            </div>
            <form action="" id="loginform2" method="post">
                <input type="email" name="logusername" id="logid2" placeholder="Username" required>
                <input type="password" name="logpassword" id="logpass2" placeholder="Password" required>
                <input type="submit" class="btn" name="login" id="login2" value="Login">
            </form>
        </div>

        <form action="/action_page.php">
            <div class="row">
                <div class="vl">
                    <span class="vl-innertext">or</span>
                </div>

                <div class="col manully">
                    <div class="md-lg">
                        <h3>Login Mennully</h3>
                    </div>

                    <a href="#" class="fb btn">
                        <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                    </a>
                    <a href="#" class="twitter btn">
                        <i class="fa fa-twitter fa-fw"></i> Login with Twitter
                    </a>
                    <a href="#" class="google btn">
                        <i class="fa fa-google fa-fw"></i> Login with Google+
                    </a>
                </div>
        </form>
        <div class="col1">
            <div class="hide-md-lg">
                <p>Create an account:</p>
            </div>
            <div class="md-lg">
                <h3>Create an account</h3>
            </div>
            <form id="validateform" action="" method="post">
                <input type="text" name="username" onBlur="checkuname()" id="uname" placeholder="Username" required>
                <span id="msg1"></span>
                <input type="email" name="email" onBlur="checkemail()" id="email" placeholder="Enter Email" required>
                <span id="msg"></span>
                <input type="password" id="pass" maxlength="30" minlength="5" name="password" placeholder="Password"
                    required>
                <input type="number" id="num" maxlength="10" name="number" vlaue="Male" placeholder="Enter number"
                    required>
                <input type="radio" value="male" name="gender" required>Male
                <input type="radio" value="female" name="gender" required>Female
                <input type="radio" value="other" name="gender" required> Other
                <input type="date" id="gender" name="dob" placeholder="Enter Dob" required>
                <input type="submit" name="register" id="register" class="btn" value="Register">
                <span id="result"></span>
                <?php if(isset($msg)) {echo $msg; } ?>
            </form>
        </div>
        <div class="otp" id="otp">
            <p>Varify Your Account</p>
        <input type="number" name="email" onBlur="checkotp()" id="otp" placeholder="Enter otp" required>
        <input type="submit" name="verify" class="btn" id="verify" class="" value="Verify">
        </div>
    </div>
    </div>

    <div class="bottom-container">
        <div class="row">
            <div class="footer-col">
                <a href="#" style="color:white" class="btn">Sign up</a>
            </div>
            <div class="footer-col">
                <a href="#" style="color:white" class="btn">Forgot password?</a>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/validation.js"></script>
</body>

</html>