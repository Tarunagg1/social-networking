<div id="editmyModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h4>Edit Post</h4>
            <hr>
        </div>
        <form action="" method="post" id="editpost" enctype="multipart/form-data">
            <div class="modal-body">
            <input type="hidden" id="editpostid" value="">
                <div class="post-user-data">
                    <img src="userimages/<?php echo $data['user_img']; ?>" alt="Not Found">
                    <p><?php echo ucfirst($name); ?></p>
                </div>
                <div class="model-con">
                    <textarea style="height: 120px;" name="postcontent" id="editpostcontent"  placeholder="what's on your mind, <?php echo ucfirst($name) ?>"></textarea>
                </div>
                <div class="images-post">
                    <img style="width: 91%; margin-left: 8px; height: 187px;" id="post-image" src="" alt="">
                </div>
                <div class="post-graphics">
                    <span>Add With Your post</span>
                    <input  class="add-image-temp" id="edit-image-temp" type="button" value="Add Image"><span id="editfile-name">File Name</span>
                    <input type="file" hidden="hidden" id="editpostimage" name="postimage">
                </div>
            </div>
            <div class="modal-footer">
                <h3><input class="post-buttton" id="editpostbutton" type="submit" value="Upadte Post"></h3>
            </div>
    </div>
    </form>
</div>
