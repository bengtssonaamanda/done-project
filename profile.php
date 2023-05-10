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

<?php
require_once('template.php');
require_once('sessions.php');

if (!isset($_SESSION["user_ID"]))
    header("Location:landingpage.html");

$userid = $_SESSION["user_ID"];

if (isset($_POST['length'])) {
  $length = $_POST["length"];

  $query = <<<END
    UPDATE user 
    SET length='$length'
    WHERE user_ID='$userid'
END;
  $mysqli->query($query);
  if ($mysqli->query($query) == TRUE) {
  echo "Length updated!";
    }
}

if (isset($_POST['weight'])) {
  $weight = $_POST["weight"];

  $query = <<<END
    UPDATE user 
    SET weight='$weight'
    WHERE user_ID='$userid'
END;
  $mysqli->query($query);
  if ($mysqli->query($query) == TRUE) {
  echo "Weight updated!";
    }
}


if (isset($_POST['username'])) {
  $username   = $mysqli->real_escape_string($_POST['username']);
    $query = <<<END
        UPDATE user
        SET username = '$username'
        WHERE user_ID = '$userid'
END;
    $mysqli->query($query);
    if ($mysqli->query($query) == TRUE) {
    echo "Username updated!";
    }
}
if (isset($_POST['password'])) {
  $password   = $mysqli->real_escape_string($_POST['password']);
    $query = <<<END
        UPDATE user
        SET password = '$password'
        WHERE user_ID = '$userid'
END;
    $mysqli->query($query);
    if ($mysqli->query($query) == TRUE) {
    echo "Password uppdated!";
    }
}
if (isset($_POST['email'])) {
  $email   = $mysqli->real_escape_string($_POST['email']);
    $query = <<<END
        UPDATE user
        SET email = '$email'
        WHERE user_ID = '$userid'
END;
    $mysqli->query($query);
    if ($mysqli->query($query) == TRUE) {
    echo "Email uppdated!";
    }
}
if (isset($_POST['firstname'])) {
  $firstname   = $mysqli->real_escape_string($_POST['firstname']);
    $query = <<<END
        UPDATE user
        SET fname = '$firstname'
        WHERE user_ID = '$userid'
END;
    $mysqli->query($query);
    if ($mysqli->query($query) == TRUE) {
        echo "firstname uppdated!";
    }
}
if (isset($_POST['lastname'])) {
  $lastname   = $mysqli->real_escape_string($_POST['lastname']);
    $query = <<<END
        UPDATE user
        SET lname = '$lastname'
        WHERE user_ID = '$userid'
END;
    $mysqli->query($query);
    if ($mysqli->query($query) == TRUE) {
        echo "Lastname uppdated!";
    }
}
if (isset($_POST['phonenumber'])) {
  $phonenumber   = $mysqli->real_escape_string($_POST['phonenumber']);
    $query = <<<END
        UPDATE user
        SET phone_nr = '$phonenumber'
        WHERE user_ID = '$userid'
END;
    $mysqli->query($query);
    if ($mysqli->query($query) == TRUE) {
        echo "Phonenumber is uppdated!";
    }
}
$content = <<<END
    <h1>Profile Settings</h1>
    <div class="login-box">
        <h2>Personal details</h2>
        <form action="profile.php" method="POST">
            <div class="user-box">
                <input type="number" id="length" name="length">
                <label for="length">Length(cm):</label>
            </div>
            <input type="submit" name="lenght" value="Update length!">
        </form>
        <form action="profile.php" method="POST">
            <div class="user-box">
                <input type="number" id="weight" name="weight">
                <label for="weight">Weight(kg):</label>
            </div>
            <input type="submit" name="lenght" value="Update weight!">
        </form>
</div>
<div class="login-box">
<h2>Change your account settings</h2>
    <form action="profile.php" method="POST">
  <div class="user-box">
    <input type="text" id="username" name="username" required>
    <label for="username">Change current username:</label>
  </div>
  <input type="submit" value="Update username!">
</form>
<form action="profile.php" method="POST">
  <div class="user-box">
    <input type="password" id="password" name="password" required>
    <label for="password">Change current password:</label>
  </div>
  <input type="submit" value="Update password!">
</form>
<form action="profile.php" method="POST">
  <div class="user-box">
    <input type="email" id="email" name="email" required>
    <label for="email">Change email:</label>
  </div>
  <input type="submit" value="Update email!">
</form>
<form action="profile.php" method="POST">
  <div class="user-box">
    <input type="text" id="firstname" name="firstname" required>
    <label for="firstname">Change Firstname:</label>
  </div>
  <input type="submit" value="Update firstname!">
</form>
<form action="profile.php" method="POST">
  <div class="user-box">
    <input type="text" id="lastname" name="lastname" required>
    <label for="lastname">Change Lastname:</label>
  </div>
  <input type="submit" value="Update lastname!">
</form>
<form action="profile.php" method="POST">
  <div class="user-box">
    <input type="text" id="phonenumber" name="phonenumber" required>
    <label for="phonenumber">Change Phonenumber:</label>
  </div>
  <input type="submit" value="Update phonenumber!">
</form>
END;
echo $content;
require_once('footer.php');
?>
    </div>
   </div>