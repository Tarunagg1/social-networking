<?php
include ('dbconf.php');
include ('functions.php');

if(isset($_POST['serchval'])){
    $text = $_POST['serchval'];
    $query = "SELECT * FROM registration WHERE username like '%$text%' OR user_email LIKE '%$text%' limit 5";
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
        <li class='serch-item'>".$data['username']."</li>
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

<?php
// Featch serch data from db
include ('dbconf.php');
if(isset($_POST['commentcount'] , $_POST['keyword'])){
        $count = $_POST['commentcount'];
        $keyword = $_POST['keyword'];
         include('dbconf.php');
         $output = "";
         $output .="<h2>People</h2>";
         $query = "SELECT * FROM registration WHERE username LIKE '%$keyword%' OR user_email LIKE '%$keyword%' LIMIT $count";
         $res = $conn->query($query);
 
         while($row = mysqli_fetch_assoc($res)){  
            $output .='<div class="friend-box">
            <img src="img/avatar7.png" alt="">
            <div class="tags">
                <a href="#">'.$row['username'].'</a>
                <p>lihgt hyvtf hbvt hb vv</p>
                <p>jiuhygtfrd jhgf ijuhyg jiuhyg </p>
            </div>
        </div> <div class="seprator"></div>';

        }
        echo $output;
    }
        
?>

