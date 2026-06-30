<?php
include 'connection.php';

$result = mysqli_query($con, "SELECT id, name, email, phone FROM users ORDER BY id DESC");

$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

echo json_encode($users);
?>