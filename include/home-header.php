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
    $user_img = $data['user_img'];
    include_once("include/createpost.php");
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
            <a href="home.php">
                <li>
                    <div class="icon">
                        <i class="fa fa-home <?php if(page == "home"){ echo "iconactive";}  ?>"></i>
                    </div>
                    <?php if(page == "home"){ echo '<span class="line"></span>';}  ?>
                </li>
            </a>
            <a href="friend.php">
                <li>
                    <div class="icon">
                        <i class="fa fa-user <?php if(page == "friend"){ echo "iconactive";}  ?>"
                            aria-hidden="true"></i>
                    </div>
                    <?php if(page == "friend"){ echo '<span class="line"></span>';}  ?>
                </li>
            </a>
            <a href="home.php">
                <li>
                    <div class="icon">
                        <i class="fa fa-play-circle"></i>
                    </div>
                </li>
            </a>
            <a href="home.php">
                <li>
                    <div class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                </li>
            </a>
        </ul>
    </div>
    <div class="last-sec">
        <ul>
            <div class="ldiv1">
                <span>
                    <a href="profile.php"> <img src="userimages/<?php echo $user_img; ?>" alt="Not found">
                        <p class="name"><?php echo ucfirst($name); ?></p>
                    </a>
                </span>
            </div>
            <div id="createtag" class="ldiv">
                <span><i class="fa fa-plus-circle"></i> </span>
            </div>
            <div class="option" id="create">
                <div class="useroption">
                    <a href="profile.php">
                        <img src="userimages/<?php echo $user_img; ?>" alt="Not found">
                        <h1><?php echo ucfirst($name); ?></h1>
                        <span>See Your Profle</span>
                    </a>
                </div>
                <div class="option-menu">
                    <div class="m" id="create_post">
                        <i class="fa fa-plus-circle"></i>
                        <h5>Create New Post</h5>
                    </div>
                </div>
            </div>
            <div id="notfy-list" class="ldiv">
                <span><i class="fa fa-bell"></i> </span>
            </div>
            <div class="notification-list" id="notification-list">
                <h1>Notifications</h1>
            </div>
            <div id="optiontag" class="ldiv">
                <span><i class="fa fa-caret-down" aria-hidden="true"></i></span>
            </div>
            <div class="option" id="options">
                <div class="useroption">
                    <a href="profile.php">
                        <img src="userimages/<?php echo $user_img; ?>" alt="Not found">
                        <h1><?php echo ucfirst($name); ?></h1>
                        <span>See Your Profle</span>
                    </a>
                </div>
                <div class="option-menu">
                    <a href="logout.php">
                        <div class="m">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            <h5>Log Out</h5>
                        </div>
                    </a>
                </div>
            </div>
        </ul>
    </div>
</header>