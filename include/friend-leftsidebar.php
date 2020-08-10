<div class="left">
    <h1>Friends</h1>
    <?php
            $request_data = reciverequest($user_id);
         echo'<h5>'.mysqli_num_rows($request_data).'  Friend Request</h5>';
    ?>
    <a href="">View Send Request</a>
    <?php
    if(mysqli_num_rows($request_data) > 0){
    while ($row = mysqli_fetch_array($request_data)) {
        $data = getuserdataid($row['from_id']);
        $user_data = $data->fetch_assoc();
    ?>
    <a href="friend.php?id=<?php echo $user_data['user_id'] += 100 ?>">
        <div class="tab" id="deletetab<?php echo $row['id'] ?>">
            <img src="userimages/<?php if($user_data['user_img'] == "" || $user_data['user_img']== "NULL"){ echo"temp-user.png"; } else { echo $user_data['user_img'] ;} ?>"
                alt="Not found">
            <p><?php echo $user_data['username']  ?></p>
    </a>
    <div class="buttons">
        <button onClick="confirmreq(<?php echo $row['id'] ?>)" class="btn confirm<?php echo $row['id'] ?>">Confirm</button>
        <button onClick="deleterequest(<?php echo $row['id'] ?>)" class="btn delete deletereq<?php echo $row['id'] ?>">Delete </button>
    </div>
</div>
<?php  }}else{
      echo "<br><h1>No Request</h1>";
} ?>
<div class="button">
    <button>See More <i class="fa fa-angle-down" aria-hidden="true"></i></button>
</div>
<div class="seprator"></div>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////k  -->
<h4>People you may know</h4>
<?php
$data = getuser_info($_SESSION['friendbook']);
$email = $data['user_email'];
$user1_id = $data['user_id'];
$data1 = mysqli_query($conn, "SELECT * FROM registration WHERE user_email!='$email'");
while ($row1 = mysqli_fetch_assoc($data1)) {
    $normaluid = $row1['user_id'];
    $uid = $row1['user_id'] += 100;
    $check_req_recive = mysqli_query($conn,"SELECT * FROM friend_request WHERE 	from_id='$user1_id' AND to_id='$normaluid' AND status='unaprove' OR from_id='$normaluid' AND to_id='$user1_id' AND status='unaprove'");
    $skipusers = mysqli_query($conn,"SELECT * FROM friend_table  WHERE user_from='$normaluid' AND user_to='$user1_id' AND status='friend' OR user_from='$user1_id' AND user_to='$normaluid' AND status='friend'");
    if(mysqli_num_rows($skipusers) == 1){
        continue;
    }
?>

<a href="friend.php?id=<?php echo $uid; ?>">
    <div class="tab" id="tab<?php echo $uid; ?>">
        <img src="userimages/<?php if($row1['user_img'] == "" || $row1['user_img']== "NULL"){ echo"temp-user.png"; } else { echo $row1['user_img'] ;} ?>" alt="Not found">
        <p><?php echo $row1['username']; ?></p>
</a>
<div class="buttons">
<?php if(checkrequest($user1_id,($uid-100)) == true){ echo '<button onClick="cancelreq('.$uid.')" class="delete'.$uid.' btn cancelreq">cancel Req</button>'; }
elseif(mysqli_num_rows($check_req_recive) == 1){
    echo '<button class="btn reqrecive">Req Recive</button>';   
}
else { echo '<button onClick="sendrequest('.$uid.')" class="requestbtn'.$uid.' btn">Send Request</button>';} ?><button onClick="" class="btn delete">Remove</button>
</div>
</div>
<?php } ?>
<br><br><br>
</div>