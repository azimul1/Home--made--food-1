<?php
include 'connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// check duplicate email
$check = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    echo "exists";
    exit();
}

$sql = "INSERT INTO users (name, email, phone, password) 
        VALUES ('$name', '$email', '$phone', '$password')";

if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "error";
}
?>