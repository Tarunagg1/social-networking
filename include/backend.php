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
      $query = "INSERT INTO `registration`(`username`, `user_email`,`user_number`, `user_password`, `user_gender`,`user_img`,`user_cover_img`,`user_birthday`, `user_otp`) 
     VALUES ('$unam','$email','$num','$pass','$gender','temp-user.png','blackbener.jpg','$dob','$vskey')";
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
     $email_check = "SELECT * FROM  registration WHERE user_email='$email' OR username='$email' limit 1";
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
            mysqli_query($conn,"UPDATE registration SET user_login='1' WHERE user_email='$dbemail'");
            $_SESSION['friendbook'] = $dbemail;
        }
    }else{
        echo "Email Is Not Register With Us";
     }
  }
?>

<?php
////////////////// create post
include_once('dbconf.php');
include_once('functions.php');
if(isset($_FILES['imagefile']) ||  isset($_POST['content'])){
    $content = mysqli_real_escape_string($conn,$_POST['content']);
    $time = time();
    $img = "NULL";
    if(isset($_FILES['imagefile']['name'])){
    $img =  $_FILES['imagefile']['name'];
    move_uploaded_file($_FILES["imagefile"]["tmp_name"],"../userimages/".$img);
    }
$data = getuser_info($_SESSION['friendbook']);
    $id = $data['user_id'];
     $sql = "INSERT INTO `user_post`(`user_id`, `post_content`, `time`,`post_img`) VALUES ('$id','$content','$time','$img')";
    $res = $conn->query($sql);
}
?>

<?php
////////////////////////////////////////////////////////////////////////////  firnd froiend
if(isset($_POST['loadfriend'])){
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $sq = "SELECT * FROM friend_table WHERE user_from='$user_id' OR user_to='$user_id' AND 	status='friend'";
    $data1 = mysqli_query($conn,$sq);
    while($row = mysqli_fetch_array($data1)){
        $fromid = $row['user_from']; 
        $to_id = $row['user_to'];
        $finalid =  ($fromid == $user_id) ? $to_id : $fromid;
        $q = mysqli_query($conn,"SELECT * FROM `message` WHERE `sender_id`='$finalid' AND `reciver_id`='$user_id' AND `status`='unread'");
        $msgcount = mysqli_num_rows($q);
        $counttemplate = (mysqli_num_rows($q) > 0) ? "<h5 id='msgcount'>$msgcount</h5>": '';
        $userq = mysqli_query($conn,"SELECT * FROM registration WHERE user_id='$finalid'");
        $user_data = mysqli_fetch_array($userq);
        $userlogdata;
        if($user_data['user_login'] == 1)
            $userlogdata = "Active";
        else
            $userlogdata = get_time_agosort($user_data['user_lastseen']);
        echo '<div class="users" onClick="createchatbox('.($user_data['user_id']+100).','.$row['id'].')" id="user'.$user_data['user_id'].'">
        <img src="userimages/'.$user_data['user_img'].'" alt="">
        <p>'.$user_data['username'].''.$counttemplate.'</p><span>'.$userlogdata.'</span>
    </div>';
    }
}
?>