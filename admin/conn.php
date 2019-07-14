<?php
session_start();
$hostname = "localhost"; 
$username = "mybookdom"; 
$password = "F2u3P0k3";
$dbName = "mybookdom";

$conn=mysqli_connect($hostname, $username, $password) or die ("Не могу создать соединение");
mysqli_select_db($conn,$dbName) or die (mysqli_error());
