<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" property="stylesheet" type="text/css" href="/css/style1.css">
    <meta charset="utf-8">
    <title>Health Dashboard</title>
</head>
<body>
<?php
session_name("website");
session_start();
$host = "localhost";
$user       = "amavah22"; 
$pwd        = "ZcDMC6NvjX";
$db         = "amavah22_db"; 
$mysqli     = new mysqli($host, $user, $pwd, $db);
$navigation =<<<END
<nav>
    <a href="about.php">About</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
END;

if (isset($_SESSION['user_ID'])) {
  $navigation .=<<<END
            <ul>
                <br><br>
                <br><br>
                <br><br>
              <li><a href="profile.php">Profile</a></li>
              <br>
              <li><a href="statistic.php">Statistic</a></li>
              <br>
              <li><a href="nutrition.php">Nutrition</a></li>
              <br>
              <li><a href="workout.php">Workout</a></li>
              <br>
              <li><a href="sleep.php">Sleep</a></li>
              <br>
              <li><a href="logout.php">Log out</a></li>
          </ul>
END;
}
if (!isset($_SESSION['user_ID'])) {
    $navigation .=<<<END
    <a href="login.php">Login</a>
END;
}
$admin =<<<END
<button type="button"><a href="admin.php"><span></span>Administration</a></button>
END;

$navigation .='</nav>';

?>
