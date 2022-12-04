<?php
session_start();
include("pdo.inc.php");

if ( isset($_POST['date']) && isset($_POST['time']) && isset($_POST['temp'])
 && isset($_POST['pressure']) && isset($_POST['humidity']) && isset($_POST['wind_speed'])
 && isset($_POST['wind_dir']) && isset($_POST['condit']) && isset($_POST['status']))
 {
    if (empty($_POST['date']) || empty($_POST['time'])
     || empty($_POST['pressure']) || empty($_POST['humidity']) || empty($_POST['wind_speed'])
     || empty($_POST['wind_dir']) || empty($_POST['condit']) || empty($_POST['status']))
     {
      $_SESSION["error"] = "All rows are required";
      header("Location: edit.php");
      return;
    }
    elseif (!is_numeric($_POST['time']) || !is_numeric($_POST['temp']) ){
      $_SESSION["error"] =  "Time and temperature must be numeric";
      header("Location: edit.php");
      return;
    }
    else{
      $_SESSION["date"] = $_POST["date"];
      $_SESSION["time"] = $_POST["time"];
      $_SESSION["temp"] = $_POST["temp"];
      $_SESSION["pressure"] = $_POST["pressure"];
      $_SESSION["humidity"] = $_POST["humidity"];
      $_SESSION["wind_speed"] = $_POST["wind_speed"];
      $_SESSION["wind_dir"] = $_POST["wind_dir"];
      $_SESSION["condit"] = $_POST["condit"];
      $_SESSION["status"] = $_POST["status"];
      $stmt = $pdo->prepare('UPDATE mehd1brahimov_weather.weather_all SET
        date = :dt, time = :ti, temp = :tp, pressure = :pr,
          humidity = :hm, wind_speed = :ws, wind_dir = :wd, condit = :cd, status = :st
          WHERE date = :dt AND time = :ti');
        $stmt->execute(array(
          ':dt' => htmlentities($_SESSION["date"]),
          ':ti' => htmlentities($_SESSION["time"]),
          ':tp' => htmlentities($_SESSION["temp"]),
          ':pr' => htmlentities($_SESSION["pressure"]),
          ':hm' => htmlentities($_SESSION["humidity"]),
          ':ws' => htmlentities($_SESSION["wind_speed"]),
          ':wd' => htmlentities($_SESSION["wind_dir"]),
          ':cd' => htmlentities($_SESSION["condit"]),
          ':st' => htmlentities($_SESSION["status"]))
      );
        $_SESSION["success"] = "Record edited";
        header("Location: index.php");
        return;
    }
  }


$stmt = $pdo->prepare("SELECT * FROM mehd1brahimov_weather.weather_all WHERE date = :d AND time = :t");
$stmt->execute(array(":d" => $_GET['date'], ":t" => $_GET['time']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value';
    header( 'Location: index.php' ) ;
    return;
}
$dt = htmlentities($row['date']);
$ti = htmlentities($row['time']);
$tp = htmlentities($row['temp']);
$pr = htmlentities($row['pressure']);
$hm = htmlentities($row['humidity']);
$ws = htmlentities($row['wind_speed']);
$wd = htmlentities($row['wind_dir']);
$cd = htmlentities($row['condit']);
$st = htmlentities($row['status']);
?>


<!DOCTYPE html>
<html>
<head>
  <title>Add new records</title>
  <style>
  * {
    box-sizing: border-box;
  }
  input[type=text], input[type=date],input[type=number], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: none;
  }
  label {

    display: inline-block;
  }
  .abc{
    display:inline-block;
    text-align: right;
    align-items: right;
    float: right;
    padding-top: 5px;
  }
  input[type=submit] {
    border: 2px solid black;
    color: black;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;

  }
  input[type=submit]:hover {
    background-color: #7bda75;
  }
 .link{
   padding: 12px 20px;
   border: 2px solid black;
   color: black;
   border-radius: 5px;
   cursor: pointer;
   text-decoration:none;
 }
.link:hover{
     background-color: #da757b;
   }

  .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
  }
  .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
  }
  .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
  }
  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
      width: 100%;
      margin-top: 0;
    }
  }
  </style>
</head>
<body>
<div class="container">
  <?php
  if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
  ?>
  <form method="post">
    <div class="row">
      <h3>Updating records for date: <?= "\t<i>".$row["time"].":00\t"."\t".$row['date']?></h3>
      <div class="col-25">
        <label for="temp">Temperature:</label>
      </div>
      <div class="col-75">
        <input type="number" name="temp" value="<?= $tp ?>"/>
      </div>
      <div class="col-25">
        <label for="pressure">Pressure:</label>
      </div>
      <div class="col-75">
        <input type="text" name="pressure" value="<?= $pr ?>"/>
      </div>
      <div class="col-25">
        <label for="humidity">Humidity:</label>
      </div>
      <div class="col-75">
        <input type="text" name="humidity" value="<?= $hm ?>"/>
      </div>
      <div class="col-25">
        <label for="wind_speed">Wind Speed:</label>
      </div>
      <div class="col-75">
        <input type="text" name="wind_speed" value="<?= $ws ?>"/>
      </div>
      <div class="col-25">
        <label for="wind_dir">Wind Direction:</label>
      </div>
      <div class="col-75">
        <input type="text" name="wind_dir" value="<?= $wd ?>"/>
      </div>
      <div class="col-25">
        <label for="condit">Condition:</label>
      </div>
      <div class="col-75">
        <select id="condit" name="condit">
          <option value="" disabled selected>Choose option</option>
          <option value="Sunny"<?php echo ($row['condit'] == 'Sunny' ? 'selected="selected"' : ''); ?>>Sunny</option>
          <option value="Cloudy"<?php echo ($row['condit'] == 'Cloudy' ? 'selected="selected"' : ''); ?>>Cloudy</option>
          <option value="Rainy"<?php echo ($row['condit'] == 'Rainy' ? 'selected="selected"' : ''); ?>>Rainy</option>
          <option value="Snowy"<?php echo ($row['condit'] == 'Snowy' ? 'selected="selected"' : ''); ?>>Snowy</option>
          <option value="Windy"<?php echo ($row['condit'] == 'Windy' ? 'selected="selected"' : ''); ?>>Windy</option>
        </select>
      </div>
      <div class="col-25">
        <label for="status">Status:</label>
      </div>
      <div class="col-75">
        <select id="status" name="status">
          <option value="" disabled selected>Choose option</option>
          <option value="Severe"<?php echo ($row['status'] == 'Severe' ? 'selected="selected"' : ''); ?>>Severe</option>
          <option value="Humid"<?php echo ($row['status'] == 'Humid' ? 'selected="selected"' : ''); ?>>Humid</option>
          <option value="Calm"<?php echo ($row['status'] == 'Calm' ? 'selected="selected"' : ''); ?>>Calm</option>
          <option value="Clear"<?php echo ($row['status'] == 'Clear' ? 'selected="selected"' : ''); ?>>Clear</option>
        </select>
      </div>
      <div class=abc>
      <input type="submit" name='edit' value="Edit">
      <a class="link" href="index.php">Cancel</a>
    </div>
    <input type="hidden" name="date" value="<?= $row['date']?>">
    <input type="hidden" name="time" value="<?= $row['time']?>">
  </form>
  </div>
</div>
</body>
</html>
