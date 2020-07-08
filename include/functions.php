<?php
include_once('dbconf.php');

function getuser_info($email){
    global $conn;
    $sql = "SELECT * FROM registration WHERE user_email='$email'";
    $res = $conn->query($sql); 
    $data = $res->fetch_assoc();  
    return $data;
}
?>

<?php
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function getuserip(){
    switch(true){
        case (!empty($_SERVER['HTTP_X_REAL_IP'])) :
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
             return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        case (!empty($_SERVER['HTTP_USER_AGENT'])):
        default : return $_SERVER['REMOTE_ADDR'];
    }
}

function enctype($msg,$private_key){
    $key = hex2bin($private_key);
    
    $noncesize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = openssl_random_pseudo_bytes($noncesize);
    $chipertext = openssl_encrypt(
        $msg,
        'aes-256-ctr',
        $key,
        OPENSSL_RAW_DATA,
        $nonce
    );
    return base64_encode($nonce.$chipertext);
}

function decrypt($message,$private_key){
    $key = hex2bin($private_key);
    $message = base64_decode($message);
    $noncesize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = mb_substr($message,0,$noncesize,'8bit');
    $chipertext = mb_substr($message,$noncesize,null,'8bit');
    $plaintext = openssl_decrypt(
         $chipertext,
         'aes-256-ctr',
         $key,
         OPENSSL_RAW_DATA,
         $nonce
    );
      return $plaintext;
   }

 function getuserdataid($id){
     global $conn;
    $res = mysqli_query($conn,"SELECT * FROM registration WHERE user_id='$id'");
    return $res;
 }  

function findpost($id){
    global $conn;
    $query = "SELECT * FROM user_post WHERE user_id='$id' AND post_active='1' AND hide_timeline='1' ORDER BY post_id DESC ";
    $res = mysqli_query($conn,$query);
    return $res;
}
function checkrequest($from_id,$to_id){
    global $conn;
    $data = mysqli_query($conn,"SELECT * FROM friend_request WHERE 	from_id='$from_id' AND to_id='$to_id' AND status='unaprove'");
    if(mysqli_num_rows($data) == 1){
        return true;
    }else{
        return false;
    }
} 

function reciverequest($to_id){
      global $conn;
      $data = mysqli_query($conn,"SELECT * FROM friend_request WHERE to_id='$to_id' AND status='unaprove'");
      return $data;
}

?>