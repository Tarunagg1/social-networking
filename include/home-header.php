<?php
session_start();
if(!isset($_SESSION['friendbook'])){
    header("Location:index.php");
}else{
    include_once('dbconf.php');
    include_once('functions.php');
    $email = $_SESSION['friendbook'];
    $data = getuser_info($email);
    $name = $data['username'];
    $user_id = $data['user_id'];
}

?>
<header>
    <div class="first-sec">
        <i class="fa ser fa-search"></i>
        <input class="input" id="serch-textbox" type="text" placeholder="Search here">
        <div id="serch-list" class="serch-list">
            <ul id="serch-ul"></ul>
        </div>
    </div>
    <div class="second-sec">
        <ul>
            <li>
                <div class="icon">
                    <i class="fa fa-home"></i>
                </div>
            </li>
            <li>
                <div class="icon">
                    <i class="fa fa-user iconactive" aria-hidden="true"></i>
                </div>
                <span class="line"></span>
            </li>
            <li>
                <div class="icon">
                    <i class="fa fa-play-circle"></i>
                </div>
            </li>
            <li>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
            </li>
        </ul>
    </div>
    <div class="last-sec">
        <ul>
            <div class="ldiv1">
                <span>
                    <img src="img/avatar7.png" alt="Not found">
                    <p class="name"><?php echo $name; ?></p>
                </span>
            </div>
            <div class="ldiv">
                <span><i class="fa fa-plus-circle"></i> </span>
            </div>
            <div class="ldiv">
                <span><i class="fa fa-bell"></i> </span>
            </div>
            <div class="ldiv">
                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
            </div>
        </ul>
    </div>
</header>