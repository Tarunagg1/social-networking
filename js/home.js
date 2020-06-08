$(document).ready(function(){
    $('#serch-textbox').keyup(function(){
         serchval = $('#serch-textbox').val()
         console.log(serchval);
         
         if(serchval != 0){
             console.log("ajax req");
             $.ajax({
                 url:"include/backend1.php",
                 method:"POST",
                 data:{serchval:serchval},
                 success: function(data){
                     $('#serch-list').fadeIn();
                     console.log(data);
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

// // model code
// // Get the modal
// var modal = document.getElementById("myModal");

// // Get the button that opens the modal
// var btn = document.getElementById("myBtn");

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks the button, open the modal 
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
// // end model code
