<?php

$servername = "localhost";
$username = "root";
$password = "";
$basename = "test";

$dbc = mysqli_connect($servername, $username, $password, $basename) or
die('Error connecting to MySQL server.' . mysqli_error());
?>