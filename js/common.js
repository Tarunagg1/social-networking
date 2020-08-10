////////////////serch 
$(document).ready(function () {
  $('#serch-textbox').keyup(function () {
      serchval = $('#serch-textbox').val()
      if (serchval != 0) {
          $.ajax({
              url: "include/backend1.php",
              method: "POST",
              data: { serchval: serchval },
              success: function (data) {
                  $('#serch-list').fadeIn();
                  $('#serch-ul').html(data);
              }
          });
      } else {
          $('#serch-list').fadeOut();
      }
  });
  $(document).on('click', '.serch-item', function (e) {
      $('#serch-textbox').val($(this).text());
      $('#serch-list').fadeOut();
      serchval = $('#serch-textbox').val()
      window.location = `serch.php?q=${serchval}`
  });
  $('#serch-textbox').keyup(function (e) {
      if (e.keyCode == 13) {
          window.location = `serch.php?q=${serchval}`
      }
  });
///////////////////////////////////////////////////////  display notification
  $.ajax({
    url: "include/backend1.php",
    type: 'post',
    data: { load_notify: "laoddata" },
    success: function (data) {
      $("#notification-list").append(`${data}`)
    }
  })
});


$("#notfy-list").click(function () {
  $("#notification-list").fadeToggle()
})

$("#optiontag").click(function () {
  $("#options").fadeToggle()
})

$("#createtag").click(function () {
  $("#create").fadeToggle()
})

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function () {
  modal.style.display = "block";
}

cp = document.getElementById("create_post");
cp.onclick = function(){
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  $("#postcontent").val("");
  $("#add-image").attr("src","")
  modal.style.display = "none";
}
document.getElementById("add-image-temp").addEventListener('click', function () {
  document.getElementById('postimage').click();
})


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



////////////////////////////////////////////////////// post
function likepost(id) {
  ///////////////////////////////////////////////////// post like ddislike post
  btn = $("#like-btn-" + id);    
  if (btn.hasClass('fa-notlike')) {
      action = "like";
  } else if (btn.hasClass('like-post')) {
      action = "unlike"
  }
  $.ajax({
      url: "include/profile.php",
      type: "post",
      data: { 'like_action': action, 'post_id': id },
      success: function (data) {
          res = JSON.parse(data);
          if (action === 'like') {
              btn.removeClass('fa-notlike');
              btn.addClass('like-post');
          } else if (action === 'unlike') {
              btn.removeClass('like-post');
              btn.addClass('fa-notlike');
          }
          $(".likes" + id).text(res.likes + " Likes");
      }
  })
}

function addcomment(id, value) {
  if (id != "" && value != "") {
      $.ajax({
          url: "include/profile.php",
          type: 'post',
          data: { post_id: id, comment_text: value },
          success: function (data) {
              res = JSON.parse(data)
              $(".comment" + id).text(res.commentcount + " Comment");
              $("#comment-text-" + id).val("")
              commentsection(id);
          }
      })
  } else {
      console.log("enter some text");
  }
}
function commentsection(id) {
  if (id != "") {
      $.ajax({
          url: "include/profile.php",
          type: 'post',
          data: { comment_id: id },
          success: function (data) {
              $("#post-comment-container" + id).html(data);
          }
      })
  } else {
      console.log("enter some text");
  }
  $("#post-comment-container" + id).fadeToggle();
}

