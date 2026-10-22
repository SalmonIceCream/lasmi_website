<?php
require '../config/db.php'; // atau include koneksi DB

$cart_id = $_POST['cart_id'];
$quantity = $_POST['quantity'];

if ($cart_id && $quantity > 0) {
  $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
  $stmt->bind_param("ii", $quantity, $cart_id);
  $stmt->execute();
  echo "updated";
} else {
  http_response_code(400);
  echo "Invalid data";
}
