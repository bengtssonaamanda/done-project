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
          <br><br>
        <div class="content">
        <h1>Register</h1>
           <?php
            require_once('template.php');
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
            die ("Could not query database." . $mysqli->errno . " : " . $mysqli->error);
              header('Location:thankspage.html');
            }
            if ($res == TRUE) {
                header('Location:login.php');
                }
        }
            $content =<<<END
            <div class="login-box">
  <h2>Join us!</h2>
  <form action="register.php" method="post">
    <div class="user-box">
      <input type="text" name="username" required="">
      <label>Username</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="">
      <label>Password</label>
    </div>
    <div class="user-box">
      <input type="text" name="firstname" required="">
      <label>Firstname</label>
    </div>
    <div class="user-box">
      <input type="text" name="lastname" required="">
      <label>Lastname</label>
    </div>
    <div class="user-box">
      <input type="email" name="email" required="">
      <label>Email</label>
    </div>
    <div class="user-box">
      <input type="text" name="phonenumber" required="">
      <label>Phonenumber</label>
    </div>
    <input type="submit" value="Register">
  </form>
</div>
END;
echo $content;
require_once('footer.php');
?>