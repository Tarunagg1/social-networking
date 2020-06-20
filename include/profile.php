<?php
///////////////update bio
session_start();
include ("dbconf.php");
include_once('functions.php');
if(isset($_POST['biocontent'])){
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $text = mysqli_real_escape_string($conn,$_POST["biocontent"]); 
    $qu = "UPDATE registration SET user_bio='$text' WHERE user_id='$user_id'";
    $res = mysqli_query($conn,$qu);
    echo $res;
}
?>

<?php
/////// display profile post
include ('dbconf.php');
if(isset($_POST['start'] , $_POST['limit'])){
    $user_data = getuser_info($_SESSION['friendbook']);
   $user_id = $user_data['user_id'];
  $query = "SELECT * FROM user_post WHERE user_id='$user_id' ORDER BY post_id DESC LIMIT ".$_POST["start"]." , ".$_POST["limit"]." ";
   $res = mysqli_query($conn,$query);
   while($row = mysqli_fetch_assoc($res)){
       $content = $row['post_content'];
       $fullcontnt = $row['post_content'];
       if(strlen($content) > 300){
       $content = substr($content,0,300).'.... <span onClick="readmore()" id="Readmore">Readmore</span>';
    }
       $img = ($row['post_img'] != 'NULL') ? $row['post_img'] : "";
       echo '   <div class="row">              
       <div class="post-header">
       <img src="img/avatar7.png" alt="">
       <a href="#" id="name">'.$user_data['username'].'</a><span>...</span>
       <p id="time">'.$row['post_date'].'</p>
   </div>
   <div class="post-text">
       <p id="normal-text">'.$content.'</p>
       <p id="read-more-p">'.$fullcontnt.'</p>

   </div>
   <div class="img">
       <img src="userimages/'.$img.'" alt="">
   </div>
   <div class="post-counts">
       <span id="likes">100 likes</span><span id="comment">50 Comments</span> <span id="share">20
           shares</span>
   </div>
   <hr>
   <div class="post-actions">
       <button class="p-btn">Like</button>
       <button class="p-btn">Comment</button>
       <button class="p-btn">Share</button>
   </div>
   <hr>
   <div class="write-comment">
       <img src="img/avatar7.png" alt="">
       <input type="text" placeholder="Write a comment">
   </div></div>';
   }

}
?>

<?php
if(isset($_POST['deletepic'])){
    $where = $_POST['deletepic'];
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $sql = "";
    if($where == 'cover'){
        $sql = "UPDATE registration SET user_cover_img='blackbener.jpg' where user_id='$user_id'"; 
    }else if($where == 'profile'){
        $sql = "UPDATE registration SET user_img='temp-user.png' where user_id='$user_id'"; 
    }else{
        echo "error";
    }
    $res = mysqli_query($conn,$sql);
    echo $res;
}

if(isset($_POST['where']) || isset($_FILES['picname'])){
    $where = $_POST['where'];
    $picname = $_FILES['picname']['name'];
    $imgarr = explode(".",$picname);
    $newimagename = md5($imgarr[0]).".".$imgarr[1];
    move_uploaded_file($_FILES["picname"]["tmp_name"],"../userimages/".$newimagename);
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $sql = "";
    if($where == 'cover'){
        $sql = "UPDATE registration SET user_cover_img='$newimagename' where user_id='$user_id'"; 
    }else if($where == 'profile'){
        $sql = "UPDATE registration SET user_img='$newimagename' where user_id='$user_id'"; 
    }else{
        echo "error";
    }
    $res = mysqli_query($conn,$sql);
    if($res){
        echo $newimagename;
    }else{
         echo "error";
    }
}
?>