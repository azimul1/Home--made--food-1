<?php

$serverName = "localhost";
$username = "root";
$password = "";
$database = "home_made_db";

$con = new mysqli($serverName, $username, $password, $database);

if (!$con) {
    die(mysqli_error($con));
}
