<div id="stories" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span id="close" class="close">&times;</span>
            <h4>Add Stories</h4>
            <hr>
        </div>
        <form action="" method="post" id="addstories" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="post-user-data">
                    <img src="userimages/<?php echo $data['user_img']; ?>" alt="">
                    <p><?php echo ucfirst($name); ?></p>
                </div>
                <div class="add-post">
                    <img style="width: 94%; height:295px; margin: 3% 0% 1% 4%;" id="add-story" src="" alt="">
                </div>
                <div class="post-graphics">
                    <span>Add Your Stories</span>
                    <input class="add-image-temp" id="add-story-temp" type="button" value="Add Image">
                    <input type="file" hidden="hidden" id="storyimg" name="storyimg" onchange="return imagevalidate()" required>
                </div>
            </div>
            <div class="modal-footer">
                <h3><input class="post-buttton" id="storybtn" type="submit" value="Add Stories"></h3>
            </div>
    </div>
    </form>
</div>