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
    <h1>Sleep</h1>
    <h3>Here you can log your sleep and daytime naps</h3>
    <div class="login-box"> 
<?php
require_once('template.php'); // detta är en fil som innehåller databasanslutningsuppgifter
require_once('sessions.php');

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

$userid = $_SESSION['user_ID'];
$date = date_create('Y-m-d');

$array="";
$sql = <<<END
    SELECT * FROM sleep2 
    WHERE user_ID = $userid AND date >= current_date - 7
    ORDER BY date ASC
END;
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $valuearray = array();

        while($row = $result->fetch_assoc()) {
            $value[] = $row["value"];
            $dateForSleep[] = $row["date"];

    }
}

$sql2 = <<<END
    SELECT * FROM daytime_naps 
    WHERE user_ID = $userid AND date >= current_date - 7
    ORDER BY date ASC
END;
    $res = $mysqli->query($sql2);
    if ($res->num_rows > 0) {
        $valuearray2 = array();

        while($row = $res->fetch_assoc()) {
            $value2[] = $row["value"];
            $dateForNaps[] = $row["date"];  

    }
}
// print_r($value2);
// print_r($dateForNaps);
if (isset($_POST['sleephours'])) {
  $hours   = $mysqli->real_escape_string($_POST['sleephours']);
  $sleepdate   = $mysqli->real_escape_string($_POST['sleepdate']);
  $query = <<<END
  INSERT INTO sleep2(user_ID,value,date)
  VALUES('$userid','$hours','$sleepdate')
END;
  $mysqli->query($query);
  echo "Sleep is added to your daily log!";
  header("Location: thankspage.html");
  exit();
}

if (isset($_POST['value'])) {
    $naps   = $mysqli->real_escape_string($_POST['value']);
    $napdate   = $mysqli->real_escape_string($_POST['date']);
    $userid = $_SESSION['user_ID'];
    $query = <<<END
    INSERT INTO daytime_naps(user_ID,value,date)
    VALUES('$userid','$naps','$napdate')
END;
    $mysqli->query($query);
    echo "Your nap is added to your daily log!";
    header("Location: thankspage.html");
    exit();
}
$content = <<<END
   <form action="sleep.php" method="POST">
  <div class="user-box">
    <input type="text" id="sleephours" name="sleephours" required>
    <label for="sleephours">How many hours have you slept the previous night?</label>
  </div>
  <div class="user-box">
    <input type="date" id="sleepdate" name="sleepdate" required>
  </div>
  <input type="submit" value="Add sleep">
</form>

<form action="sleep.php" method="POST">
  <div class="user-box">
    <input type="number" id="value" name="value" min="0" required>
    <label for="value">How long was your nap (in minutes)?</label>
  </div>
  <div class="user-box">
    <input type="date" id="date" name="date" required>
  </div>
  <input type="submit" value="Add naps">
</form>
END;

echo $content;
require_once('footer.php');
?>
    
</div>
<div class="login-box">
        <div class="canvasbox" style="width: 450x; height: 250px">
        <canvas id="myChart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

//setup

const sleepdate = <?php echo json_encode($dateForSleep); ?>;
const value = <?php echo json_encode($value);?>;
const data = {
    labels: sleepdate,
        datasets: [{
            label: 'slept hours during the past week',
            data: value,
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
<div class="login-box">
        <div class="canvasbox" style="width: 450px; height: 250px">
        <canvas id="myChart2"></canvas>
<script>
//setup

const napdate = <?php echo json_encode($dateForNaps); ?>;
const value2 = <?php echo json_encode($value2); ?>;
const data1 = {
    labels: napdate,
        datasets: [{
            label: 'minuts of naps taken during the past week',
            data: value2,
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
    </div>
