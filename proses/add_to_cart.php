<?php
session_start();
include '../config/db.php'; // koneksi database
include 'auth_cek.php';

$user_id     = $_POST['user_id'];
$nama_produk = $_POST['nama_produk'];
$quantity    = $_POST['quantity'];
$size        = $_POST['size'];
$cut         = $_POST['cut'];
$harga       = $_POST['harga'];

// Cek apakah produk ini sudah ada di cart user
$sql_check = "SELECT * FROM cart WHERE user_id = ? AND nama_produk = ? AND size = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("iss", $user_id, $nama_produk, $size);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
        // Sudah ada → Update quantity dan cut
        $row = $result->fetch_assoc();
        $new_qty = $row['quantity'] + $quantity;
        $new_harga = $row['harga'] + $harga;

        $sql_update = "UPDATE cart SET quantity = ?, cut = ?, harga = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("isii", $new_qty, $cut, $new_harga, $row['id']);
        $stmt_update->execute();
} else {
        // Belum ada → Tambah baru
        $sql_insert = "INSERT INTO cart (user_id, nama_produk, quantity, size, cut, harga) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("isisss", $user_id, $nama_produk, $quantity, $size, $cut, $harga);
        $stmt_insert->execute();
}

header("Location: ../cart.php"); // arahkan ke halaman cart
exit;
