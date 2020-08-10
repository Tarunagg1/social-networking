/////////////////////fetch data
$(document).ready(function () {
    loadprofiledata(0,2);  
});

function loadprofiledata(s,l) {
    var limit = l;
    var start = s;
    var action = 'inactive';
    function load_data(limit, start) {
        $.ajax({
            url: "include/profile.php",
            method: 'POST',
            data: {
                limit: limit,
                start: start,
            },
            cache: false,
            success: function (data) {                
                $('#load_data').append(data)
                if (data != 0) {
                    $('#load_data_msg').html('<img src="img/loading.gif" alt="Not Found">');
                    action = 'inactive';
                } else {
                    $('#load_data_msg').html('<h2>No More Data Found<h2>');
                    action = 'active';
                }
            }
        });
    }
    if (action = 'inactive') {
        action = 'active';
        load_data(limit, start);
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
            action = 'active';
            start = start + limit;
            setTimeout(function () {
                load_data(limit, start)
            }, 1000);
        }
    })
}

/////////////// create Post
$('#postimage').on("change", function () {
    const file = this.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
        $('#add-image').attr('src', e.target.result)
    }
    reader.readAsDataURL(this.files[0])
})

$('#createpost').on('submit', function (e) {
    e.preventDefault();
    var property = document.getElementById('postimage').files[0];
    content = $('#postcontent').val();
    var form_data = new FormData();
    form_data.append("imagefile", property);
    form_data.append("content", content);
    $.ajax({
        url: "include/backend.php",
        type: 'post',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#postbutton').prop('disabled', true);
            $('#postbutton').val('Please Wait....');
        },
        success: function (data) {
            if (data != 0) {
                alert("some thing wrong")
            } else {
                content = $('#postcontent').val("");
                $('#postbutton').prop('disabled', false);
                $('#postbutton').val('Post');
                var modal = document.getElementById("myModal");
                loadprofiledata(0,2);  
                modal.style.display = "none";
            }
        },
        error: function () {
            alert("error is accured");
        }
    });
});

///////////////////////save bio
form = document.getElementById('form-bio')
document.getElementById('addbio').addEventListener('click', function () {
    form.style.display = "block";
})
document.getElementById('save-bio').addEventListener('click', function () {
    form.style.display = "none";
});
document.getElementById('cancel-bio').addEventListener('click', function () {
    form.style.display = "none";
});



$(document).ready(function () {
    $('#save-bio').prop('disabled', true)
    $("#bio-text").keyup(function () {
        max = 100;
        var length = $(this).val().length;
        length = max - length;
        $('#char-rem').html(`${length} characters remaining`)
        if (length == 0) {
            $('#save-bio').removeClass('save')
            $('#save-bio').addClass('nosave');
            $('#save-bio').prop('disabled', true)
        }
        if (length > 0) {
            $('#save-bio').removeClass('nosave');
            $('#save-bio').addClass('save')
            $('#save-bio').prop('disabled', false)
        }
        if (length <= 0) {
            $('#save-bio').removeClass('save')
            $('#save-bio').addClass('nosave');
            $('#save-bio').prop('disabled', true)
        }
    })
    $('#save-bio').click(function () {
        var biocontent = $('#bio-text').val();
        $.ajax({
            url: "include/profile.php",
            method: "POST",
            data: { biocontent: biocontent },
            success: function (data) {
                if (data == 1) {
                    $('#bio-text-display').html(`<pre>${biocontent}</pre>`);
                    if (biocontent.length == 0) {
                        $('#addbio').text("Add Bio")
                    } else {
                        $('#addbio').text("Edit Bio")

                    }
                } else {
                    alert("something Wrong");
                }

            }
        })

    })
})

///////////////////////////////////profile pic or cover pic
$('#edit-profile-pic').on('click', function () {
    $('#profile-pic-list').fadeToggle();
})
$('#profile-uploder').on('change', function () {
    var property = document.getElementById("profile-uploder").files[0];
    var imgename = property.name;
    var img_exe = imgename.split('.').pop().toLowerCase();
    if (jQuery.inArray(img_exe, ['img', 'jpg', 'jpeg', 'gif', 'png']) == -1) {
        alert("Upload Only Img , jpg , jpeg , png, or gif")
    } else {
        var form_data = new FormData();
        form_data.append("where", "profile");
        form_data.append("picname", property);
        $.ajax({
            url: "include/profile.php",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data == 'error') {
                    alert("Some Error")
                } else {
                    $('#profilepic').attr("src", "userimages/" + data)
                    $('#send-post-img').attr("src", "userimages/" + data)
                }
            }
        })
    }

})

