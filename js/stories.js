
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
                    $("#mystry").html(` <div class="tab" id="tab">
                    <img src="userimages/${myimg}" alt="User img">
                    <p>View your Stories</p><span>1S</span>
                    <i class="mystac">1 Stories</i>
                </div>`);
                }
            },
            error: function () {
                alert("error is accured");
            }
        });
    }
});


$(".stclick").on('click',function(){
    id = $(this).attr("data-id");
    console.log(id);
    $("#storycontainer").html(` <div class="story-imagecon">
    <div class="storydisplay blur">
        <img id="coverpic" src="userimages/9713d3e30be4096f6520df83b1c91147.jpeg" alt="Not Found" srcset="">
    </div>
</div>`)
})