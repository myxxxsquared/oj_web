<?php

$db_host = '127.0.0.1';
$db_name = 'OJ';
$db_user = 'root';
$db_pwd = 'phisics';

$dbConnection = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if(mysqli_connect_error()){
    die(mysqli_connect_error());
}
$dbConnection->set_charset("utf8");
?>