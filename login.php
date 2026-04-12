<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$password = $data['password'];

$result = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_email'] = $email;
        echo "success";
    } else {
        echo "Wrong password";
    }
} else {
    echo "User not found";
}