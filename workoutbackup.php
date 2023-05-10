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
        <div class="content">
<?php
require_once('template.php');

$userid = $_SESSION["user_ID"];
$workout = $_POST['chose'];

if ($workout == "running") { 
    $runvalue = $_POST['distance'];
    $rundate = $_POST['date'];
    $runcalories = $_POST['calories'];
    $qrunning = <<<END
        INSERT INTO running (user_ID,value,date,calories)
        VALUES('$userid','$runvalue','$rundate','$runcalories')
END;
    $result = $mysqli->query($qrunning);
    if ($result == TRUE) {        
        echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }
} 

if ($workout == "gym") {
    $gymvalue = $_POST['distance'];
    $gymdate = $_POST['date'];
    $gymcalories = $_POST['calories'];
    $qgym = <<<END
        INSERT INTO gym (user_ID,value,date,calories)
        VALUES('$userid','$gymvalue','$gymdate','$gymcalories')
END;
    $result = $mysqli->query($qgym);
    if ($result == TRUE) {        
        echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }
}
if ($workout == "riding") {
    $ridevalue = $_POST['distance'];
    $ridedate = $_POST['date'];
    $ridecalories = $_POST['calories'];
    $qriding = <<<END
        INSERT INTO riding (user_ID,value,date,calories)
        VALUES('$userid','$ridevalue','$ridedate','$ridecalories')
END;
    $result = $mysqli->query($qriding);
    if ($result == TRUE) {
    echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }
}
if ($workout == "swimming") { 
    $swimmvalue = $_POST['distance'];
    $swimmdate = $_POST['date'];
    $swimmcalories = $_POST['calories'];   
    $qswimming = <<<END
        INSERT INTO swimming (user_ID,value,date,calories)
        VALUES('$userid','$swimmvalue','$swimmdate','$swimmcalories')
END;
    $result = $mysqli->query($qswimming);
    if ($result == TRUE) {        
        echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }
}
if ($workout == "cycling_distance") {
    $cyclevalue = $_POST['distance'];
    $cycledate = $_POST['date'];
    $cyclecalories = $_POST['calories'];
    $qcycle = <<<END
        INSERT INTO cycling_distance (user_ID,value,date,calories)
        VALUES('$userid','$cyclevalue','$cycledate','$cyclecalories')
END;
    $result = $mysqli->query($qcycle);
    if ($result == TRUE) {        
        echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }

}
if ($workout == "dancing") {
    $dancevalue = $_POST['distance'];
    $dancedate = $_POST['date'];
    $dancecalories = $_POST['calories'];
    $qdancing = <<<END
        INSERT INTO dancing (user_ID,value,date,calories)
        VALUES('$userid','$dancevalue','$dancedate','$dancecalories')
END;
    $result = $mysqli->query($qdancing);
    if ($result == TRUE) {        
        echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }
}
if ($workout == "jumping_rope") {
    $jumpvalue = $_POST['distance'];
    $jumpdate = $_POST['date'];
    $jumpcalories = $_POST['calories'];
    $qjumping = <<<END
        INSERT INTO jumping_rope (user_ID,value,date,calories)
        VALUES('$userid','$jumpvalue','$jumpdate','$jumpcalories')
END;
    $result = $mysqli->query($qjumping);
    if ($result == TRUE) {        
        echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }
}
if ($workout == "walked_distance") {
    $walkvalue = $_POST['distance'];
    $walkdate = $_POST['date'];
    $walkcalories = $_POST['calories'];
    $qwalking = <<<END
        INSERT INTO walked_distance (user_ID,value,date,calories)
        VALUES('$userid','$walkvalue','$walkdate','$walkcalories')
END;
    $result = $mysqli->query($qwalking);
    if ($result == TRUE) {
        echo "Activity added to your daily log!";
        header("Location: thankspage.html");
        exit();
    }
}

//select statements
$statistic = $_POST['workout'];
$date = new DateTime();
$table = $_POST['workout'];
$display = '<h3>Your logged activity</h3>';
if (isset($_POST['workout'])) {
    $query = <<<END
        SELECT * FROM $table 
        WHERE user_ID = $userid
END;
    $res = $mysqli->query($query);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_object()) {
            $display .= <<<END
                {$row->value}|
                    {$row->date}|
                        {$row->calories}          
END;
        }
    }
}


// Skriv ut formuläret
$content = <<<END
    <h2>Add activity to your daily log</h2>
    <form action="workout.php" method="post">
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
        <br>
        <br>
        <label for="distance">Distance:</label>
        <input type="text" name="distance">
        <br>
        <br>
        <label for="calories">Calories burned:</label>
        <input type="text" name="calories">
        <br>
        <br>
        <label for="date" name="date">Date of workout:</label>
        <input type="date" name="date"><br><br>
        <button type="submit">Log activity</button>
    </form> 
    <br>
    <br>
    <br>
    <h2>Display your logged activity</h2>
    <form action="workout.php" method="post">
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
        <br>
        <button type="submit">View activity trends</button>
        </form>
END;
echo $content;
echo $display;
require_once('footer.php');
?>
</div>
</div>

