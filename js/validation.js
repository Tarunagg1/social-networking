// Registration code
function checkemail() {
  email = $('#email').val();
  $.ajax({
    url: "include/backend.php",
    method: "POST",
    data: { email: email },
    success: function (data) {
      if (data != "") {
        $('#msg').html(data)
        $('#register[type="submit"]').prop('disabled', true);
        // console.log(data);
        // document.getElementById("email").style.border="2px solid red";
      } else {
        $('#register[type="submit"]').prop('disabled', false);
        // document.getElementById("email").style.border="none";
      }
    }
  })
}

function checkuname() {
  username = $('#uname').val();
  $.ajax({
    url: "include/backend.php",
    method: "POST",
    data: { username: username },
    success: function (data) {
      if (data != "") {
        $('#msg1').html(data)
        $('#register[type="submit"]').prop('disabled', true);
        // console.log(data);
        // document.getElementById("uname").style.border="2px solid yellow";
      } else {
        //    document.getElementById("uname").style.border="1px solid blue";
        $('#register[type="submit"]').prop('disabled', false);
      }
    }
  })
}

$(document).ready(function () {
  $("#num").on('blur', function () {
    num = $('#num').val();
    if (num.length != 10) {
      $('#register[type="submit"]').prop('disabled', true);
      document.getElementById("num").style.border = "2px solid red";
    } else {
      $('#register[type="submit"]').prop('disabled', false);
      document.getElementById("num").style.border = "1px solid green";
    }
  })


  $('#validateform').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url: "include/backend.php",
      method: "POST",
      data: $(this).serialize(),
      beforeSend: function () {
        $('#register').prop('disabled', true);
        $('#register').val('Submitting....');
      },
      success: function (data) {
        console.log(data);
        if (data != 0) {
          $('#result').html(data)
          $('#register').val('Register');
          $('#register').prop('disabled', false);
        } else {
          $('#register').val('Thanks For Registration');
          $('#validateform')[0].reset();
          $('#result').html('You’re just one step away…Please click on the verification link we just sent to your Email.');
          $('#register').prop('disabled', true);
        }
      }
    })
  })
})


// Login Code
$('#loginform').on('submit',function(e){
  e.preventDefault();
  email = $('#logid').val()
  pass = $('#logpass').val()
  $.ajax({
    url: "include/backend.php",
    method:"POST",
    data: $(this).serialize(),
    beforeSend:function(){
      $('#login').prop('disabled', true);
      $("#login").addClass('disable');
      $("#login").val("Please Wait..")
    },
    success:function(data){
          if(data != 0){
            alert(data);
            $('#login').prop('disabled', false);
            $("#login").removeClass('disable');
            $("#login").val("Login")
          }else{
            window.location = "home.php";
          }
    }
  })
})

$('#loginform2').on('submit',function(e){
  e.preventDefault();
  email = $('#logid2').val()
  pass = $('#logpass2').val()
  $.ajax({
    url: "include/backend.php",
    method:"POST",
    data: $(this).serialize(),
    beforeSend:function(){
      $('#login2').prop('disabled', true);
      $("#login2").addClass('disable');
      $("#login2").val("Please Wait..")
    },
    success: function (data) {
          if(data != 0){
            alert(data);
            $('#login2').prop('disabled', false);
            $("#login2").removeClass('disable');
            $("#login2").val("Login")
          }else{
                window.location = "home.php";
          }
    }
  })
})

