<?php
include '../config/db.php';

$invoice = $_POST['invoice'] ?? '';
$status = $_POST['status'] ?? '';

if (!$invoice || !$status) {
  die("Data tidak lengkap.");
}

// Update semua row yang memiliki invoice sama
$stmt = $conn->prepare("UPDATE `order` SET status = ? WHERE kode_invoice = ?");
$stmt->bind_param("ss", $status, $invoice);
$stmt->execute();

header("Location: ../admin/order-detail.php?invoice=" . $invoice);
exit;
