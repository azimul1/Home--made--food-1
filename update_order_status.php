<?php

include 'connection.php';

$id = $_POST['id'];
$status = $_POST['status'];

$con->query("UPDATE orders SET status='$status' WHERE id=$id");

echo "updated";
