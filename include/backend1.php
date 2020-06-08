<?php
include ('dbconf.php');
if(isset($_POST['serchval'])){
    $text = $_POST['serchval'];
    $query = "SELECT * FROM registration WHERE username like '%$text%' limit 7";
    $res = mysqli_query($conn,$query);
    $dummytext = '<div class="serch-for">
    <div class="icon-div">
        <i class="fa fa-search" aria-hidden="true"></i>
    </div>
    <li>
        <p>Serch For:- '.$text.'</p>
    </li>
</div>';

    if(mysqli_num_rows($res) > 0){
    while ($data = mysqli_fetch_assoc($res)) {        
        echo "<div class='li'>
        <div class='icon-div'>
            <i class='fa fa-search' aria-hidden='true'></i>
        </div>
        <li> <a href='userprofile.php?userid=".$data['user_id']."'>".$data['username']."</a></li>
    </div>
    ";
    }
    echo $dummytext;  
}else{
    echo "<div class='li'>
    <div class='icon-div'>
        <i class='fa fa-search' aria-hidden='true'></i>
    </div>
    <li> <a href='#'>Data Not Found</a></li>
</div>
";

echo $dummytext;
}
}

?>