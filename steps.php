<!DOCTYPE html>
<html>
<head>
    <title>Health Dashboard - Steps</title>
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
    <h1>Steps</h1>
    <h3>Here you can log your daily steps</h3>
    <div class="login-box">

<?php
require_once('template.php'); // detta är en fil som innehåller databasanslutningsuppgifter
require_once('sessions.php');

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

$userid = $_SESSION['user_ID'];
$date = new DateTime();
$array="";
if (isset($_POST['date1'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $sql = <<<END
        SELECT * FROM steps 
        WHERE user_ID = $userid AND date BETWEEN '$date1' AND '$date2'
        ORDER BY date ASC
END;
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $valuearray = array();

        while($row = $result->fetch_assoc()) {
            $value[] = $row["value"];
            $stepdate[] = $row["date"];

    }

}
}

if (isset($_POST['steps'])) {
  $steps   = $mysqli->real_escape_string($_POST['steps']);
  $date   = $mysqli->real_escape_string($_POST['date']);
  $query = <<<END
  INSERT INTO steps(user_ID,value,date)
  VALUES('$userid','$steps','$date')
END;
  $mysqli->query($query);
  echo "Steps is added to your dayly log!";
  header("Location: thankspage.html");
  exit();
}

$content = <<<END
   <form action="steps.php" method="POST">
<div class="user-box">
  <input type="text" id="steps" name="steps" required>
  <label for="steps">Insert daily steps:</label>
</div>
<div class="user-box">
  <input type="date" id="date" name="date" required>
</div>
<input type="submit" value="Add Steps">
</form>
END;
$show_stat = <<<END
    <br>
    <br>
    <h3>Insert date to view daily steps</h3><br>
    <form action="steps.php" method="POST">
        <div class="user-box">
            <input type="date" name="date1" required> 
        </div>
        <div class="user-box">
            <input type="date" id="date" name="date2" required>
        </div>
<input type="submit" value="View Steps">
</form>
END;
echo $content;
echo $show_stat;
require_once('footer.php');
?>
    
</div>
<div class="login-box">
        <div class="canvasbox" style="width: 450px; height: 250px">
        <canvas id="myChart"></canvas>
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

//setup

const stepdate = <?php echo json_encode($stepdate); ?>;
const value = <?php echo json_encode($value);?>;
const data = {
    labels: stepdate,
        datasets: [{
            label: 'Steps taken',
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

