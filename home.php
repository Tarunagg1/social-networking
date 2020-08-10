<?php
define("page", "home");
define("title", "home");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Document</title>
    <style>
    #load_data_msg,#afterdatamsg {
        margin: 30px 0px 20px 167px;
    }
    #load_data_msg img.done{
        width: 199px;
        height: 108px;
        opacity: 0.6;
        margin-left: -2px;
    }
    #load_data_msg img {
        height: 74px;
        margin: 0px 0px 20px 20%;
        width: 70px;
    }
    #afterdatamsg img{
        height: 74px;
        margin: 0px 0px 20px 20%;
        width: 70px;
    }
    </style>
</head>

<body>
    <?php include("include/home-header.php"); ?>
    <div class="container" id="container">
        <?php include('include/home-leftsidebar.php') ?>
        <?php include('include/home-rightsidebar.php') ?>
        <div class="middle">
            <div class="mainbox">
                <div class="stories-container">
                    <a href="stories.php">
                        <div class="stories-arrow">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </div>
                    </a>
                    <div class="stories">
                        <img class="sto" data-id="11" src="userimages/<?php echo $user_img; ?>" alt="">
                        <div class="story-inner-img">
                            <p>Add Stories</p>
                            <img src="userimages/<?php echo $user_img; ?>" alt="User img">
                        </div>
                    </div>
                    <?php
                            mysqli_query($conn,"UPDATE stories SET story_isvalid='0' WHERE user_id='$user_id' AND NOW() >= DATE_ADD(story_time,INTERVAL 60*24 MINUTE) AND story_isvalid='1'");
                            $count = 1;
                            if($count != 4){
                                $res = mysqli_query($conn,"SELECT * FROM friend_request WHERE from_id='$user_id' OR to_id='$user_id' AND `status`='aprove'");
                                if(mysqli_num_rows($res) > 0){ 
                                while($row = mysqli_fetch_array($res)){
                                    $finalid = $row['from_id'];
                                    if($finalid == $user_id){
                                        $finalid = $row['to_id'];
                                    }
                                    $storydata = mysqli_query($conn,"SELECT * FROM stories WHERE user_id='$finalid' AND NOW() <= DATE_ADD(story_time,INTERVAL 60*24 MINUTE) AND story_isvalid='1'");
                                    if(mysqli_num_rows($storydata) > 0){
                                        $count++;
                                        $stdata = mysqli_fetch_array($storydata);
                                        $data = getuserdataid($stdata['user_id']);
                                        $u = mysqli_fetch_array($data);
                                        echo '<div class="stories">
                                        <img class="sto" src="userimages/'.$u['user_img'].'" alt="">
                                        <div class="story-inner-img">
                                            <p>'.$u['username'].'</p>
                                            <img src="userimages/'.$u['user_img'].'" alt="User img">
                                        </div>
                                    </div>';
                                    }
                                }
                            }
                         }
                        if($count == 1){
                              echo '<div class="stories"></div><div class="stories"></div><div class="stories"></div>';  
                         }
                        else if($count == 2){
                            echo '<div class="stories"></div><div class="stories"></div>';

                         }else if($count == 3){
                            echo '<div class="stories"></div>';
                         }
                        ?>
                </div>
                <div class="main-sendpost">
                    <div class="send-post">
                        <img src="userimages/<?php echo $user_img; ?>" alt="User img">
                        <input type="text" id="myBtn" placeholder="What's on your mind, <?php echo ucfirst($name); ?>?">
                    </div>
                </div>

                <div id="postcontainer" class="postcontainer"></div>
                <div id="load_data_msg"></div>
                <div id="afterdata" class="h"></div>
                <div id="afterdatamsg"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script data-cfasync="false" type="text/javascript" src="js/home.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/common.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>