<?php

$server = "localhost";
$user = "root";
$password ="";
$db = "sacredindia";

$con = mysqli_connect($server, $user, $password, $db);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
