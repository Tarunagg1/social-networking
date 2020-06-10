<?php
include_once('dbconf.php');

function getuser_info($email){
    global $conn;
    $sql = "SELECT * FROM registration WHERE user_email='$email'";
    $res = $conn->query($sql); 
    $data = $res->fetch_assoc();  
    return $data;
}
?>