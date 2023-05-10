<?php
require_once('template.php');

$session_ID = session_id();
$user_ID = $_SESSION['user_ID'];
$page_open = date("Y-m-d H:i:s");
$ip_address = $_SERVER['REMOTE_ADDR'];
$page = $_SERVER['REQUEST_URI'];

$insert_query = <<<END
    INSERT INTO sessions (session_ID, user_ID, page_open, page_closed, ip_address, page)
    VALUES ('$session_ID', '$user_ID', '$page_open', NULL, '$ip_address', '$page')
END;

$mysqli->query($insert_query);

$page_closed = date("Y-m-d H:i:s");

$update_query = <<<END
    UPDATE sessions
    SET page_closed='$page_closed', active=0
    WHERE session_ID='$session_ID' AND user_ID='$user_ID'
END;

$mysqli->query($update_query);

?>