function imagevalidate() {
    var property = document.getElementById('postimage').files[0];
    var imgename = property.name;
    var img_exe = imgename.split('.').pop().toLowerCase();
    var img_size = property.size;
    if (jQuery.inArray(img_exe, ['img', 'jpg', 'png', 'jpeg']) == -1) {
        alert("Please Upload File having jpg Png jpeg or img");
        $('#postbutton').prop('disabled', true);
    } else if (img_size > 2000000) {
        alert("Too Large Uploar Less Then 3 Mb");
        $('#postbutton').prop('disabled', true);
    } else {
        $('#postbutton').prop('disabled', false);
        $('#file-name').text()
    }
}

////////////////////edit cover
$('#edit-cover-pic').on('click', function () {
    $('#cover-pic-list').fadeToggle();
    $('.col').click(function () {
        $('#cover-pic-list').fadeOut();
    })
    $('#cover-uploder').on('change', function () {
        var pro = document.getElementById("cover-uploder").files[0];
        var imgname = pro.name;
        var exe = imgname.split('.').pop().toLowerCase();
        if (jQuery.inArray(exe, ['img', 'jpg', 'jpeg', 'gif', 'png']) == -1) {
            alert("Upload Only Img , jpg , jpeg , png, or gif")
        } else {
            var form_data = new FormData();
            form_data.append("where", "cover");
            form_data.append("picname", pro);
            $.ajax({
                url: "include/profile.php",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data == 'error') {
                        alert("Some Error")
                    } else {
                        $('#coverpic').attr("src", "userimages/" + data)
                    }
                }
            })
        }
    })
})

$('#delete-profile-pic').click(function () {
    $.ajax({
        url: "include/profile.php",
        method: "post",
        data: { deletepic: "profile" },
        success: function (data) {
            $("#profilepic").attr("src", "userimages/temp-user.png");
            $("#send-post-img").attr("src", "userimages/temp-user.png");
        }
    })
})
$('#delete-cover-pic').click(function () {
    $.ajax({
        url: "include/profile.php",
        method: "post",
        data: { deletepic: "cover" },
        success: function (data) {
            $("#coverpic").attr("src", "userimages/blackbener.jpg");
        }
    })
})

$('#upload-cover-pic').on('click', function () {
    $('#cover-uploder').click();
})

$('#upload-profile-pic').on('click', function () {
    $('#profile-uploder').click();
})

function deletepost(id) {
    $("#row" + id).css("display", "block")
    confres = confirm("Are You Really Want to delete This Post")
    if (confres) {
        $.ajax({
            url: "include/profile.php",
            method: "post",
            data: { deletepst: id },
            success: function (data) {
                $("#row" + id).hide();
            }
        })
    }
}

function hidetimelinepost(id) {
    retval = "";
    $.ajax({
        url: "include/profile.php",
        method: "post",
        data: { hidetimeline: id },
        success: function (data) {
            $("#row" + id).hide();
        }
    })
}

function editpost(id) {
    ///////////////////edit post data
    $.ajax({
        url: "include/profile.php",
        method: "post",
        data: { edit_post_id: id },
        dataType: "JSON",
        success: function (data) {
            if (data != '') {
                $('#editmyModal').css("display", "block");
                $('#editpostcontent').val(data['post_content'])
                $('#editpostid').val(data['post_id']);
                $('#post-image').attr("src", "userimages/" + data['post_img'])
                $('#editfile-name').text(data['post_img'])
                $('#edit-image-temp').on('click', function () {
                    $('#editpostimage').click();
                })
                $('#editpostimage').on("change", function () {
                    var property = document.getElementById('editpostimage').files[0];
                    var imgename = property.name;
                    var img_exe = imgename.split('.').pop().toLowerCase();
                    var img_size = property.size;
                    if (jQuery.inArray(img_exe, ['img', 'jpg', 'png', 'jpeg']) == -1) {
                        alert("Please Upload File having jpg Png jpeg or img");
                        $('#editpostbutton').prop('disabled', true);
                    } else if (img_size > 2000000) {
                        alert("Too Large Uploar Less Then 3 Mb");
                        $('#editpostbutton').prop('disabled', true);
                    } else {
                        $('#editpostbutton').prop('disabled', false);
                        $('#edit-image-temp').text(imgename)
                        const file = this.files[0];
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            $('#post-image').attr('src', e.target.result)
                            //$('#editfile-name').text(file)
                        }
                        reader.readAsDataURL(this.files[0])
                    }
                })
            }
        }
    })
    var modal = document.getElementById("editmyModal");
    $('.close').click(function () {
        $('#editmyModal').css("display", "none")
    })
    window.onclick = function (event) {
        if (event.target == modal) {
            $('#editmyModal').css("display", "none")
        }
    }

}

