<?php
///////////////update bio
session_start();
include ("dbconf.php");
include_once('functions.php');
if(isset($_POST['biocontent'])){
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $text = mysqli_real_escape_string($conn,$_POST["biocontent"]); 
    $qu = "UPDATE registration SET user_bio='$text' WHERE user_id='$user_id'";
    $res = mysqli_query($conn,$qu);
    echo $res;
}
?>

<?php
/////// display profile post
include ('dbconf.php');
if(isset($_POST['start'] , $_POST['limit'])){
    $user_data = getuser_info($_SESSION['friendbook']);
   $user_id = $user_data['user_id'];
   $user_img = $user_data['user_img'];
   $res = "";
  $query = "SELECT * FROM user_post WHERE user_id='$user_id' AND post_active='1' AND hide_timeline='1' ORDER BY post_id DESC LIMIT ".$_POST["start"]." , ".$_POST["limit"]."";
   $res = mysqli_query($conn,$query);
   while($row = mysqli_fetch_assoc($res)){
       $fullcontnt = $row['post_content'];
       $id = $row['post_id'];
       $content = $row['post_content'];
       if(strlen($content) > 300){
       $content = substr($content,0,300).'.... <span class="readmore" id="Readmore'.$id.'">Readmore</span>';
    }
    if(userlike($id))
        $likeclass = "like-post";
    else
        $likeclass = "fa-notlike";
        
    $comment_res = mysqli_query($conn,"SELECT * FROM comment WhERE post_id='$id' ORDER BY id DESC");
    $comment_count = mysqli_num_rows($comment_res);
    $like = mysqli_query($conn,"SELECT * FROM like_table WHERE post_id='$id'");
    $count_like = mysqli_num_rows($like);
       $img = ($row['post_img'] != 'NULL') ? $row['post_img'] : "";
       echo ' <div class="row" id="row'.$id.'">              
       <div class="post-header">
       <div class="post-operation-list" style="" id="'.$id.'">
       <ul>
           <div class="post-row" onClick="deletepost('.$id.')">
               <li><i class="fa fa-trash" aria-hidden="true"></i> Delete Post</li>
           </div>
           <div class="post-row" onClick="editpost('.$id.')">
               <li> <i class="fa ser fa-pencil"></i> Edit Post</li>
           </div>
           <div class="post-row" onClick="hidetimelinepost('.$id.')">
               <li><i class="fa fa-eye-slash" aria-hidden="true"></i>Hide From Timeline</li>
           </div>
           <div class="post-row">
           <li><i class="fa fa-times" aria-hidden="true"></i>Cancel</li>
       </div>
       </ul>
   </div>
       <img src="userimages/'.$user_img.'" alt="">
       <a href="#" id="name">'.$user_data['username'].'</a><span id="more-operation'.$id.'">...</span>
       <p id="time">'.$row['post_date'].'</p>
   </div>
   <div class="post-text">
       <p id="normal-text'.$id.'">'.$content.'</p>
       <p id="full-text'.$id.'" style="display:none;">'.$fullcontnt.'...<span class="readless" id="Readless'.$id.'">ReadLess</span>'.'</p>
   </div>
   <div class="img">
   <img id="post_img'.$id.'" src="userimages/'.$img.'" alt="">
   </div>
   <div class="post-counts">
       <span id="likes" class="likes'.$id.'">'.$count_like.' likes</span><span onClick="commentsection('.$id.')" class="comment'.$id.'" id="comment">'.$comment_count.' Comments</span> <span id="share">20
           shares</span>
   </div>
   <hr>
   <div class="post-actions">
       <button class="p-btn" onClick="likepost('.$id.')" ><i id="like-btn-'.$id.'" class="fa fa-thumbs-up '.$likeclass.'" aria-hidden="true"></i> Like</button>
       <button onClick="commentsection('.$id.')" class="p-btn"> <i class="fa fa-comments-o" aria-hidden="true"></i> Comment</button>
       <button class="p-btn"><i class="fa fa-share-alt" aria-hidden="true"></i>  Share</button>
   </div>
   <hr>
   <div class="write-comment">
   <img src="userimages/'.$user_img.'" alt="comment-img">
   <input type="text" id="comment-text-'.$id.'" placeholder="Write a comment">
    </div>
    '; if($comment_count >=0) { echo '
   <div class="post-comment-container" id="post-comment-container'.$id.'">
   <div id="row"></div>
  '; 
 }; echo '
</div>
    </div>
</div>
   <script>
    $("#comment-text-'.$id.'").keyup(function (e) {
      if (e.keyCode == 13) {
        value = $("#comment-text-'.$id.'").val();
        addcomment('.$id.', value);
      }
    })
    $("#Readmore'.$id.'").click(function () {
      $("#normal-text'.$id.'").css("display", "none")
      $("#full-text'.$id.'").css("display", "block")
    })
    $("#Readless'.$id.'").click(function () {
      $("#full-text'.$id.'").css("display", "none")
      $("#normal-text'.$id.'").css("display", "block")
    })
    $("#more-operation'.$id.'").click(function () {
      $("#'.$id.'").fadeToggle();
      $(".post-row").on("click", function () {
        $("#'.$id.'").fadeOut();
      })
    })
  </script>
   ';
   }

}
?>

