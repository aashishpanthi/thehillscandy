<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbName = 'users';

$conn = new mysqli($dbhost, $dbuser, $dbpass,$dbName) or die("Connect failed: %s\n". $conn -> error);