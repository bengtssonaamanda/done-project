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
    <h1>Workout</h1>
    <h4>Here you can log your workouts and wiew statistics of your finished workouts</h4>
        <div class="login-box">
<?php
require_once('template.php');
require_once('sessions.php');

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

$userid = $_SESSION["user_ID"];
$workout="";
$date="";
$value="";
$calories="";
if (isset($_POST['chose'])) { 
    $workout = $_POST['chose'];
    $value = $mysqli->real_escape_string($_POST['distance']);
    $date = $mysqli->real_escape_string($_POST['date']);
    $calories = $mysqli->real_escape_string($_POST['calories']);
    $sql = <<<END
        INSERT INTO $workout (user_ID,value,date,calories)
        VALUES('$userid','$value','$date','$calories')
END;
    $result = $mysqli->query($sql);
    if ($result == TRUE) {        
        echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }
} 



//select statements
$statistic = "";
$table = "";
$workoutValue="";
$workoutDate="";
$burnedCalories="";

$display = '<h3>Your logged activity</h3>';
if (isset($_POST['workout'])) {
    $table = $_POST['workout'];
    $statistic = $_POST['workout'];
    $query = <<<END
        SELECT * FROM $table 
        WHERE user_ID = $userid AND date >= current_date -7
        ORDER BY date ASC
END;
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $valuearray = array();
        while($row = $result->fetch_assoc()) {
            $workoutValue[] = $row["value"];
            $workoutDate[] = $row["date"];
            $burnedCalories[] = $row["calories"];

}
}
}

// Skriv ut formuläret
$content = <<<END
    <h2>Add activity to your daily log</h2>
    <form action="workout.php" method="post">
    <div class="user-box">
        <label for="chose">Select workout type:</label>
        <select id="chose" name="chose">
            <option value="running">Running</option>
            <option value="gym">Gym</option>
            <option value="riding">Riding</option>
            <option value="swimming">Swimming</option>
            <option value="cycling_distance">Cycling</option>
            <option value="dancing">Dancing</option>
            <option value="jumping_rope">Jumping Rope</option>
            <option value="walked_distance">Walking</option>
        </select>
        </div>
        <br>
        <br>
        <div class="user-box">
        <label for="distance">Distance:</label>
        <input type="text" name="distance">
        </div>
        <br>
        <br>
        <div class="user-box">
        <label for="calories">Calories burned:</label>
        <input type="text" name="calories">
        </div>
        <br>
        <br>
        <div class="user-box">
        <input type="date" name="date"><br><br>
        </div>
        <input type="submit" value="Log activity">
    </form> 
    <br>
    <br>
    <br>
    <h2>Display your logged activity</h2>
    <form action="workout.php" method="post">
    <div class="user-box">
        <label for="workout">Activity:</label>
        <select id="workout" name="workout">
            <option value="running">Running</option>
            <option value="gym">Gym</option>
            <option value="riding">Riding</option>
            <option value="swimming">Swimming</option>
            <option value="cycling_distance">Cycling</option>
            <option value="dancing">Dancing</option>
            <option value="jumping_rope">Jumping Rope</option>
            <option value="walked_distance">Walking</option>
        </select><br>
        </div>
        <br>
        <input type="submit" value="View activity trends">
        </form>
END;
echo $content;
echo $display;
require_once('footer.php');
?>

        <canvas id="myChart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dateData = <?php echo json_encode($workoutDate); ?>;
    const workoutData = <?php echo json_encode($workoutValue); ?>;
    const KCALData = <?php echo json_encode($burnedCalories); ?>;

    const data = {
        labels: dateData,
        datasets: [{
            label: 'Minutes of logged workouts during past week',
            data: workoutData,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
  }]
};
    const config = {
        type: 'line',
        data: data,
};
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
 );
 </script>
        </div>
    </div>
</div>
    </div>

