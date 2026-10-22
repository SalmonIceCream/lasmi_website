<?php
session_start();
include '../config/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM user WHERE username='$username'");
$user = $result->fetch_assoc();

if ($user && str_contains($password, $user['password'])) {
  $_SESSION['user'] = $user;
  if ($user['hak_akses'] == 'admin') {
    header("Location: ../admin/dashboard.php");
  } else {
    header("Location: ../index.php");
  }
} else {
  echo "Username atau password salah.";
}
