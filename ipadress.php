<!DOCTYPE html> 
<html>
<head>
  <title>Analytics Page</title>
  <link rel="stylesheet" type="text/css" href="style1.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
  </div>
  <div class="content">
    <h1>IP-loggs</h1>
      <h3>Logged visits for specific ip-addresses</h3>
      <p>List sorted from most to least used ip-addess</p>
      <div class="table-box">
<?php
require_once('template.php');

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

$query = "SELECT ip_address, page_open, count(*) AS number_ip FROM sessions GROUP BY ip_address ORDER BY number_ip DESC";
$result = $mysqli->query($query);
$todayDate = date("Y-m-d");
// ändra ip-address i mysql till varchar och inte int
    echo "<table>";
    echo "<tr>
        <th>IP address</th>
        <th>Times logged</th>
        <th>Date for latest visit</th>
    </tr>";

       while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['ip_address']."</td>";
            echo "<td>".$row['number_ip']."</td>";
            echo "<td>".$row['page_open']."</td>";
            echo "<td>";
            echo "</tr>";
        }

require_once('footer.php'); 
?>
    </div>
  </div>
