<?php
include '../config/db.php';
include '../config/base_url.php';

$nohp = $_POST['nohp'];
$password = $_POST['password'];

$cek = $conn->query("SELECT * FROM user WHERE username='$nohp'");
if ($cek->num_rows > 0) {
  echo "Nomor HP sudah terdaftar.";
  exit;
}

// Simpan ke database
$hak_akses = 'user';
$conn->query("INSERT INTO user (username, password, hak_akses) VALUES ('$nohp', '$password', '$hak_akses')");
header("Location: ../login.php");
