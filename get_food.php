<?php
include 'connection.php';

header('Content-Type: application/json');

$result = $con->query("SELECT * FROM menu_items ORDER BY id DESC");

if (!$result) {
    echo json_encode([
        "error" => $con->error
    ]);
    exit();
}

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
