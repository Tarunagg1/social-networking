<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h4>Create Post</h4>
            <hr>
        </div>
        <form action="" method="post" id="createpost" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="post-user-data">
                    <img src="userimages/<?php echo $data['user_img']; ?>" alt="">
                    <p><?php echo ucfirst($name); ?></p>
                </div>
                <div class="model-con">
                    <textarea style="height: 120px;" name="postcontent" id="postcontent"  placeholder="what's on your mind, <?php echo ucfirst($name) ?>"></textarea>
                </div>
                <div class="add-post">
                    <img style="width: 91%; margin-left: 8px; height: 187px;" id="add-image" src="" alt="">
                </div>
                <div class="post-graphics">
                    <span>Add With Your post</span>
                    <input  class="add-image-temp" id="add-image-temp" type="button" value="Add Image"><span id="file-name">File Name</span>
                    <input type="file" hidden="hidden" id="postimage" name="postimage" onchange="return imagevalidate()">
                </div>
            </div>
            <div class="modal-footer">
                <h3><input class="post-buttton" id="postbutton" type="submit" value="Post"></h3>
            </div>
    </div>
    </form>
</div>
