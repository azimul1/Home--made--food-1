<?php
include 'connection.php';

$id = $_POST['id'];

$con->query("DELETE FROM menu_items WHERE id=$id");

echo "deleted";
?>