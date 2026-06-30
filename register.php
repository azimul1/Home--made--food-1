<?php
include 'connection.php';

// Create users table if it does not exist
$createTableSQL = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!mysqli_query($con, $createTableSQL)) {
    die("Table creation failed: " . mysqli_error($con));
}

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$phone = $data['phone'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

// Check if user exists
$check = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    echo "Email already exists";
    exit();
}

$name = $data['name'];
$sql = "INSERT INTO users (name, email, phone, password) 
        VALUES ('$name', '$email', '$phone', '$password')";

if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "Error";
}