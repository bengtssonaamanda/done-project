<!DOCTYPE html> 
<html>
<head>
  <title>Analytics Page</title>
  <link rel="stylesheet" type="text/css" href="style1.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <h1>Analytics</h1>
    <div class="chart-box">
      <canvas id="browserChart"></canvas>
    </div>
    <div class="table-box">
      <h3>The 15 latest happenings on your website</h3>
      <?php
      require_once('template.php');

      if (!isset($_SESSION["user_ID"]))
      header("Location:landingpage.html");
      
      $select_query = "SELECT * FROM sessions ORDER BY page_open DESC LIMIT 15";
      $result = $mysqli->query($select_query);

      // skriv ut tabellen och data
      echo "<table>";
      echo "<tr>
              <th>Session ID</th>
              <th>User ID</th>
              <th>Page Open</th>
              <th>IP Address</th>
              <th>Page</th>
              <th>Browser</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>".$row['session_ID']."</td>";
              echo "<td>".$row['user_ID']."</td>";
              echo "<td>".$row['page_open']."</td>";
              echo "<td>".$row['ip_address']."</td>";
              echo "<td>".$row['page']."</td>";
              echo "<td>";
            
              echo $row['browser']."</td>";
              echo "</tr>";
            }
      ?>
    </div>
  </div>
  <!-- härifrån börjar charten sen ligger den högst upp på sidan under analytics för att skrivas ut på sidan -->
  <script type="text/javascript">
    <?php
    
    $query = "SELECT browser, COUNT(*) AS visits FROM sessions GROUP BY browser ORDER BY visits DESC LIMIT 5";
    $result = $mysqli->query($query);
    $browsers = array();
    $visits = array();

while ($row = $result->fetch_assoc()) {
  $browsers[] = $row['browser'];
  $visits[] = $row['visits'];
}
?>

var browsers = <?php echo json_encode($browsers); ?>;
var visits = <?php echo json_encode($visits); ?>;

var ctx = document.getElementById('browserChart').getContext('2d');
new Chart(ctx, {
  type: 'pie',
  data: {
    labels: browsers,
    datasets: [{
      data: visits,
      backgroundColor: [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)'
      ]
    }]
  },
  options: {
    title: {
      display: true,
      text: 'Most Used Web Browsers',
    }
  }
});
</script>
 <?php require_once('footer.php'); ?>
