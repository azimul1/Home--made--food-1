<?php

include 'connection.php';

$sql = "
SELECT 
    o.id,
    o.customer_name,
    o.total,
    o.status,
    GROUP_CONCAT(
        CONCAT(oi.food_name, ' x', oi.quantity)
        SEPARATOR ', '
    ) AS items
FROM orders o
LEFT JOIN order_items oi ON o.id = oi.order_id
GROUP BY o.id
ORDER BY o.id DESC
";

$result = mysqli_query($con, $sql);

$orders = [];

while ($row = mysqli_fetch_assoc($result)) {
  $orders[] = $row;
}

echo json_encode($orders);