<?php
if(isset($_POST['deletepic'])){
    ////////////////////////// delete profile and cover pic
    $where = $_POST['deletepic'];
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $sql = "";
    $reddata = mysqli_query($conn,"SELECT * FROM registration WHERE user_id='$user_id'");
    $dataarr = mysqli_fetch_assoc($reddata);
    $dbpicimg = $dataarr['user_img'];
    $dbcoverimg = $dataarr['user_cover_img'];
    if($where == 'cover'){
        echo "cober";
        $sql = "UPDATE registration SET user_cover_img='blackbener.jpg' where user_id='$user_id'"; 
        if($dbcoverimg != 'blackbener.jpg'){
            echo "fund";
            echo $dbpicimg;
            unlink('../userimages/'.$dbcoverimg);   
        }
    }else if($where == 'profile'){
        echo "profile";
        $sql = "UPDATE registration SET user_img='temp-user.png' where user_id='$user_id'"; 
        if($dbpicimg != 'temp-user.png'){
            echo "fund";
            echo $dbcoverimg;
            unlink('../userimages/'.$dbpicimg);   
        }
    }else{
        echo "error";
    }
    $res = mysqli_query($conn,$sql);
    echo $res;
}

if(isset($_POST['where']) || isset($_FILES['picname'])){
    ///////////////////////// uplad profile or cover pic
    $where = $_POST['where'];
    $picname = $_FILES['picname']['name'];
    $imgarr = explode(".",$picname);
    $newimagename = md5($imgarr[0]).".".$imgarr[1];
    move_uploaded_file($_FILES["picname"]["tmp_name"],"../userimages/".$newimagename);
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $sql = "";
    if($where == 'cover'){
        $sql = "UPDATE registration SET user_cover_img='$newimagename' where user_id='$user_id'"; 
    }else if($where == 'profile'){
        $sql = "UPDATE registration SET user_img='$newimagename' where user_id='$user_id'"; 
    }else{
        echo "error";
    }
    $res = mysqli_query($conn,$sql);
    if($res){
        echo $newimagename;
    }else{
         echo "error";
    }
}
?>

<?php
////////delete post
if(isset($_POST['deletepst'])){
    $id = $_POST['deletepst']; 
    $data = mysqli_query($conn,"SELECT *  FROM user_post WHERE post_id='$id'");
    $dataarr = mysqli_fetch_assoc($data);
    $res = mysqli_query($conn,"DELETE FROM user_post WHERE post_id='$id'");
    $img = $dataarr['post_img'];
    if($res){
        if(file_exists('../userimages/'.$img)){
              unlink('../userimages/'.$img);   
        }
    }
}
?>

<?php
//////hide timeline post
if(isset($_POST['hidetimeline'])){
    $id = $_POST['hidetimeline'];
    $res = mysqli_query($conn,"UPDATE user_post SET  hide_timeline='0' WHERE post_id='$id'");
}
?>

