<?php
session_start();
include("pdo.inc.php");
#CONTROL
if ( isset($_POST['date']) && isset($_POST['time']) && isset($_POST['temp'])
 && isset($_POST['pressure']) && isset($_POST['humidity']) && isset($_POST['wind_speed'])
 && isset($_POST['wind_dir']) || isset($_POST['condit']) || isset($_POST['status']))
 {
    if (empty($_POST['date']) || empty($_POST['time'])
     || empty($_POST['pressure']) || empty($_POST['humidity']) || empty($_POST['wind_speed'])
     || empty($_POST['wind_dir']) || empty($_POST['condit']) || empty($_POST['status']))
     {
      $_SESSION["error"] = "All rows are required";
      header("Location: add.php");
      return;
    }
    elseif (!is_numeric($_POST['time']) || !is_numeric($_POST['temp']) ){
      $_SESSION["error"] =  "Time and temperature must be numeric";
      header("Location: add.php");
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
      $stmt = $pdo->prepare('INSERT INTO mehd1brahimov_weather.weather_all
        (date, time, temp, pressure, humidity, wind_speed, wind_dir, condit, status)
        VALUES ( :dt, :ti, :tp, :pr, :hm, :ws, :wd, :cd, :st)');
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
        $_SESSION["success"] = "Record inserted";
        #$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
        #$_SESSION["rows"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Location: index.php");
        return;
    }
  }
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
      <div class="col-25">
        <label for="date">Date:</label>
      </div>
      <div class="col-75">
        <input type="date" name="date"/>
      </div>
      <div class="col-25">
        <label for="time">Time:</label>
      </div>
      <div class="col-75">
        <input type="number" name="time"/>
      </div>
      <div class="col-25">
        <label for="temp">Temperature:</label>
      </div>
      <div class="col-75">
        <input type="number" name="temp"/>
      </div>
      <div class="col-25">
        <label for="pressure">Pressure:</label>
      </div>
      <div class="col-75">
        <input type="text" name="pressure"/>
      </div>
      <div class="col-25">
        <label for="humidity">Humidity:</label>
      </div>
      <div class="col-75">
        <input type="text" name="humidity"/>
      </div>
      <div class="col-25">
        <label for="wind_speed">Wind Speed:</label>
      </div>
      <div class="col-75">
        <input type="text" name="wind_speed"/>
      </div>
      <div class="col-25">
        <label for="wind_dir">Wind Direction:</label>
      </div>
      <div class="col-75">
        <input type="text" name="wind_dir"/>
      </div>
      <div class="col-25">
        <label for="condit">Condition:</label>
      </div>
      <div class="col-75">
        <select id="condit" name="condit">
          <option value="" disabled selected>Choose option</option>
          <option value="Sunny">Sunny</option>
          <option value="Cloudy">Cloudy</option>
          <option value="Rainy">Rainy</option>
          <option value="Snowy">Snowy</option>
          <option value="Windy">Windy</option>
        </select>
      </div>
      <div class="col-25">
        <label for="status">Status:</label>
      </div>
      <div class="col-75">
        <select id="status" name="status">
          <option value="" disabled selected>Choose option</option>
          <option value="Severe">Severe</option>
          <option value="Humid">Humid</option>
          <option value="Calm">Calm</option>
          <option value="Clear">Clear</option>
        </select>
      </div>
      <div class=abc>
      <input type="submit" name='add' value="Add">
      <a class="link" href="index.php">Cancel</a>
    </div>
  </form>
  </div>
</div>
</body>
</html>
