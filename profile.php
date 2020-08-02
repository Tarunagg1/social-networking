<?php
define("page", "profile");
define("title", "profile");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/profile.css">
    <title><?php echo title;  ?></title>
</head>

<body>
    <?php include("include/home-header.php"); ?>
    <?php include("include/editpost.php"); ?>
    <div class="profile-container">
        <div class="profile-pics">
            <div id="profile-pic" class="profile-pic">
                <div class="cover-pic">
                    <img id="coverpic" src="userimages/<?php echo $data['user_cover_img']; ?>" alt="Not Found"
                        srcset="">
                    <div class="upload-button">
                        <button id="edit-cover-pic"><i class="fa fa-camera" aria-hidden="true"></i> Edit Cover
                            Photo</button>
                        <div class="cover-pic-list" id="cover-pic-list">
                            <input type="file" hidden="hidden" name="filE" id="cover-uploder">
                            <ul>
                                <div class="col" id="upload-cover-pic">
                                    <li><i class="fa fa-upload" aria-hidden="true"></i> Upload Cover Photo</li>
                                </div>
                                <div class="col" id="delete-cover-pic">
                                    <li><i class="fa fa-trash" aria-hidden="true"></i> Delete Cover Photo</li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="profile">
                    <img id="profilepic" src="userimages/<?php echo $data['user_img']; ?>" alt="Not Found">
                    <div class="uploadpic" id="edit-profile-pic">
                        <input type="file" hidden="hidden" name="file" id="profile-uploder">
                        <i class="fa fa-camera" aria-hidden="true"></i>
                        <div class="profile-pic-list" id="profile-pic-list">
                            <ul>
                                <div class="col1" id="upload-profile-pic">
                                    <li><i class="fa fa-upload" aria-hidden="true"></i> Upload Profile Photo</li>
                                </div>
                                <div class="col1" id="delete-profile-pic">
                                    <li><i class="fa fa-trash" aria-hidden="true"></i> Delete Profile Photo</li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pic-buttom">
            <h2><?php echo ucfirst(htmlentities($data['username'])); ?></h2>
            <h5 id="bio-text-display">
                <pre><?php echo htmlentities($data['user_bio']); ?></pre>
            </h5>
            <p id="addbio"><?php  if(strlen($data['user_bio']) == 0) { echo "Add Bio"; } else{echo "Edit Bio"; } ?></p>
            <div class="form-bio" id="form-bio">
                <textarea name="bio-text" id="bio-text" cols="34" rows="4"
                    placeholder="Describe Your Self"><?php echo $data['user_bio']; ?></textarea><br>
                <span id="char-rem"></span>
                <div class="buttons">
                    <button id="cancel-bio">Cancel</button>
                    <button id="save-bio" class="nosave">Save</button>
                </div>
            </div>
            <div class="seprator"></div>
            <div class="pic-buttom-last-header">
                <div class="division">
                    <div class="first">
                        <ul>
                            <a href="profile.php">
                                <div id="timeline" class="list profileactive">
                                    <li>TimeLine</li>
                                </div>
                            </a>
                            <div id="about" class="list">
                                <li>About</li>
                            </div>
                            <div id="viewfriend" class="list">
                                <li>Friends</li>
                            </div>
                            <div id="photos" class="list">
                                <li>Photos</li>
                            </div>
                            <div id="archive" class="list">
                                <li>Archive</li>
                            </div>
                        </ul>
                    </div>
                    <div class="second">
                        <div class="buttons">
                            <button id="aboutbtn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                            <button><i class="fa fa-eye" aria-hidden="true"></i> Viwe As</button>
                            <button><i class="fa fa-search" aria-hidden="true"></i> Serch</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="profile-main" class="profile-main">
            <?php include('include1/timeline.php'); ?>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script data-cfasync="false" type="text/javascript" src="js/profile.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/common.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>