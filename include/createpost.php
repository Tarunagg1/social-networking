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
                    <img src="img/avatar7.png" alt="">
                    <p>Tarun Aggarwal</p>
                </div>
                <div class="model-con">
                    <textarea name="postcontent" id="postcontent"  placeholder="what's on your mind, Tarun"></textarea>
                </div>
                <div class="post-graphics">
                    <span>Add With Your post</span>
                    <input  id="add-image-temp" type="button" value="Add Image"><span id="file-name">File Name</span>
                    <input type="file" hidden="hidden" id="postimage" name="postimage" onchange="return imagevalidate()">
                </div>
            </div>
            <div class="modal-footer">
                <h3><input class="post-buttton" id="postbutton" type="submit" value="Post"></h3>
            </div>
    </div>
    </form>
</div>