<?php
/////////////////// Edit And Updaet Post Code
if(isset($_POST['edit_post_id'])){
    $id = $_POST['edit_post_id'];
    $res = mysqli_query($conn,"SELECT * FROM user_post WHERE post_id='$id' AND  hide_timeline='1'");
    $arr = mysqli_fetch_array($res);
    $data = json_encode($arr);
    echo $data;
}
?>
<?php
////////////////// edit post
if(isset($_FILES['editimagefile']) ||  isset($_POST['editcontent'])){
    $content = mysqli_real_escape_string($conn,$_POST['editcontent']);
    $post_id = $_POST['post_id'];
    $time = time();
    $img = "NULL";
    $res = mysqli_query($conn,"SELECT * FROM user_post WHERE post_id='$post_id'");
    $data = mysqli_fetch_assoc($res);
    $db_img_name = $data['post_img'];
    $data = getuser_info($_SESSION['friendbook']);
    $id = $data['user_id'];
    if(isset($_FILES['editimagefile']['name'])){
        $img =  $_FILES['editimagefile']['name'];
        move_uploaded_file($_FILES["editimagefile"]["tmp_name"],"../userimages/".$img);
    }
    if($img == "NULL"){
           $img = $db_img_name;  
    }
    if($img != "NULL" && $img != $db_img_name){
        unlink("../userimages/".$db_img_name);
    }
     $sql = "UPDATE user_post SET post_content='$content' , post_img='$img' , time='$time' WHERE post_id='$post_id'";
     $res = $conn->query($sql);
     echo $img;
}
?>


<?php
/////////////////////////////////////////////////////////////////////// add comment
if(isset($_POST['post_id'] , $_POST['comment_text'])){
    $p_id = $_POST['post_id'];
    $text = mysqli_real_escape_string($conn,$_POST['comment_text']);
    $time = time();
    $data = getuser_info($_SESSION['friendbook']);
    $id = $data['user_id'];
    $sql = "INSERT INTO `comment`(`post_id`, `user_id`, `comment_content`,`numarical_time`, `parent`) VALUES ('$p_id','$id','$text','$time','NULL')";
    $res = mysqli_query($conn,$sql);
    echo getcommentcount($p_id);
}


?>

<?php
if(isset($_POST['comment_id'])){
    $comid = $_POST['comment_id'];
    $comment_res = mysqli_query($conn,"SELECT * FROM comment WhERE post_id='$comid' ORDER BY id DESC");
    while ($comrow = mysqli_fetch_assoc($comment_res)) {
        $user_id = $comrow['user_id'];
        $user_res = mysqli_query($conn,"SELECT * FROM registration WHERE user_id='$user_id'");
        $userdata = mysqli_fetch_assoc($user_res);
        echo ' <div class="comment-message">
        <div class="comment-message-header">
           <img src="userimages/'.$userdata['user_img'].'" alt="userimg">
            <div class="message">
                <a href="#">'.ucfirst($userdata['username']).'</a>
                <p>'.$comrow['comment_content'].'</p>
            </div>
        </div>
        <div class="comment-footer">
            <ul>
                <li>1 Like</li>
                <li>1 Reply</li>
                <li>'.get_time_ago($comrow['numarical_time']).'</li>
            </ul>
        </div>
      </div>
      ';
    };
}
?>

<?php 
///////////////////////////////////////////////// like code
if(isset($_POST['like_action'], $_POST['post_id'])){
    $action = $_POST['like_action'];
    $p_id = $_POST['post_id'];
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    
    switch($action){
        case 'like':
            $sql = "INSERT INTO `like_table`(`user_id`, `post_id`, `action`) VALUES ('$user_id','$p_id','$action')
              ON DUPLICATE KEY UPDATE action='like'";
            break;
        case 'unlike':
            $sql = "DELETE FROM like_table WHERE user_id='$user_id' AND post_id='$p_id' AND is_active='1'";
            break;
        default:
            break;
    }
    $res = mysqli_query($conn,$sql);
    echo getratting($p_id);
    exit(0);
}
?>

<?php
////////////////////////////////////////////////////////////////////    profile firend load
if(isset($_POST['loadfirend'])){
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $res = mysqli_query($conn,"SELECT * FROM friend_request WHERE from_id='$user_id' OR to_id='$user_id' AND `status`='aprove'");
    if(mysqli_num_rows($res) >0){ 
    while($row = mysqli_fetch_array($res)){
        $finalid = $row['from_id'];
        if($finalid == $user_id){
            $finalid = $row['to_id'];
        }
        $u = mysqli_query($conn,"SELECT * FROM registration WHERE user_id='$finalid'");
        $udata = mysqli_fetch_array($u);
        echo '<div class="friend-all-body">
        <div class="friendmaininner">
        <img id="coverpic" src="userimages/'.$udata['user_img'].'" alt="Not Found">
        <a href="friend.php?id='.($udata['user_id']+100).'">
            <p>'.$udata['username'].'</p>
        </a>
        <span>2 Mutual Friend</span>
        <a href="friend.php?id='.($udata['user_id']+100).'"> <button>Profile</button></a>
        </div>
    </div>';
    }
}else{
    echo '<h2>No Friend Yet</h2>';
}
}
?>


