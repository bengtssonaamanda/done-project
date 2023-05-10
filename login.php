<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="banner">
        <ul class="nav navbar nav-pills">
            <li class="nav-item active">
              <a class="nav-link" href="landingpage.html">Startpage</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about_us.html">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          </ul>
      <div class="content">
      <h1>Login</h1>
        <div class="login-box">
<?php
require_once('template.php');
  if (isset($_POST['username']) and isset($_POST['password'])) {
    $username   = $mysqli->real_escape_string($_POST['username']);
    $password   = $mysqli->real_escape_string($_POST['password']);

    $query = <<<END
      SELECT username, password, user_ID FROM user
      WHERE username= '{$username}'
      AND password = '{$password}'
END;
  $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
    $row = $result->fetch_object();
    $_SESSION["username"] = $row->username;
    $_SESSION["user_ID"] = $row->user_ID;
    $_SESSION["password"] = $row->password;
    header("Location:home.php");
  }   else {
      echo "Wrong username or password. Try again.";
        }
}
$content = <<<END
<form action="login.php" method="post">
  <div class="user-box">
    <input type="text" id="username" name="username" placeholder="Username" required>
    <label for="username">Username:</label>
  </div>
  <div class="user-box">
    <input type="password" id="password" name="password" placeholder="Password" required>
    <label for="password">Password:</label>
  </div>
  <input type="submit" value="Login">
</form>
END;
echo $content;
require_once('footer.php');
?>
</div>
</div>
  

