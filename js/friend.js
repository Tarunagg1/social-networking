/////////////////////fetch data
$(document).ready(function () {
    var id = $("#friend_id").val();
    var limit = 2;
    var start = 0;
    var action = 'inactive';
    function load_data(limit, start) {    
        $.ajax({
            url: "include/include-friend.php",
            method: 'POST',
            data: {
                limit: limit,
                start: start,
                user_id : id
            },
            cache: false,
            success: function (data) {
                $('#load_data_friend').append(data)
                if (data != 0) {
                    $('#load_data_friend_msg').html('<img src="img/loading.gif" alt="Not Found">');
                    action = 'inactive';
                } else {
                    $('#load_data_friend_msg').html('<h2>No More Data Found<h2>');
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
        if ($(window).scrollTop() + $(window).height() > $("#load_data_friend").height() && action == 'inactive') {
            action = 'active';
            start = start + limit;
            setTimeout(function () {   
                load_data(limit, start)
            }, 1000);
        }
    })

});

function sendrequest(to_id){  
    $.ajax({
        url:"include/include-friend.php",
        method:"post",
        data:{to_id:to_id},
        beforeSend: function () {
            $(".requestbtn"+to_id).prop('disabled', true);
            $(".requestbtn"+to_id).text('Requesting....');
        },
        success:function(data){
            if(data == 0){
                $(".requestbtn"+to_id).addClass("cancelreq");
                $(".requestbtn"+to_id).prop('disabled', false);
                $(".requestbtn"+to_id).text('Cancel Req');
                $(".requestbtn"+to_id).attr("onclick",`cancelreq(${to_id})`);
                $(".requestbtn"+to_id).addClass("delete"+to_id)
            }else{
                $(".requestbtn"+to_id).text('Send Request');
                $(".requestbtn"+to_id).prop('disabled', false);
                console.log("request failed");
            }
        }
    })
}

function cancelreq(cancelto_id){
    $.ajax({
        url:"include/include-friend.php",
        method:"post",
        data:{cancelto_id:cancelto_id},
        beforeSend: function () {
            $(".delete"+cancelto_id).prop('disabled', true);
            $(".delete"+cancelto_id).text('canceling....');
        },
        success:function(data){
            if(data == 0){
                $(".delete"+cancelto_id).text('Send Request');
                $(".delete"+cancelto_id).removeClass("cancelreq");
                $(".delete"+cancelto_id).prop('disabled', false);
                $(".delete"+cancelto_id).attr("onclick",`sendrequest(${cancelto_id})`);
                document.getElementById("delete"+cancelto_id).id = "requestbtn"+cancelto_id;
            }else{
                console.log("request failed");
            }
        }
    })
}

function deleterequest(deleterequest_id){
    $.ajax({
        url:"include/include-friend.php",
        method:"post",
        data:{deleterequest_id:deleterequest_id},
        beforeSend: function () {
            $(".deletereq"+deleterequest_id).prop('disabled', true);
            $(".deletereq"+deleterequest_id).text('deleting....');
        },
        success:function(data){
            if(data == 0){
                $("#deletetab"+deleterequest_id).css("display","none");
            }else{
                $(".deletereq"+deleterequest_id).text('Delete');
                $(".deletereq"+deleterequest_id).prop('disabled', false);
                console.log("request failed");
            }
        }
    })
}


function confirmreq(confirmreq_id){
    $.ajax({
        url:"include/include-friend.php",
        method:"post",
        data:{confirmreq_id:confirmreq_id},
        beforeSend: function () {
            $(".confirm"+confirmreq_id).prop('disabled', true);
            $(".confirm"+confirmreq_id).text('Accepting....');
        },
        success:function(data){
            if(data == 0){
                $("#deletetab"+confirmreq_id).css("display","none");
                $(".confirm"+confirmreq_id).text('Done');
            }else{
                $(".confirm"+confirmreq_id).text('Confirm');
                $(".confirm"+confirmreq_id).prop('disabled', false);
                console.log("request failed");
            }
        }
    })
}
