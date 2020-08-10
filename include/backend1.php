<?php
include ('dbconf.php');
include ('functions.php');

if(isset($_POST['serchval'])){
    $text = $_POST['serchval'];
    $query = "SELECT * FROM registration WHERE username like '%$text%' OR user_email LIKE '%$text%' limit 5";
    $res = mysqli_query($conn,$query);
    $dummytext = '<div class="serch-for">
    <div class="icon-div">
        <i class="fa fa-search" aria-hidden="true"></i>
    </div>
    <li>
        <p>Serch For:- '.$text.'</p>
    </li>
</div>';

    if(mysqli_num_rows($res) > 0){
    while ($data = mysqli_fetch_assoc($res)) {        
        echo "<div class='li'>
        <div class='icon-div'>
            <i class='fa fa-search' aria-hidden='true'></i>
        </div>
        <li class='serch-item'>".$data['username']."</li>
    </div>
    ";
    }
    echo $dummytext;  
}else{
    echo "<div class='li'>
    <div class='icon-div'>
        <i class='fa fa-search' aria-hidden='true'></i>
    </div>
    <li> <a href='#'>Data Not Found</a></li>
</div>
";

echo $dummytext;
}
}
?>

<?php
// Featch serch data from db
include ('dbconf.php');
if(isset($_POST['commentcount'] , $_POST['keyword'])){
        $start_time = microtime(true); 
        $count = $_POST['commentcount'];
        $keyword = $_POST['keyword'];
         include('dbconf.php');
         $output = "";
         $q = mysqli_query($conn,"SELECT * FROM registration WHERE username LIKE '%$keyword%' OR user_email LIKE '%$keyword%'");
         $re = mysqli_num_rows($q);
         $query = "SELECT * FROM registration WHERE username LIKE '%$keyword%' OR user_email LIKE '%$keyword%' LIMIT $count";
         $res = $conn->query($query);
         $end_time = microtime(true); 
         $execution_time = ($end_time - $start_time); 
         $output .='<h2>People</h2><p id="time-sec-p">About '.$re.' Result In ('.$execution_time.' Seconds)</p>'; 
         while($row = mysqli_fetch_assoc($res)){  
            $output .='<div class="friend-box">
            <img src="userimages/'.$row['user_img'].'" alt="">
            <div class="tags">
                <a href="friend.php?id='.($row['user_id']+100).'">'.$row['username'].'</a>
                <p>'.$row['user_gender'].'</p>
                <p>'.$row['user_email'].'</p>
            </div>
        </div> <div class="seprator"></div>';
        }
        echo $output;
    }      
?>

<?php  
/////////////////////////////////// load notification
if(isset($_POST['load_notify'])){
    $sqlres = mysqli_query($conn,"SELECT * FROM notification WHERE notification_to_id='4' ORDER BY notification_id DESC");
    if(mysqli_num_rows($sqlres) != 0){
        while ($notydata = mysqli_fetch_array($sqlres)) {
            $notification_to_id = $notydata['notification_form_id'];
            $notification_to_data = mysqli_query($conn,"SELECT * FROM registration WHERE user_id='$notification_to_id' LIMIT 1"); 
            $noti_data = mysqli_fetch_array($notification_to_data); 
            $name = ($noti_data['username'] != null)? $noti_data['username'] : "";
                echo '<a href="p"><div class="nofification">
                <img src="userimages/'.$noti_data['user_img'].'" alt="Not found">
                <p class="msg"><span>'.$name.'</span>'.$notydata['message'].'</p>
                </div></a>
            <p class="time">'.get_time_ago($notydata['time_numerical']).'</p>';
        }
    }else{
            echo '<h3>No Notofication Yet</h3>';
    }
}
?>


<?php
////////////////////////////////////////////////////////////////// fetch user for chat data 

if(isset($_POST['fetch_userdata'])){
    $userid = $_POST['fetch_userdata']-100;
    $arr = mysqli_query($conn,"SELECT * FROM registration WHERE user_id='$userid'");
    $data = mysqli_fetch_array($arr);
    $userlogdata;
    if($data['user_login'] == 1)
    $userlogdata = "Active";
else
    $userlogdata = get_time_agosort($data['user_lastseen']);
    $user_data = ['userid'=>$data['user_id']+100,'name'=>$data['username'] , 'img'=>$data['user_img'],'active'=>$userlogdata];
    echo json_encode($user_data);
}
?>

<?php
////////////////////////////////////////////////////////////////////////// send message
session_start();
if(isset($_POST['chattoid'] , $_POST['friend_id'] , $_POST['message'])){
    $friendid = $_POST['friend_id']-100;
    $chattoid = $_POST['chattoid']-100;
    $msg = $_POST['message'];
    $user_data = getuser_info($_SESSION['friendbook']);
    $senderid = $user_data['user_id'];
    $friendq = mysqli_query($conn,"SELECT * FROM friend_table WHERE id='$friendid'");
    $frienddata = mysqli_fetch_array($friendq);
    $screatkey = $frienddata['secreat_key'];
    $msg = enctype($msg,$screatkey);
    $time = time();
    $res = mysqli_query($conn,"INSERT INTO `message` (`friend_id`,`sender_id`,`reciver_id`,`message`,`status`,`time_numerical`,`enc_dcrypt_id`) VALUES ('$friendid','$senderid','$chattoid','$msg','unread','$time','$screatkey')");
}
?>
<?php
////////////////////////////////////////////////////////////////////// fetch chat code
if(isset($_POST['fetchchat_id'])){
    $id = $_POST['fetchchat_id']-100;
    $user_data = getuser_info($_SESSION['friendbook']);
    $senderid = $user_data['user_id'];
    $q = "SELECT * FROM `message` WHERE sender_id='$id' AND reciver_id='$senderid' OR sender_id='$senderid' AND reciver_id='$id'";
    mysqli_query($conn,"UPDATE message SET `status` = 'read' WHERE sender_id='$id' AND reciver_id='$senderid'");
    $res = mysqli_query($conn,$q);
    if(mysqli_num_rows($res) != 0){
    while ($row = mysqli_fetch_array($res)) {
        $msg = decrypt($row['message'],$row['enc_dcrypt_id']);
        if($senderid == $row['sender_id']){
            $data = getuserdataid($senderid);
            $uuu = mysqli_fetch_array($data);
             echo ' <div class="message-box left-img">
             <div class="picture">
                 <img src="userimages/'.$uuu['user_img'].'" alt="Not Found">
                 <span class="time">'.get_time_ago($row['time_numerical']).'</span>
             </div>
             <div class="message">
                 <span>You</span>
                 <p>'.$msg.'</p>
             </div>
         </div>';
        }else{
            $data = getuserdataid($row['sender_id']);
            $uuu1 = mysqli_fetch_array($data);
             echo  '<div class="message-box right-img">
             <div class="picture">
                 <img src="userimages/'.$uuu1['user_img'].'" alt="Not Found">
                 <span class="time">'.get_time_ago($row['time_numerical']).'</span>
             </div>
             <div class="message">
                 <span>'.$uuu1['username'].'</span>
                 <p>'.$msg.'</p>
             </div>
         </div>
';
        }
    }}else{
        echo "<h2>No Chat Yet</h2>";
    }
}
?>

