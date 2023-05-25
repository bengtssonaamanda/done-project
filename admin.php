<!DOCTYPE html>
<html>
  <head>
    <title>Registration Page</title>
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
    <h1>Administrator settings</h1>
        <div class="login-box">

<?php
require_once('template.php');
require_once('sessions.php');
$adminid = $_SESSION["user_ID"];
$thisuser = $_SESSION["username"];

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username   = $mysqli->real_escape_string($_POST['username']);
    $password   = $mysqli->real_escape_string($_POST['password']);
    $firstname   = $mysqli->real_escape_string($_POST['firstname']);
    $lastname   = $mysqli->real_escape_string($_POST['lastname']);
    $email   = $mysqli->real_escape_string($_POST['email']);
    $phonenr   = $mysqli->real_escape_string($_POST['phonenumber']);

    $query = <<<END
        INSERT INTO user(username, password, fname, lname, email, phone_nr)
        VALUES('{$username}','{$password}','{$firstname}','{$lastname}','{$email}','{$phonenr}');
END;
$res = $mysqli->query($query);
    if ($res !== TRUE) {
        die ("Could not add user." . $mysqli->errno . " : " . $mysqli->error);
    }
    if ($res == TRUE) {
        echo "User added sucessfully";
    }
}

if (isset($_POST['admin'])) {
    $admin   = $mysqli->real_escape_string($_POST['admin']);
    
    $query = <<<END
        UPDATE user
        SET is_admin = 1
        WHERE username = '$admin'
END;
$result = $mysqli->query($query);
    if ($result !== TRUE) {
        die ("Could not add admin." . $mysqli->errno . " : " . $mysqli->error);
    }
    if ($result == TRUE) {
        echo "Admin added sucessfully";
    }
}
if (isset($_POST['userdel'])) {
    $userdel   = $mysqli->real_escape_string($_POST['userdel']);
    
    $delquery = <<<END
        DELETE FROM user
        WHERE username = '$userdel'
END;
$result1 = $mysqli->query($delquery);
    if ($result1 !== TRUE) {
        die ("Could not delete user." . $mysqli->errno . " : " . $mysqli->error);
    }
    if ($result1 == TRUE) {
        echo "User deleted successfully";
    }
}
$content = <<<END
<h2>Add user</h2>
<form action="admin.php" method="POST">
<div class="user-box">
    <input type="text" name="username" id="username" required>
    <label for="username">Username:</label>
</div>
<div class="user-box">
    <input type="password" name="password" id="password" required>
    <label for="password">Password:</label>
</div>
<div class="user-box">
    <input type="email" name="email" id="email" required>
    <label for="email">Email:</label>
</div>
<div class="user-box">
    <input type="text" name="firstname" id="firstname" required>
    <label for="firstname">Firstname:</label>
</div>
<div class="user-box">
    <input type="text" name="lastname" id="lastname" required>
    <label for="lastname">Lastname:</label>
</div>
<div class="user-box">
    <input type="text" name="phonenumber" id="phonenumber" required>
    <label for="phonenumber">Phonenumber:</label>
</div>
<br>
<input type="submit" value="Add user">
</form>
<br><br>
<h2>Add administrator</h2>
<form action="admin.php" method="POST">
<div class="user-box">
    <input type="text" name="admin" id="admin" required>
    <label for="admin">Add as an admin:</label>
</div>
<br>
<input type="submit" value="Add admin">
</form>
<h2>Delete user</h2>
<form action="admin.php" method="POST">
<div class="user-box">
    <input type="text" name="userdel" id="uderdel" required>
    <label for="userdel">Delete user with usename:</label>
</div>
<br>
<input type="submit" value="Delete user">
</form>
<button type="button"style="background-color: coral;"><a href="analytics.php"><span></span>Analytics</a></button>
<button type="button"style="background-color: coral;"><a href="ipadress.php"><span></span>IP-statistic</a></button>
END;
echo $content;
require_once('footer.php');
?>
</div>