////////////////////// edit form submit
$('#editpost').on('submit', function (e) {
    e.preventDefault();
    var property = document.getElementById('editpostimage').files[0];
    content = $('#editpostcontent').val();
    id = $('#editpostid').val();
    var edit_form_data = new FormData();
    edit_form_data.append("editimagefile", property);
    edit_form_data.append("editcontent", content);
    edit_form_data.append("post_id", id);
    $.ajax({
        url: "include/profile.php",
        type: 'post',
        data: edit_form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#editpostbutton').prop('disabled', true);
            $('#editpostbutton').val('Please Wait....');
        },
        success: function (data) {
            console.log(data);
            if (data == 0) {
                alert("SomeThing Went To Wrong Try Again")
            } else {
                $("#normal-text" + id).text(content)
                $("#post_img" + id).attr("src", "userimages/" + data)
                $('#editpostbutton').prop('disabled', false);
                $('#editpostbutton').val('Update Post');
                var modal = document.getElementById("editmyModal");
                modal.style.display = "none";
            }
        },
        error: function () {
            alert("error is accured");
        }
    });
});

////////////////////////////////////////////////////////////////////////////////    profile division
let whichactive = "timeline";

$("#viewfriend").on('click', function () {
    $(`#${whichactive}`).removeClass("profileactive")
    whichactive = "viewfriend";
    $("#viewfriend").addClass("profileactive")
    $.ajax({
        url: "include/profile.php",
        method: "post",
        data: {
            loadfirend: "loadfriend"
        },
        success: function (data) {
            $("#profile-main").html(`<div class="view-friend-list">
    <div class="friend-all-header">
        <h1>Friends</h1>
        <div class="ff">
            <a href="friend.php"> <button class="friend-ope">Friend Request</button> </a>
            <a href="friend.php"> <button class="friend-ope">Find Friend</button> </a>
        </div>
    </div>
    <div class="friend-all-body-main">
        ${data}
    </div>
</div>`);
        }
    })
})

$("#about").on('click', function () {
    $(`#${whichactive}`).removeClass("profileactive")
    whichactive = "about";
    $("#about").addClass("profileactive")
    $("#profile-main").load('include1/about.php');
})

$("#aboutbtn").click(function () {
    $("#about").click();
})
$("#EditDetails").click(function () {
    $("#about").click();
})

$("#archive").on('click', function () {
    $(`#${whichactive}`).removeClass("profileactive")
    whichactive = "archive";
    $("#archive").addClass("profileactive")
    $.ajax({
        url: "include/profile.php",
        method: "post",
        data: {
            loadrechive: "loadfriend"
        },
        success: function (data) {
            $("#profile-main").html(` <div class="view-friend-list">
            <div class="friend-all-header">
                <h1>Archive</h1>
                <div class="ff">
                    <a href="friend.php"> <button class="friend-ope">Friend Request</button> </a>
                    <a href="friend.php"> <button class="friend-ope">Find Friend</button> </a>
                </div>
            </div>
            <div class="profile-forphotoarchive">
              ${data}               
            </div>
            <!-- <h2>No activity to show</h2> -->
        </div>`);
        }
    })
})

$("#photos").on('click', function () {
    $(`#${whichactive}`).removeClass("profileactive")
    whichactive = "photos";
    $("#photos").addClass("profileactive")
    $.ajax({
        url: "include/profile.php",
        method: "post",
        data: {
            loadfirendphotos: "loadfriend"
        },
        success: function (data) {
            $("#profile-main").html(`<div class="profile-forphoto">
            <h1>Photos For You</h1>
            ${data}
            </div>`);
        }
    })
})

//////////////////////////////////////////////////////////////////////////////// archive post unarchive

function unarchivelist(id) {
    $(`#postlist${id}`).fadeToggle();
}

function unarchive(id) {
    $.ajax({
        url: "include/profile.php",
        method: "post",
        data: { unarchivereq: id },
        success: function (data) {
            console.log(data);
            if (data == 0) {
                $(`#archivepost${id}`).hide();
            }
        }
    })
}

$("#viwephoto").on('click', function () {
    $("#photos").click();
})

$("#viewallfrnd").on('click', function () {
    $("#viewfriend").click();
})

