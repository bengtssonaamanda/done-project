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
        <h1>Admin</h1>
        <p>Add user</p>
<?php
require_once('template.php');
$adminid = $_SESSION["user_ID"];
$thisuser = $_SESSION["username"];

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
    if ($mysqli->query($query) !== TRUE) {
        die ("Could not add user." . $mysqli->errno . " : " . $mysqli->error);
    }
    if ($mysqli->query($query) == TRUE) {
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
    if ($mysqli->query($query) !== TRUE) {
        die ("Could not add asmin." . $mysqli->errno . " : " . $mysqli->error);
    }
    if ($mysqli->query($query) == TRUE) {
        echo "Admin added sucessfully";
    }
}
$content = <<<END
    <form class="adduser" action="admin.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="firstname">Firstname:</label>
            <input type="text" id="firstname" name="firstname" required><br><br>
            <label for="lastname">Lastname:</label>
            <input type="text" id="lastname" name="lastname" required><br><br>
            <label for="phonenumber">Phonenumber:</label>
            <input type="text" id="phonenumber" name="phonenumber" required><br><br>
            <br>
            <button type="submit">Register</button>
        </form>
        <br>
        <br>
        <br>
        <form class="admin" action="admin.php" method="POST">
            <label for="admin">Add admin</label>
            <input type="text" name="admin" placeholder="username" required><br><br> 
            <br>
            <button type="submit">Add admin</button>
        </form>
END;
echo $content;
require_once('footer.php');
?>
</div>