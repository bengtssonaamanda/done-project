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
<?php
include('template.php');
  if (isset($_POST['username']) and isset($_POST['password'])) {
    $_SESSION["username"] = $_GET['username'];
    $_SESSION["userId"] = $_GET['user_ID'];
    $query = <<<END
      SELECT username, password, user_ID FROM user
      WHERE username= '{$_POST['username']}'
      AND password = '{$_POST['password']}'
END;
  $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
    $row = $result->fetch_object();
    $_SESSION["username"] = $row->username;
    $_SESSION["userId"] = $row->user_id;
    header("Location:home.php");
  }   else {
      echo "Wrong username or password. Try again.";
        }
}

$content = <<<END
<form action="login.php" method="post">
<input type="text" name="username" placeholder="username">
<input type="password" name="password" placeholder="password">
<input type="submit" value="Login">
</form>
END;
echo $content;
require_once('footer.php');
?>
</div>
</div>

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
<?php
session_name('Health Dashboard');
session_start();
include('template.php');
if (isset($_POST['username']) and isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $_SESSION['username'] = $_POST['username'];
  $stmt = $mysqli->prepare("SELECT user_ID FROM user WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['userId'] = $row;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    header("Location:home.php");
  } else {
    echo "Wrong username or password. Try again.";
  }
}

$content = <<<END
<form action="login.php" method="post">
<input type="text" name="username" placeholder="username">
<input type="password" name="password" placeholder="password">
<input type="submit" value="Login">
</form>
END;
echo $content;
require_once('footer.php');
?>
</div>
</div>
  


  

