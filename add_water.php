<?php
require_once('template.php');
require_once('sessions.php');

$userid = $_SESSION['user_ID'];

$water_amount = 2;
$waterdate = date("Y-m-d"); 
$query = <<<END
    INSERT INTO water(user_ID,value,date)
    VALUES('$userid','$water_amount','$waterdate')
END;

$mysqli->query($query);

header("Location: thankspage.html");
exit;
?>
