/////////////////////fetch data
$(document).ready(function () {
    var limit = 2;
    var start = 0;
    var action = 'inactive';
    function load_data(limit, start) {
        $.ajax({
            url: "include/profile.php",
            method: 'POST',
            data: {
                limit: limit,
                start: start
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

});

///////////////add Post
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
                $("#load_data").load("include/backend1.php", {
                    limit: 2,
                    start: 0
                })
                modal.style.display = "none";
            }
        },
        error: function () {
            alert("error is accured");
        }
    });
});

///////////////////////save bio
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
                }
            }
        })
    }

})
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

