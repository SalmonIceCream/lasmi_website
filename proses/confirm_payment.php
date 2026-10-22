<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $kode_invoice = $_POST['kode_invoice'];

  $query = "UPDATE `order` SET status = 'In Making' WHERE kode_invoice = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $kode_invoice);

  if ($stmt->execute()) {
    $_SESSION['success'] = "Pembayaran berhasil dikonfirmasi!";
  } else {
    $_SESSION['error'] = "Gagal mengupdate status.";
  }

  header("Location: ../order-list.php");
  exit;
}
