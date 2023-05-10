<?php
require_once('template.php');
$userid = $_SESSION['user_ID'];
$date = new DateTime();

function stepdata(){
    require_once('template.php');
    $userid = $_SESSION['user_ID'];
    $date = new DateTime();
    $sql = <<<END
        SELECT * FROM steps 
        WHERE user_ID = $userid
END;
$res = $mysqli->query($sql);
$stepdata = array();
if ($res->num_rows > 0) {
    while($row = $res->fetch_array(MYSQLI_BOTH))     
        $steparray[] = $row;
}
}


?>