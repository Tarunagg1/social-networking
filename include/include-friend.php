<?php
session_start();
/////// display profile post
include ('dbconf.php');
include_once('functions.php');

;if(isset($_POST['start'] , $_POST['limit'], $_POST['user_id'])){
    $user_data = getuser_info($_SESSION['friendbook']);
    $user_id = $user_data['user_id'];
   $postuser_id = $_POST['user_id'];
   $user_img = $user_data['user_img'];
   $res = "";
  $query = "SELECT * FROM user_post WHERE user_id='$postuser_id' AND post_active='1' AND hide_timeline='1' ORDER BY post_id DESC LIMIT ".$_POST["start"]." , ".$_POST["limit"]."";
   $res = mysqli_query($conn,$query);
   while($row = mysqli_fetch_assoc($res)){
       $fullcontnt = $row['post_content'];
       $id = $row['post_id'];
       $post_userid = $row['user_id'];
       $content = $row['post_content'];
       $post_userres = mysqli_query($conn,"SELECT * FROM registration WHERE user_id='$post_userid'");
       $post_userdata = $post_userres->fetch_assoc();
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
   $("#comment-text-'.$id.'").keyup(function(e){
    if (e.keyCode == 13) {
       value =  $("#comment-text-'.$id.'").val();
       addcomment('.$id.',value);
    }
   })
   $("#Readmore'.$id.'").click(function(){
       $("#normal-text'.$id.'").css("display","none")
       $("#full-text'.$id.'").css("display","block")
   })
   $("#Readless'.$id.'").click(function(){
    $("#full-text'.$id.'").css("display","none")
    $("#normal-text'.$id.'").css("display","block")
   })
   $("#more-operation'.$id.'").click(function(){
       $("#'.$id.'").fadeToggle();
       $(".post-row").on("click",function(){
           $("#'.$id.'").fadeOut();       
       })
   })
   </script>
   ';
   }

}


if(isset($_POST['to_id'])){
    sleep(2);
    $user_data = getuser_info($_SESSION['friendbook']);
    $from_id = $user_data['user_id'];
    $to_id = $_POST['to_id']-100;
    $msg_key = md5(time().$to_id);
    $res = mysqli_query($conn,"INSERT INTO friend_request (`from_id`, `to_id`, `status`) VALUES ('$from_id','$to_id','unaprove')");
    if(!$res){
       echo "failed to send request"; 
    }

}

if(isset($_POST['cancelto_id'])){
    sleep(2);
    $user_data = getuser_info($_SESSION['friendbook']);
    $from_id = $user_data['user_id'];
    $to_id = $_POST['cancelto_id']-100;
    $res = mysqli_query($conn,"DELETE FROM `friend_request` WHERE from_id='$from_id' AND to_id='$to_id'");
    if(!$res){
        echo "Delete fail";
    }
}

if(isset($_POST['deleterequest_id'])){
    sleep(2);
    $req_id = $_POST['deleterequest_id'];
    $res = mysqli_query($conn,"DELETE FROM `friend_request` WHERE id='$req_id'");
    if(!$res){
        echo "Delete fail";
    }
}

if(isset($_POST['confirmreq_id'])){
    $reqid = $_POST['confirmreq_id'];
    $res = mysqli_query($conn,"SELECT * FROM friend_request WHERE id='$reqid'");
    $d = mysqli_fetch_array($res);
    $table_id = $d['id'];
    $from_id = $d['from_id'];
    $to_id = $d['to_id'];
    $secreatkey = md5(time().$from_id);
    $res2 = mysqli_query($conn,"UPDATE friend_request SET status='aprove' WHERE id='$reqid'");
    if($res2){
        $rrr = mysqli_query($conn,"INSERT INTO friend_table (`friend_req_table`,`user_from`,`user_to`,`secreat_key`,`status`) VALUES ('$table_id','$from_id','$to_id','$secreatkey','friend')");
    }
}

?>