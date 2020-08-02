<?php
define("page", "stories");
define("title", "Stories");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/stories.css">
    <title>Stories</title>
</head>

<body>
    <?php include("include/home-header.php"); ?>
    <?php include('include1/create-stories.php') ?>
    <div class="container" id="container">
        <?php include('include/stories-leftsidebar.php') ?>
        <div id="storycontainer" class="storycontainer">
            <div class="notstoryid">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
                <h5>Select a story to open.</h5>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script data-cfasync="false" type="text/javascript" src="js/stories.js"></script>
    <script data-cfasync="false" type="text/javascript" src="js/common.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>