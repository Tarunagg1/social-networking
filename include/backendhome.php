<?php
session_start();
/////// display profile post
include ('dbconf.php');
include_once('functions.php');
if(isset($_POST['start'] , $_POST['limit'])){
    $user_data = getuser_info($_SESSION['friendbook']);
   $user_id = $user_data['user_id'];
   $user_img = $user_data['user_img'];
   $lasttime = $user_data['user_lastseen'];
   $res = "";
   $res = mysqli_query($conn,"SELECT * FROM friend_table WHERE user_from='$user_id' OR 	user_to='$user_id' AND `status`='friend'");
        if(mysqli_num_rows($res) > 0){ 
         while($row = mysqli_fetch_array($res)){
             $finalid = $row['user_from'];
             if($finalid == $user_id)
                 $finalid = $row['user_to'];
            $query = "SELECT * FROM user_post WHERE user_id='$finalid' AND post_active='1' AND hide_timeline='1' AND `time`>='$lasttime' ORDER BY post_id DESC LIMIT ".$_POST["start"]." , ".$_POST["limit"]."";
            $postres = mysqli_query($conn,$query);
            while($row = mysqli_fetch_array($postres)){
                $fullcontnt = $row['post_content'];
                $id = $row['post_id'];
                $uid = $row['user_id'];
                $dd = mysqli_fetch_array(getuserdataid($uid));
                $uname = $dd['username'];
                $user_img1 = $dd['user_img'];
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
                echo '<div class="posts">
                <div class="post-header">
                    <img src="userimages/'.$user_img1.'" alt="">
                    <a href="friend.php?id='.($uid+100).'" id="name">'.$uname.'</a>
                    <p id="time">'.get_time_ago($row['time']).'</p>
                </div>
                <div class="post-text">
                    <p>'.$content.'</p>
                    <p id="full-text'.$id.'" style="display:none;">'.$fullcontnt.'...<span class="readless" id="Readless'.$id.'">ReadLess</span>'.'</p>
                </div>
                <div class="img">
                    <img src="userimages/'.$img.'" alt="">
                </div>
                <div class="post-counts">
                <span id="likes" class="likes'.$id.'">'.$count_like.' likes</span><span onClick="commentsection('.$id.')" class="comment'.$id.'" id="comment">'.$comment_count.' Comments</span> <span id="share">20
                        shares</span>
                </div>
                <hr>
                <div class="post-actions">
                 <button class="p-btn" onClick="likepost('.$id.')" ><i id="like-btn-'.$id.'" class="fa fa-thumbs-up '.$likeclass.'" aria-hidden="true"></i> Like</button>
                    <button onClick="commentsection('.$id.')" class="p-btn"><i class="fa fa-comments-o" aria-hidden="true"></i> Comment</button>
                    <button class="p-btn"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</button>
                </div>
                <hr>
                <div class="write-comment">
                    <img src="userimages/'.$user_img.'" alt="comment-img">
                    <input type="text" id="comment-text-'.$id.'" placeholder="Write a comment">
                </div>
                <div class="post-comment-container" id="post-comment-container'.$id.'">
                <div id="row">
                </div></div>
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
                </script>
                ';       
            }
  }
}
}


if(isset($_POST['astart'] , $_POST['alimit'])){
  $user_data = getuser_info($_SESSION['friendbook']);
 $user_id = $user_data['user_id'];
 $user_img = $user_data['user_img'];
 $lasttime = $user_data['user_lastseen'];
 $res = "";
 $res = mysqli_query($conn,"SELECT * FROM friend_table WHERE user_from='$user_id' OR 	user_to='$user_id' AND `status`='friend'");
      if(mysqli_num_rows($res) > 0){ 
       while($row = mysqli_fetch_array($res)){
           $finalid = $row['user_from'];
           if($finalid == $user_id)
               $finalid = $row['user_to'];
          $query = "SELECT * FROM user_post WHERE user_id='$finalid' AND post_active='1' AND hide_timeline='1' AND `time`<='$lasttime' ORDER BY post_id DESC LIMIT ".$_POST["astart"]." , ".$_POST["alimit"]."";
          $postres = mysqli_query($conn,$query);
          while($row = mysqli_fetch_array($postres)){
              $fullcontnt = $row['post_content'];
              $id = $row['post_id'];
              $uid = $row['user_id'];
              $dd = mysqli_fetch_array(getuserdataid($uid));
              $uname = $dd['username'];
              $user_img1 = $dd['user_img'];
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
              echo '<div class="posts">
              <div class="post-header">
                  <img src="userimages/'.$user_img1.'" alt="">
                  <a href="friend.php?id='.($uid+100).'" id="name">'.$uname.'</a>
                  <p id="time">'.get_time_ago($row['time']).'</p>
              </div>
              <div class="post-text">
                  <p>'.$content.'</p>
                  <p id="full-text'.$id.'" style="display:none;">'.$fullcontnt.'...<span class="readless" id="Readless'.$id.'">ReadLess</span>'.'</p>
              </div>
              <div class="img">
                  <img src="userimages/'.$img.'" alt="">
              </div>
              <div class="post-counts">
              <span id="likes" class="likes'.$id.'">'.$count_like.' likes</span><span onClick="commentsection('.$id.')" class="comment'.$id.'" id="comment">'.$comment_count.' Comments</span> <span id="share">20
                      shares</span>
              </div>
              <hr>
              <div class="post-actions">
               <button class="p-btn" onClick="likepost('.$id.')" ><i id="like-btn-'.$id.'" class="fa fa-thumbs-up '.$likeclass.'" aria-hidden="true"></i> Like</button>
                  <button onClick="commentsection('.$id.')" class="p-btn"><i class="fa fa-comments-o" aria-hidden="true"></i> Comment</button>
                  <button class="p-btn"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</button>
              </div>
              <hr>
              <div class="write-comment">
                  <img src="userimages/'.$user_img.'" alt="comment-img">
                  <input type="text" id="comment-text-'.$id.'" placeholder="Write a comment">
              </div>
              <div class="post-comment-container" id="post-comment-container'.$id.'">
              <div id="row">
              </div></div>
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
              </script>
              ';       
          }
}
}
}
?>