<?php
define("page", "friend");
define("title", "Friend Page");
include("include/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/friend.css">
    <title>Serch User</title>
</head>

<body>
    <?php include("include/home-header.php"); ?>
    <?php
   if(!isset($_GET['id'])){ ?>
    <div class="container" id="container">
        <?php include('include/friend-leftsidebar.php') ?>
    </div>
    <div class="middle-friend-container">
        <div class="not-provide-id">
            <i class="fa fa-users" aria-hidden="true"></i>
            <p>Select peoples names to preview their profile.</p>
        </div>
    </div>

    <?php } elseif(isset($_GET['id'])){ 
            $get_id = $_GET['id'];
            $get_id = $get_id-100;
            $user_count = mysqli_num_rows(getuserdataid($get_id));
            $rrrr = getuserdataid($get_id);
            $user1_data = mysqli_fetch_assoc($rrrr);
            if($user_count == 1){ ?>
    <div class="container" id="container">
        <?php include('include/friend-leftsidebar.php') ?>
    </div>
    <div class="middle-friend-container">
        <input type="hidden" value="<?php echo $get_id;?>"" id="friend_id">
        <div class="profile-container">
            <div class="profile-pics">
                <div id="profile-pic" class="profile-pic">
                    <div class="cover-pic">
                        <img id="coverpic"
                            src="userimages/<?php if($user1_data['user_cover_img'] == "" || $user1_data['user_cover_img']== "NULL"){ echo"blackbener.jpg"; } else { echo $user1_data['user_cover_img'] ;} ?>"
                            alt="Not Found" srcset="">
                    </div>
                    <div class="profile">
                        <img id="profilepic"
                            src="userimages/<?php if($user1_data['user_img'] == "" || $user1_data['user_img']== "NULL"){ echo"temp-user.png"; } else { echo $user1_data['user_img'] ;} ?>"" alt="
                            Not Found">
                    </div>
                </div>
            </div>
            <div class="pic-buttom">
                <h2><?php echo ucfirst(htmlentities($user1_data['username'])); ?></h2>
                <h5 id="bio-text-display">
                    <pre><?php echo $user1_data['user_bio']; ?></pre>
                </h5>
                <div class="seprator"></div>
                <div class="pic-buttom-last-header">
                    <div class="division">
                        <div class="first">
                            <ul>
                                <div class="list">
                                    <li>TimeLine</li>
                                </div>
                                <div class="list">
                                    <li>Friends</li>
                                </div>
                                <div class="list">
                                    <li>Friends</li>
                                </div>
                                <div class="list">
                                    <li>Friends</li>
                                </div>
                                <div class="list">
                                    <li>Friends</li>
                                </div>
                            </ul>
                        </div>
                        <div class="second">
                            <div class="buttons">
                                <?php 
                            $check_reqcomedata = mysqli_query($conn,"SELECT * FROM friend_request WHERE from_id='$get_id' AND to_id='$user_id' AND status='unaprove'");
                            $ddd = mysqli_fetch_array($check_reqcomedata);
                            $check_friendtable = mysqli_query($conn,"SELECT * FROM friend_table WHERE user_from='$get_id' AND user_to='$user_id' AND status='friend' OR user_from='$user_id' AND user_to='$get_id' AND status='friend'");
                            if(mysqli_num_rows($check_reqcomedata) == 1){
                                echo '<button onClick="confirmreq('.$ddd['id'].')" class="btn confirm'.$ddd['id'].'">Confirm</button>';
                            }elseif(mysqli_num_rows($check_friendtable) == 1){
                                echo '<button onClick="cancelreq('.($get_id+100).')" class="delete'.($get_id+100).' cancelreq" id="delete'.($get_id+100).'">UnFollow</button>';
                            } 
                            elseif(checkrequest($user_id,($get_id)) == true){ echo '<button onClick="cancelreq('.($get_id+100).')" class="delete'.($get_id+100).' cancelreq">Cancel Req</button>'; }
                            else { echo '<button onClick="sendrequest('.($get_id+100).')" class="requestbtn'.($get_id+100).'">Send Request</button>';} ?>
                                <button><i class="fa fa-message" aria-hidden="true"></i>Send Message</button>
                                <button><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-main">
                <div class="left">
                    <div class="box">
                        <h2>Intro</h2>
                        <p>Student at StudyInIndia.org</p>
                        <p>Studies at PDM College of Engineering</p>
                        <p>Studies Because good at PDM University</p>
                        <p>Studies at University of Delhi</p>
                        <p>Went to R R Gita Bal Bharti Public School-Alternate Gate</p>
                        <p>From New Delhi, India</p>
                        <p>Joined on June 2017</p>
                        <button>Edit Details</button>
                    </div>
                    <div class="box">
                        <h2>Photos</h2>
                        <div class="row">
                            <?php
                        $user_photo = mysqli_query($conn,"SELECT post_img FROM user_post WHERE user_id='$get_id' AND post_img!='NULL' ORDER BY post_id LIMIT 9");
                        if(mysqli_num_rows($user_photo) > 0)
                        while ($row = mysqli_fetch_array($user_photo)){
                            $img = $row['post_img'];
                            echo '<img src="userimages/'.$img.'" alt="Not Found">';
                        }else{
                            echo "<h2>No Image Found</h2>";
                        }
                            ?>
                        </div>
                        <button>Viwe More</button>
                    </div>
                    <div class="box">
                        <h2>Friends</h2>
                        <div class="row">
                            <a href="#"><img src="img/tarun.jpg" alt="Not Found"></a>
                            <a href="#"><img src="img/tarun.jpg" alt="Not Found"></a>
                            <a href="#"><img src="img/tarun.jpg" alt="Not Found"></a>
                            <a href="#"><img src="img/tarun.jpg" alt="Not Found"></a>
                            <a href="#"><img src="img/tarun.jpg" alt="Not Found"></a>
                            <a href="#"><img src="img/tarun.jpg" alt="Not Found"></a>
                            <a href="#"><img src="img/tarun.jpg" alt="Not Found"></a>
                        </div>
                        <button>Viwe More</button>
                    </div>
                </div>
                <div class="right">
                    <div class="box">
                        <div class="box" id="load_data_friend"></div>
                        <div class="" id="load_data_friend_msg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php  }else{ ?>
    <div class="middle-friend-container">
        <div class="not-found">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <h1>This Content Isn't Available Right Now</h1>
            <p>When this happens, it's usually because the owner only shared it with a small group of people, changed
                who can see it or it's been deleted.</p>
            <a href="friend.php">Go Back</a>
        </div>
    </div>
    <?php }} ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/common.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/friend.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/profile.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>