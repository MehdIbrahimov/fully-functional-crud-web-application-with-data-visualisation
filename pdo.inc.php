<?php
define("PARAM_HOST",'mysql-mehd1brahimov.alwaysdata.net');
define("PARAM_PORT",'3306');
define("PARAM_DB",'mehd1brahimov_weather');
const PARAM_USER = '192537_1337';
const PARAM_PASSWD = '411Right5R3serv3d';
$conn = 'mysql:host='.PARAM_HOST;'port='.PARAM_PORT;'dbname='.PARAM_DB;
$pdo = new PDO($conn,PARAM_USER,PARAM_PASSWD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
