<!DOCTYPE html>
<html>
<head>
    <title>Health Dashboard - About us</title>
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
      </div>
<div class="content">
    <h2>Nutrition</h2>
    <br>
    <div class="login-box">
    <br>
    <h3>On this page you can log your nutrition and water intake</h3>
    <br>
<?php
require_once('template.php');
require_once('sessions.php');

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

$value ="";
$value2="";
$dateForNutrition="";
$dateForWater="";
$userid = $_SESSION["user_ID"];

if (isset($_POST['water'])) {
    $water   = $mysqli->real_escape_string($_POST['water']);
    $waterdate    = $mysqli->real_escape_string($_POST['waterdate']);
    $query = <<<END
    INSERT INTO water(user_ID,value,date)
    VALUES('$userid','$water','$waterdate')
END;
    $mysqli->query($query);
    echo 'Water intake is added!';
    header("Location: thankspage.html");
}

if (isset($_POST['calories'])) {
    $userid = $_SESSION['user_ID'];
    $calories   = $mysqli->real_escape_string($_POST['calories']);
    $date    = $mysqli->real_escape_string($_POST['date']);
    $query = <<<END
    INSERT INTO nutrition(user_ID,value,date)
    VALUES('$userid','$calories','$date')
END;
    $mysqli->query($query);
    echo 'Nutrition intake is added!';
    header("Location: thankspage.html");
}

$sql = <<<END
    SELECT * FROM nutrition 
    WHERE user_ID = $userid AND date >= current_date - 7
    ORDER BY date ASC
END;
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $valuearray = array();

        while($row = $result->fetch_assoc()) {
            $value[] = $row["value"];
            $dateForNutrition[] = $row["date"];  

    }
}


$sql2 = <<<END
    SELECT * FROM water 
    WHERE user_ID = $userid AND date >= current_date - 7
    ORDER BY date ASC
END;
    $res = $mysqli->query($sql2);
    if ($res->num_rows > 0) {
        $valuearray = array();
        while($row = $res->fetch_assoc()) {
            $value2[] = $row["value"];
            $dateForWater[] = $row["date"];  

    }
}


$content = <<<END
    <form action="nutrition.php" method="post">
<div class="user-box">
  <input type="text" id="calories" name="calories" required>
  <label for="calories">Consumed calories:</label>
</div>
<div class="user-box">
  <input type="date" id="date" name="date" required>
</div>
<input type="submit" value="Log nutrition">
</form>

<form action="nutrition.php" method="post">
<div class="user-box">
  <input type="text" id="water" name="water" required>
  <label for="water">Consumed dl of water:</label>
</div>
<div class="user-box">
  <input type="date" id="waterdate" name="waterdate" required>
</div>
<input type="submit" value="Log water">
</form>
</div>
END;

echo $content;
require_once('footer.php');
?>
<h2>Your past week</h2>
<div class="chart-container">
  <div class="canvasbox" style="width: 450px; height: 250px">
        <canvas id="myChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
//histogram
const waterdate = <?php echo json_encode($dateForWater); ?>;
const value2 = <?php echo json_encode($value2);?>;
const data = {
    labels: waterdate,
        datasets: [{
            label: 'water logged during the past week',
            data: value2,
            borderWidth: 1
        }]
    };

//config
const config = {
    
    type: 'bar',
    data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
 };
  //render
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
 );
  </script>
</div>
</div>
<br><br>
<div class="chart-container">
  <div class="canvasbox" style="width: 450px; height: 250px">
        <canvas id="myChart2"></canvas>

<script>
console.log(<?php echo json_encode($dateForNutrition); ?>);
console.log(<?php echo json_encode($value); ?>);
const nutritiondate = <?php echo json_encode($dateForNutrition); ?>;
const value = <?php echo json_encode($value); ?>;
const data1 = {
    labels: nutritiondate,
        datasets: [{
            label: 'Calories logged during the past week',
            data: value,
            borderWidth: 1
        }]
    };
//config
 const config2 = {
    
    type: 'bar',
    data: data1,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
 };

 //render
 const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
 );
      </script>
</div>
</div>      

    </div>
