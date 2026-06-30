<?php
include 'connection.php';

$id = $_POST['id'];

if(mysqli_query($con, "DELETE FROM users WHERE id=$id")){
    echo "deleted";
} else {
    echo "error";
}
?>