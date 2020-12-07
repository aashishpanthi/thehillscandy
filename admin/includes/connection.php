<?php

$dbUser = 'root';
$dbPass = '';
$dbservername = "localhost";
$dbName = 'products';

// Create connection
$conn = mysqli_connect($dbservername, $dbUser, $dbPass, $dbName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  exit();
}