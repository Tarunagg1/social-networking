<div class="left">
    <div class="box">
        <h2>Intro</h2>
        <div class="intro">
            <p>Student at StudyInIndia.org</p>
            <p>Studies at PDM College of Engineering</p>
            <p>Studies Because good at PDM University</p>
            <p>Studies at University of Delhi</p>
            <p>Went to R R Gita Bal Bharti Public School-Alternate Gate</p>
            <p>From New Delhi, India</p>
            <p>Joined on June 2017</p>
        </div>
        <button id="EditDetails">Edit Details</button>
    </div>
    <div class="box">
        <h2>Photos</h2>
        <div class="row">
            <?php
                        $user_photo = mysqli_query($conn,"SELECT post_img FROM user_post WHERE user_id='$user_id' AND post_img!='NULL' AND 	hide_timeline='1' ORDER BY post_id LIMIT 9");
                        if(mysqli_num_rows($user_photo) > 0)
                        while ($row = mysqli_fetch_array($user_photo)){
                            $img = $row['post_img'];
                            echo '<img src="userimages/'.$img.'" alt="Not Found">';
                        }else{
                            echo "<h2>No Image Found</h2>";
                        }
                    ?>
        </div>
        <button id="viwephoto">Viwe More</button>
    </div>
    <div class="box">
        <h2>Friends</h2>
        <div class="row1">
            <?php
                $res = mysqli_query($conn,"SELECT * FROM friend_request WHERE from_id='$user_id' OR to_id='$user_id' AND status='aprove'");
                if(mysqli_num_rows($res) >0){
                    while($row = mysqli_fetch_array($res)){
                        $finalid = $row['from_id'];
                        if($finalid == $user_id){
                            $finalid = $row['to_id'];
                        }

                         $data = mysqli_fetch_array(getuserdataid($finalid));
                        echo '<div class="rowfriend">
                        <a href="friend.php?id='.($data['user_id']+100).'"><img src="userimages/'.$data['user_img'].'" alt="Not Found">'.$data['username'].'</a>
                    </div>';
                    }
                }else{
                    echo '<h2>No Friend Yet</h2>';
                }
            ?>
        </div>
        <button id="viewallfrnd">More Friend</button>
    </div>
</div>
<div class="right">
    <div class="box ">
        <div class="row">
            <div class="send-post">
                <img id="send-post-img" src="userimages/<?php echo $user_img; ?>" alt="">
                <input type="text" id="myBtn" placeholder="What's on your mind, Tarun?">
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box" id="load_data"></div>
        <div class="" id="load_data_msg"></div>
    </div>
</div>