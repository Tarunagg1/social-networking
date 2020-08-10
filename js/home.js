////////////////////////////////////////////////////////////////////////////////////// display post data

$(document).ready(function () {
    var limit = 2;
    var start = 0;
    var action = 'inactive';
    function load_data(limit, start) {
        $.ajax({
            url: "include/backendhome.php",
            method: 'POST',
            data: {
                limit: limit,
                start: start,
            },
            cache: false,
            beforeSend: function () {
                $('#load_data_msg').html('<img style="height: 100px; margin-left: 87px;" src="img/loading1.gif" alt="Not Found">');
            },
            success: function (data) {
                $('#postcontainer').append(data)
                if (data != 0) {
                    $('#load_data_msg').html('<img src="img/loading.gif" alt="Not Found">');
                    action = 'inactive';
                } else {
                    $('#load_data_msg').html('<h4>No Recent Post Now</h4><img class="done" src="img/done.gif" alt="Not Found">');
                    action = 'active';
                    allafterpost();
                }
            }
        });
    }
    if (action = 'inactive') {
        action = 'active';
        load_data(limit, start);
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() > $("#postcontainer").height() && action == 'inactive') {
            action = 'active';
            start = start + limit;
            setTimeout(function () {
                load_data(limit, start)
            }, 1000);
        }
    })
});

////////////////////////////////////////////////////////////////// after post

function allafterpost(){
    var alimit = 5;
    var astart = 0;
    var action = 'inactive';
    function load_data(alimit, astart) {
        $.ajax({
            url: "include/backendhome.php",
            method: 'POST',
            data: {
                alimit: alimit,
                astart: astart,
            },
            cache: false,
            beforeSend: function () {
                $('#afterdatamsg').html('<img style="height: 100px; margin-left: 87px;" src="img/loading1.gif" alt="Not Found">');
            },
            success: function (data) {
                $('#afterdata').append(data)
                if (data != 0) {
                    $('#afterdatamsg').html('<img src="img/loading.gif" alt="Not Found">');
                    action = 'inactive';
                } else {
                    $('#afterdatamsg').html('<h1>No More Data Found</h1>');
                    action = 'active';
                }
            }
        });
    }
    if (action = 'inactive') {
        action = 'active';
        load_data(alimit, astart);
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() > $("#afterdata").height() && action == 'inactive') {
            action = 'active';
            astart = astart + alimit;
            setTimeout(function () {
                load_data(alimit, astart)
            }, 1000);
        }
    })
}


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
        $('#file-name').text(imgename)
    }
}
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
                modal.style.display = "none";
            }
        },
        error: function () {
            alert("error is accured");
        }
    });
});


///////////////////////////////////////////// friend fetch
// setInterval(featchfriend,2000)
featchfriend();
function featchfriend() {
    $(document).ready(function () {
        $.ajax({
            url: "include/backend.php",
            type: 'post',
            data: { loadfriend: "laoddata" },
            beforeSend: function () {
                $('#right-user-con').html('<img style="height: 100px; margin-left: 87px;" src="img/loading1.gif" alt="Not Found">');
            },
            success: function (data) {
                $("#right-user-con").html(`${data}`)
            }
        })
    })
}


//////////////////////////////////////////////////////////////////////////// chat box
$(function () {
    $("#chatcontainer").draggable();
});

var intervelid = 0;

function createchatbox(id, friend_id) {
    $("#mainmsg").html(``)
    $.ajax({
        url: "include/backend1.php",
        type: 'post',
        data: { fetch_userdata: id },
        success: function (data) {
            if (data != 0) {
                res = JSON.parse(data);
                $("#chatcontainer").show()
                $("#chatimage").attr("src", "userimages/" + res.img);
                $("#nowfriend").attr("src", "userimages/" + res.img);
                $("#chatname").text(res.name);
                $("#msg").attr("data-id", "jhuyg")
                $("#activestatus").text(`Active   ${res.active}`)
                $("#sendbtn").attr("onclick", `friend(${(friend_id + 100)} , ${res.userid})`);
                fetchchat(`${res.userid}`);
                intervelid = setInterval(() => {
                    fetchchat(`${res.userid}`);
                }, 3000);
            } else {
                alert("something is wrong")
            }
        }
    })
}

function fetchchat(id) {
    $.ajax({
        url: "include/backend1.php",
        type: 'post',
        data: { fetchchat_id: id },
        success: function (data) {
            if (data != 0) {
                $("#mainmsg").html(`${data}`)
                $(".message-box").animate({
                    scrollTop: $("#mainmsg").height()
                },"fast")
            }
        }
    })
}


function friend(friend_id, user_id) {
    msg = $("#msg").val();
    if (msg != "") {
        $.ajax({
            url: "include/backend1.php",
            type: 'post',
            data: { chattoid: user_id, friend_id: friend_id, message: msg },
            success: function (data) {
                if (data == 0) {
                    $("#msg").val('');
                    fetchchat(user_id);
                } else {
                    alert("something is wrong")
                }
            }
        })
    }
}

$("#closechat").click(function () {
    $("#chatcontainer").hide()
    clearInterval(intervelid);
    intervelid = 0;
})

$("#sendimg").click(function () {
    $("#sendchatimg").click();
})

$(".sto").on('click',function(){
    window.location.href =`stories.php`;
})


