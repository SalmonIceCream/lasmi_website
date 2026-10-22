<?php
session_start();
include '../config/db.php';

if (!$_POST['metode_pembayaran']) {
  header("Location: ../checkout.php?error=Metode pembayaran tidak boleh kosong");
  exit;
}

$user_id = $_SESSION['user']['id'];
$invoice = 'INV' . time(); // kode_invoice unik

// Ambil cart user
$cart_query = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$cart_query->bind_param("i", $user_id);
$cart_query->execute();
$cart_result = $cart_query->get_result();
$status = 'payment';

while ($row = $cart_result->fetch_assoc()) {
  $stmt = $conn->prepare("INSERT INTO `order`
    (kode_invoice, user_id, nama_produk, quantity, size, cut, total_harga, metode_pembayaran, tipe_order, alamat, kota, kecamatan, jam_pickup, tanggal_pickup, tanggal_pesanan,status) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(),?)");

  $stmt->bind_param(
    "sisssssssssssss",
    $invoice,
    $user_id,
    $row['nama_produk'],
    $row['quantity'],
    $row['size'],
    $row['cut'],
    $_POST['total_harga'],
    $_POST['metode_pembayaran'],
    $_POST['tipe_order'],
    $_POST['alamat'],
    $_POST['kota'],
    $_POST['kecamatan'],
    $_POST['jam_pickup'],
    $_POST['tanggal_pickup'],
    $status
  );

  $stmt->execute();
}

// Kosongkan cart
// $conn->query("DELETE FROM cart WHERE user_id = $user_id");

// Redirect
header("Location: ../order-list.php?invoice=$invoice");
exit;