<?php
///////////////////////////////////////////////////////////////////////////////////////////  profile friend photos upload
if(isset($_POST['loadfirendphotos'])){
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $res = mysqli_query($conn,"SELECT user_img,user_cover_img FROM registration WHERE user_id='$user_id'");
    $res1 = mysqli_query($conn,"SELECT post_img FROM user_post WHERE user_id='$user_id' ORDER BY post_id DESC");
    while ($row = mysqli_fetch_array($res)) {
        if($row['user_img'] != " " || $row['user_cover_img'] != " " || $row['user_img'] != "NULL" || $row['user_cover_img'] != "NULL"){
            echo '<img src="userimages/'.$row['user_img'].'" alt="Not Found">';
            echo '<img src="userimages/'.$row['user_cover_img'].'" alt="Not Found">';
        }
    }
    if(mysqli_num_rows($res1) != 1){
        echo "<h1>Post Images</h1>";
        while ($row = mysqli_fetch_array($res1)) {
            if($row['post_img'] != "NULL"){
                echo '<img src="userimages/'.$row['post_img'].'" alt="Not Found">';
            }
        }
    }else{
        echo "<h2>No Post Send</h2>";
    }
}
?>

<?php
///////////////////////////////////////////////////////////////////////////////////////////  profile friend archive
if(isset($_POST['loadrechive'])){
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $res1 = mysqli_query($conn,"SELECT * FROM user_post WHERE user_id='$user_id' AND post_img != 'NULL' AND hide_timeline='0'");
    $res2 = mysqli_query($conn,"SELECT * FROM user_post WHERE user_id='$user_id' AND post_img = 'NULL' AND hide_timeline='0'");
    if(mysqli_num_rows($res1) != 0 ||  mysqli_num_rows($res2) != 0){
            if(mysqli_num_rows($res1) != 0){    
                $str = '  <h1>Archive Post Photos</h1>
                <div class="post-photos-firend">';
                    while ($d1 = mysqli_fetch_array($res1)) {
                        $str .= '<div class="pppg" id="archivepost'.($d1['post_id']+100).'">
                        <div class="archive-photolis" id="postlist'.($d1['post_id']+100).'">
                            <div onClick="unarchive('.($d1['post_id']+100).')" class="unacrive">Unarchive</div>
                        </div>
                        <span onClick="unarchivelist('.($d1['post_id']+100).')" id="unarchive'.$d1['post_id'].'">...</span>
                        <img src="userimages/'.$d1['post_img'].'" alt="Not Found">
                    </div>';
                    }
               $str .= '</div>';
               echo $str;
            }
            if(mysqli_num_rows($res2) != 0){
                $str2 = '<h1>Archive Text Post</h1>';
                while ($d2 = mysqli_fetch_array($res2)) {
                   $str2 .= ' <div class="post-text-firend" id="archivepost'.($d2['post_id']+100).'">
                   <span onClick="unarchivelist('.($d2['post_id']+100).')" id="unarchive">...</span>
                   <div class="archive-photolis" id="postlist'.($d2['post_id']+100).'">
                       <div onClick="unarchive('.($d2['post_id']+100).')" class="unacrive">UnArchive</div>
                   </div>
                   <p>'.$d2['post_content'].'</p>
               </div>';
            }
            $str2 .= '</div>';
            echo $str2;
            }
    }else{
        echo'<h2>No activity to show</h2>';
    }   
}
?>


<?php
//////////////////////////////////////////////////////////////////// unarchive post request
if(isset($_POST['unarchivereq'])){
    $pid = ($_POST['unarchivereq']-100);
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
    $res1 = mysqli_query($conn,"UPDATE user_post SET hide_timeline='1' WHERE user_id='$user_id' AND post_id='$pid'");
}
?>