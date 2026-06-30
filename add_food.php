<?php
include 'connection.php';

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$is_popular = $_POST['is_popular'];

$imageName = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

$path = "uploads/" . time() . "_" . $imageName;

move_uploaded_file($tmp, $path);

$sql = "INSERT INTO menu_items (name, price, category, image, is_popular)
        VALUES ('$name', '$price', '$category', '$path', '$is_popular')";

if ($con->query($sql)) {
    echo "success";
}
