<?php
define("page", "serch");
define("title", "Serch User");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/serchbox.css">
    <title>Document</title>
</head>
<style>
.container .left {
    background-color: #242526;
}

.container .left .tab {
    border: 2px solid #242526;
}

.seprator {
    margin: -5px 0px 12px 29px;
    width: 92%;
    border-bottom: 1px solid #3e4042;
}
</style>

<body>
    <?php 
include_once('include/dbconf.php');
include('include/dbconf.php');
$start_time = microtime(true);
if(isset($_GET['q'])){
    $keyword = $_GET['q'];      
}else{
    header('Location:home.php');
}
  $q = "SELECT * FROM registration WHERE username LIKE '%$keyword%' OR user_email LIKE '%$keyword%'";
  $r = $conn->query($q);
  $total = mysqli_num_rows($r);
  $end_time = microtime(true); 
  $execution_time = ($end_time - $start_time); 
?>
    <?php include("include/home-header.php"); ?>
    <div class="container" id="container">
        <?php include('include/home-leftsidebar.php') ?>
    </div>
    <div class="serch-box-main">
        <h2>People</h2>
        <p id="time-sec-p">About <?php echo $total; ?> Result In (<?php echo $execution_time ?> Seconds)</p>
        <?php
        $query = "SELECT * FROM registration WHERE username LIKE '%$keyword%' OR user_email LIKE '%$keyword%' LIMIT 2";
        $res = $conn->query($query);
        if($res->num_rows == 0){
            echo "<h2>Serch Not Found For ---> $keyword</h2>";
        }else{

        while($row = mysqli_fetch_assoc($res)){  ?>
        <div class="friend-box">
            <img src="userimages/<?php echo $row['user_img'];  ?>" alt="">
            <div class="tags">
                <a href="friend.php?id=<?php echo $row['user_id']+100;  ?>"><?php echo $row['username'];  ?></a>
                <p><?php echo $row['user_gender'] ?></p>
                <p><?php echo $row['user_email'] ?></p>
            </div>
        </div>
        <div class="seprator"></div>
        <?php }} ?>
    </div>
    <div class="more">
        <button id="view-more-user" class="friend-more">View More <i class="fa fa-angle-down"aria-hidden="true"></i></button>
    </div>

    <input type="hidden" id="keyword" value="<?php echo $keyword; ?>">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script data-cfasync="false" type="text/javascript" src="js/common.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>
<script>
///*////////////////////////serch page
$(document).ready(function () {
    var commentcount = 2;
    $('#view-more-user').click(function () {
        keyword = $('#keyword').val();
        commentcount = commentcount + 2;
        $('.serch-box-main').load('include/backend1.php', {
            commentcount: commentcount, keyword: keyword
        })
    })
})
</script>
</html>