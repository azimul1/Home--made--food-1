<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$phone = $data['phone'];
$address = $data['address'];
$cart = $data['cart'];
$payment = $data['payment'];
$total = 0;

foreach ($cart as $item) {
  $total += $item['price'] * $item['qty'];
}

// Insert into orders
$sql = "INSERT INTO orders (customer_name, phone, address, total,payment_status)
        VALUES ('$name', '$phone', '$address', '$total', '$payment')";

if ($con->query($sql) === TRUE) {
  $order_id = $con->insert_id;

  // Insert items
  foreach ($cart as $item) {
    $fname = $item['name'];
    $price = $item['price'];
    $qty = $item['qty'];

    $con->query("INSERT INTO order_items (order_id, food_name, price, quantity)
                      VALUES ('$order_id', '$fname', '$price', '$qty')");
  }

  echo "Order placed successfully!";
} else {
  echo "Error: " . $con->error;
}
