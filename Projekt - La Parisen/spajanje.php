<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "127.0.0.1:3307"; // xampp mi je na portu 3307!
$username = "root";
$password = "admin";
$basename = "leparisien";

$dbc = mysqli_connect($servername, $username, $password, $basename) or die('Error connecting to MySQL server.' . mysqli_connect_error());
mysqli_set_charset($dbc, "utf8");
?>