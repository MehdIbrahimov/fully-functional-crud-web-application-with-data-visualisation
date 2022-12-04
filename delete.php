<?php
session_start();
include("pdo.inc.php");

if ( isset($_POST['delete']) && isset($_POST['date']) && isset($_POST['time']) ) {
    $sql = "DELETE FROM mehd1brahimov_weather.weather_all WHERE date = :d AND time = :t";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':d' => $_POST['date'], ':t' => $_POST['time']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

$stmt = $pdo->prepare("SELECT date, time FROM mehd1brahimov_weather.weather_all WHERE date = :d AND time = :t");
$stmt->execute(array(":d" => $_GET['date'], ":t" => $_GET['time']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value';
    header( 'Location: index.php' ) ;
    return;
}

?>


<!DOCTYPE html>
<html>
<head>
<title>Deleting the row</title>
</head>
<body>
<div class="container">

<p>Confirm deleting the record for date = <?= htmlentities($row['date'])?> and time = <?= htmlentities($row['time'])?></p>
<form method="post">
  <input type="hidden" name="date" value="<?= $row['date']?>">
  <input type="hidden" name="time" value="<?= $row['time']?>">
  <input type="submit" value="Delete" name="delete">
  <a href="index.php">Cancel</a>
</form>
</div>
</body>
</html>
