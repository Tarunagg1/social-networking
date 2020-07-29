<?php 
session_start();
include ("include/dbconf.php");
$email = $_SESSION['friendbook'];
$time = time();
mysqli_query($conn,"UPDATE registration SET user_login='0',user_lastseen='$time' WHERE user_email='$email'");
session_destroy();
session_unset();
header("Location:index.php");
?>