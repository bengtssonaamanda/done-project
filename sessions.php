<?php
require_once('template.php');


$user_ID = "";
$session_ID = session_id();
$page_open = date("Y-m-d H:i:s");
$ip_address = $_SERVER['REMOTE_ADDR'];
$page = $_SERVER['REQUEST_URI'];

if (isset($_SESSION["user_ID"])) {
    $user_ID = $_SESSION["user_ID"];
}


$insert_query = <<<END
    INSERT INTO sessions (user_ID, page_open, ip_address, page)
    VALUES ('$user_ID', '$page_open', '$ip_address', '$page')
END;

$result = $mysqli->query($insert_query);

?>



