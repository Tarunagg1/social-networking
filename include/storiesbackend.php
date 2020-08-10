<?php
session_start();
////////////////// create post
include_once('dbconf.php');
include_once('functions.php');
$data = getuser_info($_SESSION['friendbook']);
$id = $data['user_id'];
if(isset($_FILES['storyimg'])){
    $t=time();
    $b=time()+(24*60*60);
    if(isset($_FILES['storyimg']['name'])){
    $img =  $_FILES['storyimg']['name'];
    $imgarr = explode('.',$img);
    $newimgname = md5($imgarr[0]).".".$imgarr[1];
    move_uploaded_file($_FILES["storyimg"]["tmp_name"],"../storiesimg/".$newimgname);
    }
    $sql = "INSERT INTO `stories` (`user_id`, `story_img`, `story_time_numrical`, `valid_till`) VALUES ('$id','$newimgname','$t','$b')";
    $res = $conn->query($sql);
}
?>

<?php
////////////////////////////////////////////// story display
if(isset($_POST['stid'])){
    $id = $_POST['stid']-4567;
    $dataarr = array();
    $res = mysqli_query($conn,"SELECT story_img FROM stories WHERE user_id='$id' AND story_isvalid='1'");
    $totalcount = mysqli_num_rows($res);
    $data = mysqli_fetch_all($res);
    $temp = array($totalcount);
    array_push($temp,$data);
    // array_push($data,$temp);
    $js =  json_encode($temp,true);
    echo $js;
}
?>