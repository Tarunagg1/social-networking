<div class="left">
    <input type="hidden" id="myimg" value="<?php echo $user_img; ?>">
    <h5 class="storyh5">Stories</h5>
    <div class="mystry" id="mystry">
        <?php
        $data = mysqli_query($conn,"SELECT * FROM stories WHERE user_id='$user_id' AND NOW() <= DATE_ADD(story_time,INTERVAL 60*24 MINUTE) AND story_isvalid='1' ORDER BY story_id DESC");
        $d = mysqli_fetch_array($data);
        if(mysqli_num_rows($data) > 0){ ?>
        <div data-id="<?php echo ($user_id+4567) ?>" class="tab stclick" id="tab">
            <img src="userimages/<?php echo $user_img; ?>" alt="User img">
            <p class="fetstap">View your Stories</p><span> <?php echo get_time_agosort($d['story_time_numrical']) ?></span>
            <i class="mystac"><?php echo mysqli_num_rows($data); ?> Stories</i>
        </div>
        <?php } ?>
    </div>
    <div id="addstory" class="tab">
        <i class="fa fa-plus-circle" aria-hidden="true">
            <p>Add Your Stories</p>
        </i>
    </div>
    <div class="seprator"></div>
    <?php
            $res = mysqli_query($conn,"SELECT * FROM friend_request WHERE from_id='$user_id' OR to_id='$user_id' AND `status`='aprove'");
            if(mysqli_num_rows($res) > 0){ 
            while($row = mysqli_fetch_array($res)){
                $finalid = $row['from_id'];
                if($finalid == $user_id){
                    $finalid = $row['to_id'];
                }
                $storydata = mysqli_query($conn,"SELECT * FROM stories WHERE user_id='$finalid' AND NOW() <= DATE_ADD(story_time,INTERVAL 60*24 MINUTE) AND story_isvalid='1'");
                if(mysqli_num_rows($storydata) > 0){
                    $stdata = mysqli_fetch_array($storydata);
                    $data = getuserdataid($stdata['user_id']);
                    $u = mysqli_fetch_array($data);
                    echo '<div data-id="'.($stdata['user_id']+4567).'" class="tab stclick">
                    <img src="userimages/'.$u['user_img'].'" alt="User img">
                    <p class="fetstap">'.$u['username'].'</p> <span>'.get_time_agosort($stdata['story_time_numrical']).'</span>
                    <i class="numsto">'.mysqli_num_rows($storydata).' Stories</i>
                </div>';
                }
            }
        }
    ?>

</div>