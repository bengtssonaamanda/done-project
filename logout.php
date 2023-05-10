<?php
require_once('template.php');
require_once('sessions.php');
$_SESSION = array();
session_destroy();
header("Location:landingpage.html");
require_once('footer.php');
?>
