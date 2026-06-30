<?php

include 'connection.php';

header('Content-Type: text/plain');

if (!isset($_POST['id'])) {
  die("ERROR: ID not received");
}

$order_id = intval($_POST['id']);

if ($order_id <= 0) {
  die("ERROR: Invalid ID");
}

// start transaction (VERY IMPORTANT)
mysqli_begin_transaction($con);

try {

  // 1. delete order items first
  $q1 = "DELETE FROM order_items WHERE order_id = $order_id";
  if (!mysqli_query($con, $q1)) {
    throw new Exception("Order items delete failed: " . mysqli_error($con));
  }

  // 2. delete main order
  $q2 = "DELETE FROM orders WHERE id = $order_id";
  if (!mysqli_query($con, $q2)) {
    throw new Exception("Order delete failed: " . mysqli_error($con));
  }

  // commit if both succeed
  mysqli_commit($con);

  echo "deleted";
} catch (Exception $e) {

  mysqli_rollback($con);
  echo "ERROR: " . $e->getMessage();
}
