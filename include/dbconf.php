<?php
$conn = mysqli_connect("localhost","root","","social_network"); //////localhost

// $conn = mysqli_connect("localhost","root","","registration");           ////production

if(!$conn){
   echo "Not conecteed Databsse Error";
}

?>