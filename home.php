<!DOCTYPE html>
<html>
<head>
      <title>Health Dashboard</title>
        <link rel="stylesheet" type="text/css" href="style1.css">
              <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
              <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          </head>
          <body>
              <div class="banner">
                  <div class="sidebar" id="side">
                      <img src="logovit.png" class="logo">
                      <ul>
                          <br><br>
                          <br><br>
                          <br><br>
                        <li><a href="home.php">Home</a></li>
                        <br>
                        <li><a href="profile.php">Profile</a></li>
                        <br>                       
                        <li><a href="statistic.php">Statistic</a></li>
                        <br>
                        <li><a href="nutrition.php">Nutrition</a></li>
                        <br>
                        <li><a href="workout.php">Workout</a></li>
                        <br>
                        <li><a href="steps.php">Steps</a></li>
                        <br>
                        <li><a href="sleep.php">Sleep</a></li>
                        <br>
                        <li><a href="logout.php">Log out</a></li>
                      </ul>
                   </div>
            <div class="content">
                <h1>Home</h1><br><br>
                <div class="button-grid">
                    <button onclick="location.href='add_water.php'" title="Add a glass of water">
                        <img src="water_glass.png" alt="Water glass" width="60px">
                    </button>
                    <button onclick="location.href='steps.php'" title="Add steps">
                        <img src="shoe.png" alt="Shoe" width="60px">
                    </button>
                    <button onclick="location.href='workout.php'" title="Add workout">
                        <img src="hantel.png" alt="Hantel" width="60px">
                    </button>
                    <button onclick="location.href='sleep.php'" title="Add sleep">
                        <img src="sleep.png" alt="Sleep" width="60px">
                    </button>
                </div>
                <br><br>
                <h2>Manage users</h2>
<?php
include_once('template.php');
require_once('sessions.php');

$userid = $_SESSION['user_ID'];

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

$query = <<<END
    SELECT is_admin
    FROM user
    WHERE user_ID = '$userid'
END;
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_object();
        $isadmin = $row->is_admin;
    }
if (isset($_SESSION["user_ID"]) AND $isadmin == 1) {
    echo $admin;
}
require_once('footer.php');
?>
</div>
</div>
