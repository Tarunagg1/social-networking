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
});

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

///*////////////////////////serch page
$(document).ready(function () {
    var commentcount = 2;
    $('#view-more-user').click(function () {
        keyword = $('#keyword').val();
        commentcount = commentcount + 2;
        $('.serch-box-main').load('include/backend1.php', {
            commentcount: commentcount, keyword: keyword
        })
    })
})

