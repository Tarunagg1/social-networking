<?php
include ("dbconf.php");
if(isset($_POST['email'])){
    $email = $_POST['email'];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
          echo "Enter Valid Email";
    }else{
        $res = mysqli_query($conn,"SELECT * FROM registration WHERE user_email='$email'");
        if(mysqli_num_rows($res) == 1){
            echo "email is allready exist";
        }
    }
}
?>
<?php
include ("dbconf.php");
if(isset($_POST['username'])){
    $username = $_POST['username'];
    if(strlen($username) < 3){
       echo "enter username";
    }else{
        $res = mysqli_query($conn,"SELECT * FROM registration WHERE username='$username'");
        if(mysqli_num_rows($res) == 1){
            echo "username is allready exist";
        }
    }
}
?>


<?php
include ("dbconf.php");
include_once("../mail_function.php");
if(isset($_POST['dob'])){
     $unam =  $_POST['username'];
     $email  = $_POST['email'];
     $pass = md5($_POST['password']);
     $num = $_POST['number'];
     $gender =  $_POST['gender'];
     $dob =  $_POST['dob'];
     $vskey = md5(time().$unam);

     $subject = "This is Email Varification";
     $body = "<p>Thanks for registering with Us. Please click this link to complete your registration: <br> <br> http://localhost/active.php?token=$vskey</p>"; 
        
     $query = "INSERT INTO `registration`(`username`, `user_email`,`user_number`, `user_password`, `user_gender`, `user_birthday`, `user_otp`) 
     VALUES ('$unam','$email','$num','$pass','$gender','$dob','$vskey')";
     if(mysqli_query($conn,$query)){
        sendmailuser($email,$subject,$body);
     }else{
        echo "Some Thing went To wrong Please try again";
     }
}
?>


<?php
session_start();
if(isset($_POST['logusername'])){
    sleep(5);
     $email = $_POST['logusername'];
     $pass= md5($_POST['logpassword']);

     $email_check = "SELECT * FROM  registration WHERE user_email='$email' limit 1";
     $data_email = mysqli_query($conn,$email_check);
     if(mysqli_num_rows($data_email) == 1){
        $row = mysqli_fetch_assoc($data_email);
        $dbemail = $row['user_email'];
        $dbis_active = $row['is_active'];
        $dbpass = $row['user_password'];
        if($pass != $dbpass){
            echo "Your password is wrong";
        }elseif($dbis_active == 0){
              echo "your account is not active";
        }else{
            $_SESSION['friendbook'] = $dbemail;
        }
    }else{
        echo "Email Is Not Register With Us";
           
     }
  }
?>
