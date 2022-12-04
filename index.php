<?php
session_start();
include("pdo.inc.php");
#include("graphs.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <style>
    body {font-size: 16px;
        font-family: Arial,Verdana,Helvetica,sans-serif;}
      table.dtable, table.ntable { border: 1px #ccc solid; border-collapse:collapse; padding: 5px;}
      table.dtable th, table.dtable td, table.ntable th, table.ntable td  { border: 1px #ccc solid; border-collapse:collapse; padding: 5px; font-weight:normal;}
      table.dtable th, table.ntable th { text-align:center }
      table.ntable td { text-align:right }
      table.dtable thead tr {background-color:#E0E0E0;}
      .table {
        padding-left: 70px;
        padding-right: 70px;
      }
      </style>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready( function () {
        $('.dtable').DataTable();
    } );
    </script>
    <meta charset="utf-8">
    <title>Weather Records in Baku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A corporate Bootstrap theme by Medium Rare">
    <style>
      @keyframes hideLoader{0%{ width: 100%; height: 100%; }100%{ width: 0; height: 0; }  }  body > div.loader{ position: fixed; background: white; width: 100%; height: 100%; z-index: 1071; opacity: 0; transition: opacity .5s ease; overflow: hidden; pointer-events: none; display: flex; align-items: center; justify-content: center;}body:not(.loaded) > div.loader{ opacity: 1;}body:not(.loaded){ overflow: hidden;}  body.loaded > div.loader{animation: hideLoader .5s linear .5s forwards;  } /* Typing Animation */.loading-animation {width: 6px;height: 6px;border-radius: 50%;animation: typing 1s linear infinite alternate;position: relative;left: -12px;}@keyframes typing {0% {background-color: rgba(100,100,100, 1);box-shadow: 12px 0px 0px 0px rgba(100,100,100, 0.2),24px 0px 0px 0px rgba(100,100,100, 0.2);}25% {background-color: rgba(100,100,100, 0.4);box-shadow: 12px 0px 0px 0px rgba(100,100,100, 2),24px 0px 0px 0px rgba(100,100,100, 0.2);}75% {background-color: rgba(100,100,100, 0.4);box-shadow: 12px 0px 0px 0px rgba(100,100,100, 0.2),24px 0px 0px 0px rgba(100,100,100, 1);}}
    </style>
    <script type="text/javascript">
      window.addEventListener("load", function () {    document.querySelector('body').classList.add('loaded');  });
    </script>
    <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="preload" as="font" href="assets/fonts/Inter-UI-upright.var.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="assets/fonts/Inter-UI.var.woff2" type="font/woff2" crossorigin="anonymous">
  </head>
  <body data-smooth-scroll-offset="73">
    <div class="loader">
      <div class="loading-animation"></div>
    </div>
    <div data-overlay="" class=" main-bg bg-primary text-light o-hidden position-relative" style="padding-top: 73px !important;">
      <div class="position-absolute w-100 h-100 o-hidden top-0">
        <div class="decoration right bottom scale-2">

        </div>
        <div class="decoration right bottom scale-3">

        </div>
        <div class="decoration top left scale-2  d-none d-md-block">

        </div>
      </div>
      <section class="min-vh-70 o-hidden d-flex flex-column justify-content-center">
        <div class="container">
          <div class="row justify-content-center text-center align-items-center">
            <div class="col-xl-8 col-lg-9 col-md-10 layer-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
              <h1 class="display-3">
            Weather Records<br>In Baku
          </h1>
              <div class="mb-4">
                <p class="lead px-xl-5">
                  Look at and analyze the weather data and graphs, add or edit records
                </p>
              </div>
              <a href="#graphs" class="btn btn-lg btn-white mx-1" data-smooth-scroll="">Graphs</a>
              <a href="#tables" class="btn btn-lg btn-primary-3 mx-1" data-smooth-scroll=""> Table</a>
            </div>
          </div>
        </div>
      </section>
      <div class="divider flip-x">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="96px" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" class="injected-svg" data-src="assets/img/dividers/divider-2.svg">
          <path d="M0,0 C16.6666667,66 33.3333333,99 50,99 C66.6666667,99 83.3333333,66 100,0 L100,100 L0,100 L0,0 Z"></path>
        </svg>
      </div>
    </div>
    <section id="graphs">
      <div style="text-align:center; padding-bottom:30px;" class="graph">
        <h3 style="text-align:center; padding-bottom:100px">Graphs</h3>
        <img src="graph1.php"/>
        <img src="graph2.php"/>
        <img src="graph3.php"/>
      </div>
    </section>

    <section id="tables">

    <div class=table>

      <h3 style="text-align:center;">Datatable</h3>
      <?php
      if ( isset($_SESSION["success"]) ) {
            echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
            unset($_SESSION["success"]) ;
        }
        ?>

      <div>
        <p><a href="add.php">New Record</a><p>
      </div>

      <table class="dtable">
        <thead><tr>
          <th>Date</th>
          <th>Time</th>
          <th>Temperature</th>
          <th>Pressure</th>
          <th>Humidity</th>
          <th>Wind Speed</th>
          <th>Wind Direction</th>
          <th>Condition</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr></thead>
    <?php
        $stmt = $pdo->query("SELECT date,time,temp,pressure,humidity,wind_speed,wind_dir,condit,status FROM mehd1brahimov_weather.weather_all");
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
          echo "<tr><td>";
          echo(htmlentities($row['date']));
          echo "</td><td>";
          echo(htmlentities($row['time']));
          echo "</td><td>";
          echo(htmlentities($row['temp']));
          echo "</td><td>";
          echo(htmlentities($row['pressure']));
          echo "</td><td>";
          echo(htmlentities($row['humidity']));
          echo "</td><td>";
          echo(htmlentities($row['wind_speed']));
          echo "</td><td>";
          echo(htmlentities($row['wind_dir']));
          echo "</td><td>";
          echo(htmlentities($row['condit']));
          echo "</td><td>";
          echo(htmlentities($row['status']));
          echo "</td><td>";
          echo('<a href="edit.php?date='.$row['date'].'&'.'time='.$row['time'].'">Edit</a>');
          echo "</td><td>";
          echo('<a href="delete.php?date='.$row['date'].'&'.'time='.$row['time'].'">Delete</a>');
          echo "</td></tr>";

        }
    echo "</table></div>\n";
    ?>

      </section>
    <footer class="pb-4 bg-primary-3 text-light" id="footer">
      <div class="container">
        <div>

          <div style="text-align:center;">
            <h5>Contact</h5>
                <div>
                  <span>Mehdi Ibrahimov</span>
                </div>
                <div>
                  <span class="d-block text-muted text-small">mehdibrahimov12@gmail.com</span>
                  <span class="d-block text-muted text-small">UFAZ PROJECT 2020<br/></span>
                </div>
          </div>

        </div>
        <div class="row justify-content-center">
          <div class="col col-md-auto text-center">
            <small class="text-muted">&copy;2020 Created by Mehdi Ibrahimov.
            </small>
          </div>
        </div>
      </div>
    </footer>

    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <!-- Optional Vendor Scripts (Remove the plugin script here and comment initializer script out of index.js if site does not use that feature) -->
    <!-- AOS (Animate On Scroll - animates elements into view while scrolling down) -->
    <script type="text/javascript" src="assets/js/aos.js"></script>
    <!-- Flatpickr (calendar/date/time picker UI) -->
    <script type="text/javascript" src="assets/js/flatpickr.min.js"></script>
    <!-- Ion rangeSlider (flexible and pretty range slider elements) -->
    <script type="text/javascript" src="assets/js/ion.rangeSlider.min.js"></script>
    <!-- Isotope (masonry layouts and filtering) -->
    <script type="text/javascript" src="assets/js/isotope.pkgd.min.js"></script>
    <!-- jQuery Countdown (displays countdown text to a specified date) -->
    <script type="text/javascript" src="assets/js/jquery.countdown.min.js"></script>
    <!-- Plyr (unified player for Video, Audio, Vimeo and Youtube) -->
    <script type="text/javascript" src="assets/js/plyr.polyfilled.min.js"></script>
    <!-- Prism (displays formatted code boxes) -->
    <script type="text/javascript" src="assets/js/prism.js"></script>
    <!-- ScrollMonitor (manages events for elements scrolling in and out of view) -->
    <script type="text/javascript" src="assets/js/scrollMonitor.js"></script>
    <!-- Smooth scroll (animation to links in-page)-->
    <script type="text/javascript" src="assets/js/smooth-scroll.polyfills.min.js"></script>
    <!-- SVGInjector (replaces img tags with SVG code to allow easy inclusion of SVGs with the benefit of inheriting colors and styles)-->
    <script type="text/javascript" src="assets/js/svg-injector.umd.production.js"></script>
    <!-- Required theme scripts (Do not remove) -->
    <script type="text/javascript" src="assets/js/theme.js"></script>
    <style>
.main-bg {
  background: url("puria-berenji-WMr305X7HNM-unsplash.jpg");
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: scroll;
  background-size: cover;
}
    </style>
  </body>
</html>
