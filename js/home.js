$(document).ready(function(){
    $('#serch-textbox').keyup(function(){
         serchval = $('#serch-textbox').val()         
         if(serchval != 0){
             $.ajax({
                 url:"include/backend1.php",
                 method:"POST",
                 data:{serchval:serchval},
                 success: function(data){
                     $('#serch-list').fadeIn();
                    $('#serch-ul').html(data);
                 }
             });
         }else{
            $('#serch-list').fadeOut();
         }
    });
    $(document).on('click', 'li', function (){
        $('#serch-textbox').val($(this).text());
        $('#serch-list').fadeOut();
    });
});

function imagevalidate(){
    var  property = document.getElementById('postimage').files[0];
    var imgename = property.name;
    var img_exe = imgename.split('.').pop().toLowerCase();
    var img_size = property.size;
    if(jQuery.inArray(img_exe,['img','jpg','png','jpeg']) == -1){
          alert("Please Upload File having jpg Png jpeg or img");   
          $('#postbutton').prop('disabled', true);
    }else if(img_size > 20000){
                alert("Too Large Uploar Less Then 3 Mb");
                $('#postbutton').prop('disabled', true);
    }else{
            $('#postbutton').prop('disabled', false);
    } 
}

$('#createpost').on('submit',function(e){   
    e.preventDefault();
    var  property = document.getElementById('postimage').files[0];
    content = $('#postcontent').val();
    var form_data = new FormData();
    form_data.append("imagefile",property); 
    form_data.append("content",content);
    $.ajax({
        url:"include/backend.php",
        type: 'post',
        data: form_data,
        contentType:false,
        cache:false,
        processData:false,
        beforeSend: function () {
            $('#postbutton').prop('disabled', true);
            $('#postbutton').val('Please Wait....');
          },
          success: function (data) {  
              console.log(data);
                 
              if(data != 0){
                  alert("some thind wrong")
              }else{
                content = $('#postcontent').val("");
                $('#postbutton').prop('disabled', false);
                $('#postbutton').val('Post');
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
              }
          },
          error:function(){
              alert("error is accured");
       }
    }); 
});
