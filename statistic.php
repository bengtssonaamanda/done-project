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
        <div class="text">
        <h1>Statistics</h1>
        <h3>Trends of your fitness and health development</h3></br>
        <p>On this page you can wiew your personal data logged during the past week.</p>
        <p>You are doing a great job with your health development!</p>
        </div>
<?php
require_once('template.php');
require_once('sessions.php');

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

$userid = $_SESSION["user_ID"];


//steps
$steps = <<<END
    SELECT * FROM steps 
    WHERE user_ID = $userid AND date >= current_date - 7 
    ORDER BY date ASC
END;
    $result1 = $mysqli->query($steps);
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            $stepdata[] = $row["value"];
            $stepdate[] = $row["date"];

    }
}  

//Sleep
$sleep = <<<END
    SELECT * FROM sleep2 
    WHERE user_ID = $userid AND date >= current_date - 7  
    ORDER BY date ASC
END;
    $result2 = $mysqli->query($sleep);
    $sleepdata = array();
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $sleepdata[] = $row["value"];
            $sleepdate[] = $row["date"]; 
    }
}  

//naps
$naps = <<<END
    SELECT * FROM daytime_naps 
    WHERE user_ID = $userid AND date >= current_date - 7 
    ORDER BY date ASC  
END;
    $result3 = $mysqli->query($naps);
    if ($result3->num_rows > 0) {
        while($row = $result3->fetch_assoc()) {
            $napdata[] = $row["value"];
            $napdate[] = $row["date"]; 
    }
}  
//nutrition
$nutrition = <<<END
    SELECT * FROM nutrition 
    WHERE user_ID = $userid AND date >= current_date - 7
    ORDER BY date ASC    
END;
    $result4 = $mysqli->query($nutrition);
    if ($result4->num_rows > 0) {
        while($row = $result4->fetch_assoc()) {
            $nutdata[] = $row["value"];
            $nutdate[] = $row["date"]; 
    }
} 
//water 
$water = <<<END
    SELECT * FROM water 
    WHERE user_ID = $userid AND date >= current_date - 7
    ORDER BY date ASC    
END;
    $result5 = $mysqli->query($water);   
    if ($result5->num_rows > 0) {
        while($row = $result5->fetch_assoc()) {
            $waterdata[] = $row["value"];
            $waterdate[] = $row["date"];  
    }
}  
//workouts

$workoutValue="";
$workoutDate="";
$burnedCalories="";

$workoutquery = <<<END
SELECT g.calories, g.date, g.value
FROM gym AS g
LEFT JOIN running AS r ON g.user_ID = r.user_ID AND g.date = r.date
LEFT JOIN cycling_distance AS cd ON g.user_ID = cd.user_ID AND g.date = cd.date
LEFT JOIN dancing AS d ON g.user_ID = d.user_ID AND g.date = d.date
LEFT JOIN jumping_rope AS jr ON g.user_ID = jr.user_ID AND g.date = jr.date
LEFT JOIN riding AS ri ON g.user_ID = ri.user_ID AND g.date = ri.date
LEFT JOIN swimming AS s ON g.user_ID = s.user_ID AND g.date = s.date
LEFT JOIN walked_distance AS wd ON g.user_ID = wd.user_ID AND g.date = wd.date
WHERE g.user_ID = $userid AND g.date >= current_date - 7
ORDER BY g.date ASC;

END;
$result = $mysqli->query($workoutquery);
if ($result->num_rows > 0) {
    $valuearray = array();
    while($row = $result->fetch_assoc()) {
        $workoutValue[] = $row["value"];
        $workoutDate[] = $row["date"];
        $burnedCalories[] = $row["calories"];
    }
}

require_once ('footer.php');
?>

<div class="login-box">
        <div class="canvasbox" style="width: 450px; height: 250px">
            <canvas id="myChart"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const stepdata = <?php echo json_encode($stepdata); ?>;
const stepdate = <?php echo json_encode($stepdate);?>;
    const data = {
    labels: stepdate,
        datasets: [{
            label: 'Steps logged during the past week',
            data: stepdata,
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

const dataForSleep = <?php echo json_encode($sleepdata); ?>;
const dateForSleep = <?php echo json_encode($sleepdate); ?>;
const data1 = {
    labels: dateForSleep,
        datasets: [{
            label: 'Logged hours of sleep during past week',
            data: dataForSleep,
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
    <div class="login-box">
        <div class="canvasbox" style="width: 450px; height: 250px">
        <canvas id="myChart3"></canvas>
<script>

const dateForWorkout = <?php echo json_encode($workoutDate); ?>;
const valueForWorkout = <?php echo json_encode($workoutValue); ?>;
const kcalForWorkout = <?php echo json_encode($burnedCalories); ?>;
   
    const data3 = {
        labels: dateForWorkout,
        datasets: [{
            label: 'Minutes of logged gym workouts during past week',
            data: valueForWorkout,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
};
const config3 = {
        type: 'line',
        data: data3,
};
    const myChart3 = new Chart(
        document.getElementById('myChart3'),
        config3
 );
            </script>
        </div>
    </div>
    <div class="login-box">
        <div class="canvasbox" style="width: 450px; height: 250px">
            <canvas id="myChart4"></canvas>
<script>

const nutritionDate = <?php echo json_encode($nutdate); ?>;
const nutritionData = <?php echo json_encode($nutdata); ?>;

const data4 = {
    labels: nutritionDate,
        datasets: [{
            label: 'Calories logged during the past week',
            data: nutritionData,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
}]
};
const config4 = {
    type: 'line',
        data: data4,
};
const myChart4 = new Chart(
        document.getElementById('myChart4'),
        config4
);
            </script>
        </div>
    </div>
    <!-- <div class="login-box">
        <div class="canvasbox" style="width: 450px; height: 250px">
            <canvas id="myChart5"></canvas>
<script>
const dataForWater = <?php echo json_encode($waterdata); ?>;
const dateForWater = <?php echo json_encode($waterdate); ?>;
const data5 = {
    labels: dateForWater,
        datasets: [{
            label: 'Deciliters of water logged during the past week',
            data: dataForWater,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
}]
}
const config5 = {
    type: 'line',
        data: data5,
};
const myChart5 = new Chart(
        document.getElementById('myChart5'),
        config4
);
    </script>
        </div>
    </div>   -->
</div>
