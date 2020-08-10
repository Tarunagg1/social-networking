
// Get the modal
var stomodal = document.getElementById("stories");

// Get the button that opens the modal
var btn = document.getElementById("addstory");

// Get the <span> element that closes the modal
var span = document.getElementById("close");

// When the user clicks the button, open the modal 
btn.onclick = function () {
    stomodal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    $("#add-story").attr("src", "")
    stomodal.style.display = "none";
}

document.getElementById("add-story-temp").addEventListener('click', function () {
    document.getElementById('storyimg').click();
})


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == stomodal) {
        stomodal.style.display = "none";
    }
}


function imagevalidate() {
    var property = document.getElementById('storyimg').files[0];
    var imgename = property.name;
    var img_exe = imgename.split('.').pop().toLowerCase();
    var img_size = property.size;
    if (jQuery.inArray(img_exe, ['img', 'jpg', 'png', 'jpeg']) == -1) {
        alert("Please Upload File having jpg Png jpeg or img");
        $('#storybtn').prop('disabled', true);
    } else if (img_size > 2000000) {
        alert("Too Large Uploar Less Then 30 Mb");
        $('#storybtn').prop('disabled', true);
    } else {
        $('#storybtn').prop('disabled', false);
    }
}


$('#storyimg').on("change", function () {
    const file = this.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
        $('#add-story').attr('src', e.target.result)
    }
    reader.readAsDataURL(this.files[0])
})

////////////////// create stories  /////////////////////////////////////
$('#addstories').on('submit', function (e) {
    e.preventDefault();
    var property = document.getElementById('storyimg').files[0];
    var form_data = new FormData();
    myimg = $("#myimg").val();
    form_data.append("storyimg", property);
    if (property == 0) {
        alert("upload image")
    } else {
        $.ajax({
            url: "include/storiesbackend.php",
            type: 'post',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#storybtn').prop('disabled', true);
                $('#storybtn').val('Please Wait....');
            },
            success: function (data) {
                if (data != 0) {
                    alert("some thing wrong")
                } else {
                    $('#storybtn').prop('disabled', false);
                    $('#storybtn').val('Add Stories');
                    $("#add-story").attr("src", "")
                    stomodal.style.display = "none";
                    document.getElementById("mystry").innerHTML = `<div data-id="4" class="tab stclick" id="tab">
                    <img src="userimages/${myimg}" alt="User img">
                    <p>View your Stories</p><span>1S</span>
                    <i class="mystac">1 Stories</i>
                </div>`;
                }
            },
            error: function () {
                alert("error is accured");
            }
        });
    }
});


$(".stclick").on('click', function () {
    id = $(this).attr("data-id");
    $.ajax({
        url: "include/storiesbackend.php",
        type: 'post',
        data: { "stid": id },
        success: function (data) {
            res = JSON.parse(data);
            total = res[0];
            current = 0;
            if (current + 1 != total)
                $("#stnextvbtn").removeClass("storybtnnone")
            $("#total").text(total);
            $("#current").text(current + 1);
            $("#stpic").attr("src", "storiesimg/" + res[1][current])
            $("#stnextvbtn").click(function () {
                current++;
                $("#stpic").attr("src", "storiesimg/" + res[1][current])
                $("#current").text(current + 1);
                if (total == current + 1)
                    $("#stnextvbtn").addClass("storybtnnone")
                $("#stprevbtn").removeClass("storybtnnone")
            })
            $("#stprevbtn").click(function () {
                current--;
                $("#stpic").attr("src", "storiesimg/" + res[1][current])
                $("#current").text(current + 1);
                $("#stnextvbtn").removeClass("storybtnnone");
                if (current == 0)
                    $("#stprevbtn").addClass("storybtnnone")
            })
        },
        error: function () {
            alert("error is accured");
        }
    });
    document.getElementById("storycontainer").innerHTML = `<div class="story-imagecon">
    <div class="storydisplay blur">
        <div class="counts">
            <div class="run">
                <p id="current">0</p>
            </div>
            <div class="mid">
                <p>:</p>
            </div>
            <div class="total">
                <p id="total">0</p>
            </div>
        </div>
        <div class="stmove storybtnnone stprevbtn" id="stprevbtn"><i class="fa fa-arrow-left" aria-hidden="true"></i></div>
        <div class="stmove storybtnnone stnextvbtn" id="stnextvbtn"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
        <div class="stmove storybtnclose" onClick="closestd()"><i class="fa fa-window-close" aria-hidden="true"></i></div>
        <div class="stchange">
            <img id="stpic" src="" alt=""srcset="">
        </div>
    </div>
</div>`;
})

function closestd(){
    document.getElementById("storycontainer").innerHTML = `<div class="notstoryid">
    <i class="fa fa-picture-o" aria-hidden="true"></i>
    <h5>Select a story to open.</h5>
</div>`;
}
