<?php
header("Content-Type:text/html; charset=utf-8");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restful";
$conn = mysqli_connect($servername, $username, $password, $dbname);
include 'route_bus_data.php';
include 'stop_bus_data.php';
include 'route_stop_bus_data.php';
$conn->close();
