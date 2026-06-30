<?php
include 'connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];

$con->query("UPDATE menu_items 
SET name='$name', price='$price', category='$category'
WHERE id=$id");

echo "updated";
?>